<?php
/* **************************************************************************************** */
/* Class:       SimplePDF                                                                   */
/* Description: A minimal, dependency-free PDF writer for generating simple text reports    */
/*              (letter-size, single/multi-page) on hosts with no Composer / PDF extension. */
/*              Supports Helvetica / Helvetica-Bold core fonts, word wrapping, section       */
/*              headings, label/value lines, and automatic page breaks.                     */
/* **************************************************************************************** */
class SimplePDF {

	private $pageWidth  = 612; // 8.5in @ 72pt/in
	private $pageHeight = 792; // 11in  @ 72pt/in
	private $marginLeft   = 54;
	private $marginRight  = 54;
	private $marginTop    = 54;
	private $marginBottom = 54;

	private $x = 0;
	private $y = 0;
	private $curContent = '';
	private $pages = array();

	// Standard Helvetica AFM character widths (1/1000 em), ASCII 32-126.
	private static $widths = array(
		32=>278,33=>278,34=>355,35=>556,36=>556,37=>889,38=>667,39=>191,40=>333,41=>333,
		42=>389,43=>584,44=>278,45=>333,46=>278,47=>278,48=>556,49=>556,50=>556,51=>556,
		52=>556,53=>556,54=>556,55=>556,56=>556,57=>556,58=>278,59=>278,60=>584,61=>584,
		62=>584,63=>556,64=>1015,65=>667,66=>667,67=>722,68=>722,69=>667,70=>611,71=>778,
		72=>722,73=>278,74=>500,75=>667,76=>556,77=>833,78=>722,79=>778,80=>667,81=>778,
		82=>722,83=>667,84=>611,85=>722,86=>667,87=>944,88=>667,89=>667,90=>611,91=>278,
		92=>278,93=>278,94=>469,95=>556,96=>333,97=>556,98=>556,99=>500,100=>556,101=>556,
		102=>278,103=>556,104=>556,105=>222,106=>222,107=>500,108=>222,109=>833,110=>556,
		111=>556,112=>556,113=>556,114=>333,115=>500,116=>278,117=>556,118=>500,119=>722,
		120=>500,121=>500,122=>500,123=>334,124=>260,125=>334,126=>584,
	);

	// Standard Helvetica-Bold AFM character widths (1/1000 em), ASCII 32-126.
	private static $boldWidths = array(
		32=>278,33=>333,34=>474,35=>556,36=>556,37=>889,38=>722,39=>238,40=>333,41=>333,
		42=>389,43=>584,44=>278,45=>333,46=>278,47=>278,48=>556,49=>556,50=>556,51=>556,
		52=>556,53=>556,54=>556,55=>556,56=>556,57=>556,58=>333,59=>333,60=>584,61=>584,
		62=>584,63=>611,64=>975,65=>722,66=>722,67=>722,68=>722,69=>667,70=>611,71=>778,
		72=>722,73=>278,74=>556,75=>722,76=>611,77=>833,78=>722,79=>778,80=>667,81=>778,
		82=>722,83=>667,84=>611,85=>722,86=>667,87=>944,88=>667,89=>667,90=>611,91=>333,
		92=>278,93=>333,94=>584,95=>556,96=>333,97=>556,98=>611,99=>556,100=>611,101=>556,
		102=>333,103=>611,104=>611,105=>278,106=>278,107=>556,108=>278,109=>889,110=>611,
		111=>611,112=>611,113=>611,114=>389,115=>556,116=>333,117=>611,118=>556,119=>778,
		120=>556,121=>556,122=>500,123=>389,124=>280,125=>389,126=>584,
	);

	public function __construct() {
		$this->startNewPage();
	}

	/* Begins a fresh page, flushing any content already drawn on the current one. */
	public function startNewPage() {
		if ($this->curContent !== '') {
			$this->pages[] = $this->curContent;
		}
		$this->curContent = '';
		$this->x = $this->marginLeft;
		$this->y = $this->pageHeight - $this->marginTop;
	}

