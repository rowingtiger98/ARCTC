<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
	header("location: account.php");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ARCTC.ORG</title>
		<?php include 'meta.php'; ?>
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/modal.css" />
		<link rel="stylesheet" href="assets/css/arctc.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
			    <h1><a href="index.php"><span class="site-title-short">ARCTC</span><span class="site-title-full">Alliance for Reedy Creek Trenton Corridor</span></a></h1>
				<?php include 'navigation.php'; ?>
			</header>



		<!-- Banner -->
			<section id="banner">
				<article>
					<img src="images/bg04.jpg" alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>
				<article>
					<img src="images/bg05.jpg" alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>
				<article>
					<img src="images/bgHorseWithBikers_small.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>	
				<article>
					<img src="images/bg06.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>
				<article>
					<img src="images/bgSchenckSignPath_small_crop_text.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>				
				<article>
					<img src="images/bg07.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>			
				<article>
					<img src="images/completed_path_3_crop.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>	
				<article>
					<img src="images/bgCormorants_small.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>					
				<article>
					<img src="images/bgUmsteadSignWithBiker_small_crop_text.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>	
				<article>
					<img src="images/lake_eagle_crop_left_4.jpg"  alt="" />
					<div class="inner">
						<span class="image fit"><img class="ron" src="images/logo-white-01.png" alt="" /></span>
					</div>
				</article>					
			</section>
			
		    <?php include 'modal.php'; ?> 
			
			<!-- Junk Removal Section -->
			<section id="one" class="wrapper style5">
				<div id="mission" class="inner">
					<div class="item_removal_container">
					<p class="slim"><span class="image left"><img src="images/missionstatement.jpg" alt="" /></span><span class="bold_heading">Mission Statement</span>
					The Alliance for Reedy Creek Trenton Corridor (ARCTC) exists to preserve and enhance the safety and environment of the area along Trenton and Reedy Creek Roads. We support and are committed to protecting the park, forest, lake, creeks, farms, and greenways within the corridor and promote the safety of neighbors and recreational users of this area.  </p>
					<p>The Corridor consists of all residences and neighborhoods on or intersecting with Reedy Creek Road and Trenton Road between Edwards Mill Road (northeast) and Trinity Road (southwest). Urban treasures including William B. Umstead State Park, Richland Lake, and NCSU’s Carl Alwin Schenck Memorial Forest, the Equine Educational Unit and Small Ruminant Educational Unit are recognized as valuable resources to those within and outside the corridor.  </p>
					</div>			
				</div>
			</section>
            
            <section id="roscoe" class="wrapper">
                <div id="mission" class="inner">
                <span class="bold_heading">Trenton Road Rezoning</span>
                    <p> In August 2025, development company Heritage Capital Partners submitted a rezoning application containing a maximum of 175 housing units
                    for land on the Cary side of Trenton Road next to I-40. This development will almost double the number of households in the corridor
                    and will greatly increase traffic. To learn more about the project and the concerns that ARCTC has, please <a href="roscoetrailproject.php">CLICK HERE</a>.</p>
                    <h3>Sign our Petition</h3>
                    <p>We are asking people to sign our petition that opposes the current rezoning request.  The petition and 342 signatures have been provided to Cary Town Council members and it's important to continue to gather signatures to show concern about the application.
                    We understand that this property will be sold by the State of North Carolina and developed at some point. The current planned development
                     is inconsistent with current developments of single-family homes adjacent to or in close proximity to the proposed development. 
                     We request that development of this property remain in a manner consistent with existing neighborhoods or follow the current O&I zoning 
                     classification. To learn more about the petition and to sign, simply  <a href="https://c.org/bNT2hWqWkQ" target="_blank">click below</a>.</p>
                     <a href="https://c.org/bNT2hWqWkQ" class="button alerting fit" target="_blank">Sign The Petition Opposing the current plan</a>                
                        
                </div>
            </section>

		<!-- Core Values Section -->
			<section id="three" class="wrapper style2">
				<div id="focus" class="inner">
					<div class="features">

						

						<!-- Bicycle/Pedestrian/Traffic Management Section -->
						<section class="post">
							<span class="image"><img src="images/corevalue01e.jpg" alt="" /></span>
							<div class="content">
								<h3>Bicycle/Pedestrian/Traffic Management</h3>
								<p>Traffic volume, traffic speed and safety, rush hour congestion, and conflicts with pedestrians, joggers, dog walkers, and bicyclists along Trenton and Reedy Creek Roads</p>
								<ul class="actions" >
									<li><a href="bptmanagement.php" class="button special">More</a></li>
								</ul>
							</div>
						</section>
						<!-- Stormwater Management -->
						<section class="post">
							<span class="image"><img src="images/corevalue02b.jpg" alt="" /></span>
							<div class="content">
								<h3>Stormwater Management</h3>
								<p>Environmental health of Richland Creek drainage, Richland stormwater control lakes, and downstream impacts to existing streams, lakes, nearby forests and neighborhoods.</p>
								<ul class="actions">
									<li><a href="stormwater.php" class="button special">More</a></li>
								</ul>
							</div>
						</section>						
						<!-- Moving Supplies -->
						<section class="post">
							<span class="image"><img src="images/corevalue03a.jpg" alt="" /></span>
							<div class="content">
								<h3>Natural Area Preservation</h3>
								<p>Protection of the longevity and environmental health of Carl Alwin Schenck Memorial Forest, NC State University farms/facilities on Reedy Creek and Trenton Roads, and William B. Umstead State Park</p>
								<ul class="actions">
									<li><a href="napreservation.php" class="button special">More</a></li>
								</ul>
							</div>
						</section>
					</div>
				</div>
			</section>


		<!-- Spacer Section -->
			<section id="one" class="wrapper style5">
				<div id="removal" class="inner" style="font-size:2.25em;text-transform:uppercase;text-align:center;letter-spacing:0.02em;">Alliance for Reedy Creek Trenton Corridor</div>
			</section>
			
		<!-- Contact -->
		<?php include 'contact.php'; ?>
		
		
		<!-- Footer -->
		<?php include 'footer.php'; ?>

		<!-- Scripts -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
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