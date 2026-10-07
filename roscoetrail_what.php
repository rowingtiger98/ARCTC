<!DOCTYPE HTML>

<html>
	<head>
		<title>ARCTC - BIKE PEDESTRIAN TRAFFIC MANAGEMENT</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/modal.css" />
		<link rel="stylesheet" href="assets/css/arctc.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>		
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><a href="index.php"><span class="site-title-short">ARCTC</span><span class="site-title-full">Alliance for Reedy Creek Trenton Corridor</span></a></h1>
				<?php include 'subnavigation.php'; ?>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">

					<!-- Content -->
						<div class="content">
							<a href="#" class="image fit"><img src="images/Roscoe_Trail_Dev_Plan.jpg" alt="" /></a>
							<h2>WHAT IS THE DEVELOPER PROPOSING</h2>
							<p>
								<ul>
									<li>265 apartments (yellow buildings) and 61 townhomes (purple buildings) for a total of 15 units per acre.</li>
									<li>Seven apartment buildings up to four stories high. </li>
								</ul>							
							</p>						
						</div>

				</div>
			</section>

		<!-- Contact -->
		<?php include 'contact.php'; ?>

		<!-- Footer -->
		<?php include 'footer.php'; ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/mailer.js"></script>

			<script>
			  $( document ).ready(function() {
				var elms = document.querySelectorAll('[id^="button_action_"]');
				for (i = 0; i < elms.length; i++) {
					elms[i].onclick = HandleButtonActionClick;
				}
			  
			  });
			</script>
	</body>
</html>