	/* Starts a new page if the next chunk of content would run past the bottom margin. */
	private function ensureSpace($neededHeight) {
		if ($this->y - $neededHeight < $this->marginBottom) {
			$this->startNewPage();
		}
	}

	private function contentWidth() {
		return $this->pageWidth - $this->marginLeft - $this->marginRight;
	}

	/* Converts DB text (often UTF-8) into the single-byte Latin-1 subset the core fonts use. */
	private function toPdfEncoding($text) {
		$text = (string)$text;
		if (function_exists('iconv')) {
			$converted = @iconv('UTF-8', 'CP1252//TRANSLIT//IGNORE', $text);
			if ($converted !== false) {
				return $converted;
			}
		}
		if (function_exists('mb_convert_encoding')) {
			return @mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
		}
		return $text;
	}

	private function escapeForPdf($text) {
		return str_replace(array('\\', '(', ')'), array('\\\\', '\\(', '\\)'), $text);
	}

	private function textWidth($text, $size, $bold = false) {
		$table = $bold ? self::$boldWidths : self::$widths;
		$width = 0;
		$len = strlen($text);
		for ($i = 0; $i < $len; $i++) {
			$code = ord($text[$i]);
			$width += isset($table[$code]) ? $table[$code] : 556;
		}
		return $width * $size / 1000;
	}

	private function wrapText($text, $size, $maxWidth) {
		$words = preg_split('/\s+/', trim($text));
		$lines = array();
		$current = '';

		foreach ($words as $word) {
			// Hard-break any single word that is wider than the whole line on its own.
			while ($this->textWidth($word, $size) > $maxWidth && strlen($word) > 1) {
				$chunk = '';
				for ($i = 0; $i < strlen($word); $i++) {
					if ($this->textWidth($chunk . $word[$i], $size) > $maxWidth) {
						break;
					}
					$chunk .= $word[$i];
				}
				$lines[] = $chunk;
				$word = substr($word, strlen($chunk));
			}

			$candidate = ($current === '') ? $word : $current . ' ' . $word;
			if ($this->textWidth($candidate, $size) > $maxWidth && $current !== '') {
				$lines[] = $current;
				$current = $word;
			} else {
				$current = $candidate;
			}
		}

		if ($current !== '') {
			$lines[] = $current;
		}
		if (empty($lines)) {
			$lines[] = '';
		}
		return $lines;
	}

	/* Draws a single line of text at (x, y) using font "F1" (Helvetica) or "F2" (Helvetica-Bold). */
	private function drawText($x, $y, $text, $font, $size) {
		$text = $this->toPdfEncoding($text);
		$escaped = $this->escapeForPdf($text);
		$this->curContent .= sprintf("BT /%s %d Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n", $font, $size, $x, $y, $escaped);
	}

	private function drawHorizontalRule() {
		$this->curContent .= sprintf("0.75 w %.2f %.2f m %.2f %.2f l S\n", $this->x, $this->y, $this->pageWidth - $this->marginRight, $this->y);
	}

	/* Large title at the top of the report. */
	public function bigTitle($text) {
		$this->drawText($this->x, $this->y, $text, 'F2', 18);
		$this->y -= 22;
	}

	/* Small line under the title (e.g. incident number / generated date), followed by a rule. */
	public function subtitle($text) {
		$this->drawText($this->x, $this->y, $text, 'F1', 9);
		$this->y -= 16;
		$this->drawHorizontalRule();
		$this->y -= 16;
	}

	/* Bold section heading, followed by a rule. Extra top margin separates it from the section above. */
	public function heading($text) {
		$this->ensureSpace(40);
		$this->y -= 20;
		$this->drawText($this->x, $this->y, $text, 'F2', 13);
		$this->y -= 5;
		$this->drawHorizontalRule();
		$this->y -= 14;
	}

