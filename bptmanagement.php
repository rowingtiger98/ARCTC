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
							<a href="#" class="image fit"><img src="images/big-corevalue01.jpg" alt="" /></a>
							<h2>BICYCLE/PEDESTRIAN/TRAFFIC MANAGEMENT</h2>
							<p>
								<ul>
									<li>Three speed studies conducted by Raleigh Police Department between 2014 and today have all documented increased traffic volumes and excessive speed that justified additional law enforcement efforts.</li>
									<li>Trenton and Reedy Creek Roads provide an alternate route to reach the SAS campus and will, in the near future, provide an alternate route to the Bandwidth IT campus.  This alternate route is attractive to many who wish to avoid increasing congestion along Wade Avenue and Edwards Mill Road. </li>
									<li>Both Reedy Creek and Trenton Roads are classified as Sensitive Area Avenues in Raleigh’s Comprehensive Plan, Street Plan.</li>
									<li>Pedestrian and cyclist traffic has steadily increased as the area has expanded to 187 homes and the increasing use of the area by joggers and recreational cyclists.  While Trenton Road generates the bulk of residential traffic, the Reedy Creek Greenway which parallels Reedy Creek Road generates significant recreational pedestrian and cyclist traffic.  Due to its unique environment, the area is used by large numbers of recreational cyclists.</li>
									<li>Pre-pandemic traffic volume was measured at 2,300 Annual Average Daily Traffic (AADT) in 2015.  Due to changes in NCDOT’s data collection methods, some contradictory information is published and may show an AADT of 2,400 for 2019, which may be an estimate since NCDOT reports physical data was not collected.
										<ul style="list-style:circle;margin-bottom:0">
											<li>A set of conservative estimates published by Bandwidth’s traffic engineering consultant indicates the corridor will experience between 175 and 350 (5% of the total) more vehicle trips a day when the Bandwidth campus is occupied at the corner of Reedy Creek and Edwards Mill Road in 2023 (Traffic Impact Analysis, Project Athens Rezoning, Raleigh, NC, Kimberly Horn Associates August 2020 - Appendix B, Trip Generation Project Athens Trip Generation Table 2, Phase 1 and Table 3, Phase 2)</li>
										</ul>
									</li>
								</ul>							
							</p>
							<h2>RELATED LINKS</h2>
							<p>
								<b><a href="https://trianglebikeway.com" target="_blank">Triangle Bikeway Study</a></b> <br><br> Read about the planned 17-mile, shared-use path linking Raleigh, Cary, Morrisville, Research Triangle Park (RTP), Durham, and Chapel Hill following the I-40 and NC54 corridor including project details, a public survey, and a route map.
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