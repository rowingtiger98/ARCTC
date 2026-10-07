<!DOCTYPE HTML>

<html>
	<head>
		<title>ARCTC - ABOUT</title>
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
							<a href="#" class="image fit"><img src="images/HorseWithOneBiker_crop_small.jpg" alt="" /></a>
							<!-- <a href="#" class="image fit"><img src="images/big-corevalue04.jpg" alt="" /></a> -->
							<h2>About Us</h2>
							<p>
								The Alliance for Reedy Creek Trenton Corridor (ARCTC) was formed in reaction to
                              <ul>
                              <li>Concerns over the safety of the various users of Trenton and Reedy Creek Roads.  These concerns were driven by increases in motor vehicle traffic and the existing use of the corridor by bicycle traffic and pedestrians, including those walking with children and pets.</li>
                              <li>Concerns over the effect that increasing development along Edwards Mill Road, the Blue Ridge Corridor and on State-owned land in the vicinity will have on the environment, the Richland drainage and Richland stormwater control lakes, Carl Alwin Schenck Memorial Forest, William B. Umstead State Park, and NC State University educational farms in the immediate area.</li>
                              </ul>
                              
                              ARCTC consists of resident volunteers and associates who monitor zoning changes, development plans and interact with businesses, government officials, and other users of the Corridor to improve traffic safety, improve stormwater controls, and protect the open space, natural beauty, and residential nature of the environment in which we live.  
                              </p>
                              <p>
                              <h3>REEDY CREEK TRENTON CORRIDOR DEFINITION:</h3><p>
                              	The area along Reedy Creek and Trenton Roads between the intersection of Reedy Creek Road/Edwards Mill Road in the northeast and Trenton Road/Trinity Road in the southwest. <a href="#map">See map below.</a </p>
		
                              
                              <h3>REEDY CREEK TRENTON CORRIDOR CONTAINS:</h3><p>
                              <ul>
                                <li>Over 180 private homes<br>
                                  In six distinct neighborhoods (listed below) and independent residences along Trenton and Reedy Creek Roads that include Raleigh City, Town of Cary, and Wake County.
                                  <ul style="list-style:circle;margin-bottom:0">
                                    <li>Trenton Pointe</li>
                                    <li>Trinity Farms</li>
                                    <li>Trenton Place</li>
                                    <li>Lakes at Umstead</li>
                                    <li>Woods at Umstead</li>
                                    <li>Westridge</li>
                                  </ul>
                                </li>
                                <li>Reedy Creek Greenway (1.6 miles from Edwards Mill Rd to the pedestrian/bicycle entrance to William B. Umstead State Park)</li>
                                <li>Richland Lake, part of Wake County’s stormwater/flood control system</li>
                                <li>William B. Umstead State Park, Trenton/Reedy Creek Gate, pedestrian/bicycle entrance</li>
                                <li>North Carolina State University
                                  <ul style="list-style:circle;margin-bottom:0">
                                    <li>College of Natural Resources, Carl Alwin Schenck Memorial Forest</li>
                                    <li>College of Veterinary Medicine Equine Farm </li>
                                    <li>College of Agriculture and Life Sciences</li>
                                      <ul style="list-style:square;margin-bottom:0"> 
                                        <li>Equine Educational Unit, 5100 Reedy Creek Road</li>
                                        <li>Small Ruminant Educational Unit, 2200 Trenton Road</li>
                                      </ul>
                                    <li>Department of Physics Reedy Creek Observatory</li>
                                  </ul>
                                <li>SAS Institute, two entrances to SAS campus on Trenton Road</li>
                                <li>Bandwidth headquarters campus, Reedy Creek Road at Edwards Mill Road</li>
                              </ul>							
							
							</p>
							<div id="map" class="inner">
							<h3>REEDY CREEK TRENTON CORRIDOR MAP</h3>
							<a href="images/CorridorMap_2.jpg" target="_blank"><span class="image fit"><img src="images/CorridorMap_2.jpg" alt="" /></span></a></br>
							Click <a href="images/CorridorMap_2.jpg" target="_blank">Here</a> to view just the corridor map.
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