	/* A single "Label: Value" line, label bolded. Two spaces after the colon pad it from the value. */
	public function fieldLine($label, $value, $size = 10) {
		$this->ensureSpace($size + 8);
		$labelText = $label . ':  ';
		$this->drawText($this->x, $this->y, $labelText, 'F2', $size);
		$labelWidth = $this->textWidth($this->toPdfEncoding($labelText), $size, true);
		$this->drawText($this->x + $labelWidth, $this->y, ($value === '' || $value === null) ? '-' : (string)$value, 'F1', $size);
		$this->y -= ($size + 8);
	}

	/* A plain line of body text, no label. */
	public function textLine($text, $size = 10) {
		$this->ensureSpace($size + 8);
		$this->drawText($this->x, $this->y, $text, 'F1', $size);
		$this->y -= ($size + 8);
	}

	/* A labeled, word-wrapped block of text (e.g. a long description field). */
	public function paragraph($label, $text, $size = 10, $lineHeight = 14) {
		$this->ensureSpace($lineHeight + 6);
		$this->drawText($this->x, $this->y, $label . ':', 'F2', $size);
		$this->y -= $lineHeight;

		$lines = $this->wrapText((string)$text, $size, $this->contentWidth());
		foreach ($lines as $line) {
			$this->ensureSpace($lineHeight);
			$this->drawText($this->x, $this->y, $line, 'F1', $size);
			$this->y -= $lineHeight;
		}
	}

	public function spacer($amount = 10) {
		$this->y -= $amount;
	}

	/* Assembles every page/content stream/font into a valid PDF byte string. */
	private function render() {
		if ($this->curContent !== '') {
			$this->pages[] = $this->curContent;
			$this->curContent = '';
		}
		if (empty($this->pages)) {
			$this->pages[] = '';
		}

		$bodies = array();
		$bodies[1] = "<< /Type /Catalog /Pages 2 0 R >>";
		$bodies[3] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>";
		$bodies[4] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>";

		$objNum = 5;
		$pageObjNums = array();
		foreach ($this->pages as $content) {
			$pageNum = $objNum++;
			$contentNum = $objNum++;
			$pageObjNums[] = $pageNum;
			$bodies[$pageNum] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$this->pageWidth} {$this->pageHeight}] "
				. "/Resources << /Font << /F1 3 0 R /F2 4 0 R >> >> /Contents {$contentNum} 0 R >>";
			$bodies[$contentNum] = array('stream' => $content);
		}

		$kids = implode(' ', array_map(function ($n) { return "{$n} 0 R"; }, $pageObjNums));
		$bodies[2] = "<< /Type /Pages /Kids [{$kids}] /Count " . count($pageObjNums) . " >>";
		ksort($bodies);

		$pdf = "%PDF-1.4\n";
		$offsets = array();
		foreach ($bodies as $num => $body) {
			$offsets[$num] = strlen($pdf);
			if (is_array($body)) {
				$stream = $body['stream'];
				$pdf .= "{$num} 0 obj\n<< /Length " . strlen($stream) . " >>\nstream\n{$stream}\nendstream\nendobj\n";
			} else {
				$pdf .= "{$num} 0 obj\n{$body}\nendobj\n";
			}
		}

		$xrefOffset = strlen($pdf);
		$maxNum = max(array_keys($bodies));
		$pdf .= "xref\n0 " . ($maxNum + 1) . "\n0000000000 65535 f \n";
		for ($i = 1; $i <= $maxNum; $i++) {
			$pdf .= isset($offsets[$i]) ? sprintf("%010d 00000 n \n", $offsets[$i]) : "0000000000 65535 f \n";
		}
		$pdf .= "trailer\n<< /Size " . ($maxNum + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF";

		return $pdf;
	}

	/* Sends the finished PDF to the browser as a downloadable attachment. */
	public function Output($filename) {
		$pdfString = $this->render();
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Length: ' . strlen($pdfString));
		echo $pdfString;
		exit;
	}
}
?>
