<?php
include('session.php');

$admin_rights =  $login_user_role;
if ($admin_rights == 'NOT SET') {
	$panel_name = 'LOGOUT Panel';
} else if ($admin_rights == 'admin') {
  $panel_name = 'Administrative Panel';
} else {
  $panel_name = 'Account Panel';
}

?>
<!DOCTYPE html>

<html>
	<head>
		<title>ARCTC Account Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/arctc.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="is-preload" >

	<!-- Header -->
			<header id="header">
				<?php include 'account_header.php'; ?>
			</header>

		<!-- Main -->
			<div id="main" user_role="<?php echo $admin_rights; ?>" class="wrapper" style="padding:2rem 0 2rem 0;">
				<section class="wrapper" style="padding:2rem 0 2rem 0;">
					<div class="inner">
						<h3><?php echo $panel_name; ?> - <?php echo $login_session; ?> (<?php echo $login_user_role; ?>)</h3>
					</div>
				</section>
			</div>

            <section id="three" class="wrapper style2">
                <div id="focus" class="inner">
                    <div class="row uniform tools_row">

                    <?php 
                        if ($login_user_role == 'overlord') {
                            ?>
                            <div class="4u">
                                <section class="post">
                                    <div class="content">
                                        <h3>User Account Creation</h3>
                                        <p>As an overlord for the ARCTC site, you have the ability to create new users that can access the infomration contained in the ARCTC contacts database.
                                            These users can be set to either an ADMIN roll or that of a standarx user. Different Tools can / will be available to users based upon their assiged
                                            user level. Only Ron can create new overlords.
                                        </p>
                                        <a href="#" if="user_account_creation" class="button fit special">Coming Soon...</a>
                                    </div>
                                </section>
                            </div>
                            <div class="4u">
                                <section class="post">
                                    <div class="content">
                                        <h3>Manual Subscriber List Entry</h3>
                                        <p>Use this interface to manually add or delete entries from the ARCTC subscriber database. You can also download the current list of subscribers as a CSV from a button 
                                            at the bottom of this interface.  
                                        </p>
                                        <a href="DBEntry.php" class="button fit special">Click Here</a>
                                    </div>
                                </section>
                            </div>                    
                            <?php                      
                        }
                        if (($login_user_role == 'overlord') || ($login_user_role == 'admin')) {
                            ?>
                            <div class="4u">
                                <section class="post">
                                    <div class="content">
                                        <h3>Download Subscriber List</h3>
                                        <p>This tool will download all the subscriber information as a CSV file.
                                        </p>
                                        <a href="#" id="downloadsubscribercsv" class="button fit special">Download CSV File</a>
                                    </div>
                                </section>
                            </div>
                            <div class="4u">
                                <section class="post">
                                    <div class="content">
                                        <h3>View / Edit Subscribers</h3>
                                        <p>This tool will let you view and edit the information for everyone who has subscribed to the ARCTC contact list, pulled directly from the subscriber database.
                                        </p>
                                        <a href="subscriberinfo.php" class="button fit special">Click Here</a>
                                    </div>
                                </section>
                            </div>
                            <div class="4u">
                                <section class="post">
                                    <div class="content">
                                        <h3>View / Edit Neighborhoods</h3>
                                        <p>This tool set gives users the ability to see the information about subscribers, based on the neighborhoods in the corridor. It also gives the user ability to add or remove neighborhoods included in the corridor.
                                        </p>
                                        <a href="neighborhoodinfo.php" class="button fit special">Click Here</a>
                                    </div>
                                </section>
                            </div>
                            <?php
                        } else {
                            print '<p>All the other tools</p>';
                        }
                    ?>
                        <div class="4u">
                            <section class="post">
                                <div class="content">
                                    <h3>View Incident Reports</h3>
                                    <p>This tool will let you view and print incident reports.
                                    </p>
                                    <a href="incidentreportviewer.php" class="button fit special">View Incident Reports</a>
                                    <a href="#" id="downloadincidentscsv" class="button fit special">Download CSV File</a>

                                </div>
                            </section>
                        </div>                    
                    <div>
                </div>
            </section>

            <!-- Tool Section Based upon Roll -->
			<!-- <section id="three" class="wrapper style2">
				<div id="focus" class="inner">            
            <div class="features">
            <?php 
                if ($login_user_role == 'overlord') {
                    ?>
                    <section class="post">
                        <div class="content">
                            <h3>User Account Creation</h3>
                            <p>As an overlord for the ARCTC site, you have the ability to create new users that can access the infomration contained in the ARCTC contacts database.
                                These users can be set to either an ADMIN roll or that of a standarx user. Different Tools can / will be available to users based upon their assiged
                                user level. Only Ron can create new overlords.
                            </p>
                            <a href="#" if="user_account_creation" class="button fit special">Coming Soon...</a>
                        </div>
                    </section>

                    <section class="post">
                        <div class="content">
                            <h3>Manual Subscriber List Entry</h3>
                            <p>Use this interface to manually add or delete entries from the ARCTC subscriber database. You can also download the current list of subscribers as a CSV from a button 
                                at the bottom of this interface.  
                            </p>
                            <a href="DBEntry.php" class="button fit special">Click Here</a>
                        </div>
                    </section>                    
                    <?php                      
                }
                if (($login_user_role == 'overlord') || ($login_user_role == 'admin')) {
                    ?>
                    <section class="post">
                        <div class="content">
                            <h3>Download Subscriber List</h3>
                            <p>This tool will download all the subscriber information as a CSV file.
                            </p>
                            <a href="#" id="downloadsubscribercsv" class="button fit special">Download CSV File</a>
                        </div>
                    </section>
                    
                    <?php    
                } else {
                    print '<p>All the other tools</p>';
                }
            ?>
            </div>
            </div>
            </section> -->
		<!-- Footer -->
			<section id="footer">

			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/mailer.js"></script>
            <script src="assets/js/skel.min.js"></script>
			<!-- <script src="assets/js/register.js"></script> -->
			<script src="assets/js/account.js"></script>
			<script src="assets/js/stupidtable.js"></script>

		<script>
		  $( document ).ready(function() {
		    var user_role = $("#main").attr('user_role');
			///alert(user_role);
			// if (user_role == 'admin') {
			  document.querySelector('[id="downloadsubscribercsv"]').onclick = Download_Subscriber_CSV;
              document.querySelector('[id="downloadincidentscsv"]').onclick = Download_Incidents_CSV;

			//   document.querySelector('[id="display_email_address"]').onclick = RenderEmailList;
			//   document.querySelector('[id="edit_news_container_textarea"]').onclick = RenderEditNewsContainer;
			//   document.querySelector('[id="download_labels_csv"]').onclick = Download_Labels_CSV;
			//   document.querySelector('[id="download_photonumber_csv"]').onclick = Download_Photo_Number_CSV;
			//   document.querySelector('[id="photo_numbers"]').onclick = WorkOnPhotoLables;
			// }
		  });
		</script>
		

			
	</body>
</html>
