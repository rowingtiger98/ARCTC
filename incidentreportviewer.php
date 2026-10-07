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

<!DOCTYPE HTML>
<html>
	<head>
		<title>ARCTC.ORG</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/arctc.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<?php include 'account_header.php'; ?>
			</header>

		<!-- DB Entry Section -->
			<section id="contact" class="wrapper">
				<div class="inner">		
                    <h3>Incident Reports</h3>
                    <div id="current_reports_table" class="reports_table active"></div>
                    <div id="selected_reports_table" class="reports_table"></div>
                </div>
		    </section>
		
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
			<script src="assets/js/account.js"></script>

			<script>
			  $( document ).ready(function() {
				$.ajax({
				  type: "POST",
				  url: "INCIDENTFunctions.php",
				  data: {method:'RenderCurrentIncidentReports'},
				  success:  function(data){
					$("#current_reports_table").html(data);
				    var elms = document.querySelectorAll('[id^="show_selected_incident_report_"]');
				    for (i = 0; i < elms.length; i++) {
				    	elms[i].onclick = ShowSelectedIncidentReport;
				    }					
					
				  }
				});							
			  });
			</script>
			
			<script>
			function ShowSelectedIncidentReport() {
				var inc_id = $(this).attr('incident_id');
                if (inc_id === 'all') {
                    $("#selected_reports_table").removeClass('active');
                    $("#current_reports_table").addClass('active');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "INCIDENTFunctions.php",
                        data: {method:'ShowSelectedIncidentReport', inc_id:inc_id},
                        success:  function(data){
                            console.log(data);
                            $("#selected_reports_table").html(data);
                            $("#selected_reports_table").addClass('active');
                            $("#current_reports_table").removeClass('active');
                            document.querySelector('[id="show_selected_incident_report_all"]').onclick = ShowSelectedIncidentReport;	                                                        
                        }
                    });
                }
			}
			</script>
			
			<script>
			  function DeleteContactInformation() {
				event.preventDefault();
			    let SUB_ID = $(this).attr('SUB_ID');
				console.log('Delete SUB ID = ' + SUB_ID);
				$.ajax ({
					url: 'GENERALFunctions.php',
					type: 'POST',
					data: {method: 'DeleteContactInformation', SUB_ID:SUB_ID},
					dataType: 'json',
					success: function(data) {
					  console.log(data);
					  console.log('success = ' + data['success']);
					  console.log('message = ' + data['message']);
					  var success = data[0];
					  var message = data[1];
					  if (data['success'] == 1) {
						console.log('SUCCESS: ' + data['message']);
				        $.ajax({
				          type: "POST",
				          url: "GENERALFunctions.php",
				          data: {method:'RenderCurrentContactsTable'},
				          success:  function(data){
				        	$("#current_contacts_table").html(data);
							var elms = document.querySelectorAll('[id="delete_contact_link"]');
							console.log(elms.length);
							for (i = 0; i < elms.length; i++) {
								elms[i].onclick = DeleteContactInformation;
							}							
				          }
				        });
					  } else {
						console.log('ERROR: ' + data['message']);
					  }
				    }
				});
			  }
			</script>
			
	</body>
</html>