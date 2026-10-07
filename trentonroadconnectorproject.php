<!DOCTYPE HTML>

<html>
	<head>
		<title>TRENTON ROAD CONNECTOR PROJECT - ABOUT</title>
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
							<a href="#" class="image fit"><img src="images/completed_path_1_crop.jpg" alt="" /></a>
							<h2>Trenton Road Connector Project</h2>
							<span style="color:red;font-weight:bold;">The project was completed in early 2024</span>	<br><br>  
				
							<h3>Project Details</h3>
							<p>
								There have been requests for a path along Trenton Road for many years because of the safety concerns with vehicles traveling within inches of pedestrians, bicyclists and runners. A pedestrian entrance to Umstead State Park is at one end of Trenton Road, which encourages recreational users to come to the area.
                            </p>
                            <p>
								The Trenton Road Connector Project is a 10’ wide multi-use path located along Trenton Road between the bridge over I-40 and the William B. Umstead State Park Entrance at Reedy Creek and Trenton Roads.  The project includes pedestrian crossings at Manorbrook Road and Silent Stream Court.  <a href="https://cityofraleigh0drupal.blob.core.usgovcloudapi.net/drupal-prod/COR24/trenton-road-location-map.pdf" target="_blank">This map shows the location of the project.</a> 							
							</p>
							<p>
								Details of the design can be seen by viewing the <a href="https://raleighnc.gov/projects/trenton-road-connector-project" target="_blank">Trenton Road Connector Project</a>.
							</p>			
							<h3>Contact Information</h3>
							<p>If you have concerns or questions about the path, contact the following City of Raleigh employees, who managed the project:  Raleigh Construction Project Manager Jay Shah, <a href="mailto:jaykumar.shah@raleighnc.gov">jaykumar.shah@raleighnc.gov</a>, Construction Supervisor Ben Possiel, <a href="mailto:Benjamin.possiel@raleighnc.gov">Benjamin.possiel@raleighnc.gov</a>, and Capital Project Manager David Bender, <a href="mailto:david.bender@raleighnc.gov">david.bender@raleighnc.gov</a>.</p>
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