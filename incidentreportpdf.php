<?php
include('session.php'); // Ensures only logged-in admin panel users can reach this page.
include_once('SimplePDF.php');
include_once('IncidentCategories.php');

$inc_id = isset($_GET['INC_ID']) ? (int)$_GET['INC_ID'] : 0;

$link = connectDB('kirbypar_arctc_contacts');
$query = sprintf("SELECT * FROM `arctc_incident_reports` WHERE `INC_ID` = %d", $inc_id);
$result = $link->query($query);

if (!$result || $result->num_rows == 0) {
	closeDB($link);
	http_response_code(404);
	exit('Incident report not found.');
}

$row = mysqli_fetch_assoc($result);
closeDB($link);

$categoryLabel = getIncidentCategoryLabel($row['INC_Category']);

$pdf = new SimplePDF();
$pdf->bigTitle('ARCTC Traffic Incident Report');
$pdf->subtitle('Incident #' . $row['INC_ID'] . '   |   Generated ' . date('F j, Y g:ia'));

$pdf->heading('Reporter Information');
if ($row['INC_File_Anonymously']) {
	$pdf->textLine('This report was filed anonymously.');
} else {
	$pdf->fieldLine('Reporter Name', $row['INC_Reporter_Name']);
	$pdf->fieldLine('Reporter Email', $row['INC_Reporter_Email']);
	$pdf->fieldLine('Reporter Phone', $row['INC_Reporter_Phone']);
}

$pdf->heading('Incident Details');
$pdf->fieldLine('Category', $categoryLabel);
$pdf->fieldLine('Date', $row['INC_Date']);
$pdf->fieldLine('Time', date('g:i A', strtotime($row['INC_Time'])));
$pdf->fieldLine('Location', $row['INC_Location']);
$pdf->fieldLine('Police Contacted', $row['INC_Police_Involved'] == 1 ? 'Yes' : 'No');
$pdf->fieldLine('Photos / Video Available', $row['INC_Photos_Available'] == 1 ? 'Yes' : 'No');
$pdf->paragraph('Description', $row['INC_Description']);

if (strpos($row['INC_Category'], 'veh') !== false) {
	$pdf->heading('Vehicle One Information');
	$pdf->fieldLine('Make', $row['INC_Vehicle_One_Make']);
	$pdf->fieldLine('Model', $row['INC_Vehicle_One_Model']);
	$pdf->fieldLine('Color', $row['INC_Vehicle_One_Color']);
	$pdf->fieldLine('License Plate', $row['INC_Vehicle_One_Plate']);
	$pdf->fieldLine('Plate State', $row['INC_Vehicle_One_State']);
}

if ($row['INC_Category'] == 'vehwithveh') {
	$pdf->heading('Vehicle Two Information');
	$pdf->fieldLine('Make', $row['INC_Vehicle_Two_Make']);
	$pdf->fieldLine('Model', $row['INC_Vehicle_Two_Model']);
	$pdf->fieldLine('Color', $row['INC_Vehicle_Two_Color']);
	$pdf->fieldLine('License Plate', $row['INC_Vehicle_Two_Plate']);
	$pdf->fieldLine('Plate State', $row['INC_Vehicle_Two_State']);
}

$pdf->Output('ARCTC_Incident_Report_' . (int)$row['INC_ID'] . '.pdf');
?>
