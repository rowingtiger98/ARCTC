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
							<a href="#" class="image fit"><img src="images/Both_Sides_Now_crop.jpeg" alt="" /></a>
							<h2>WHERE IS THE PROPERTY</h2>
							<p>	The property is in the ARCTC corridor on Trenton Road to the south of I-40/Wade Avenue in Cary and is across from the back entrance to the SAS campus.  The only ingress/egress for the property is onto Trenton Road, which is part of the Reedy Creek and Trenton Road corridor where the only access is via Edwards Mill Road to the north and Trinity Road to the south. 				
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