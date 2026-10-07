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
					<section id="message_section">
						<h2>Manually enter New Subscriber</h2>
							<div class="row uniform">
								<div class="6u 12u$(large) 6u(medium) 12u$(xsmall)">
									<label for="name">Full Name</label>
									<input type="text" name="name" id="general_name" />
								</div>
								<div class="6u$ 12u$(large) 6u$(medium) 12u$(xsmall)">
									<label for="email">Email</label>
									<input type="email" name="email" id="general_email" />
								</div>
                            	<div class="5u 12u$(large) 5u(medium) 12u$(xsmall)">
                                    <label for="street">Street Address</label>
                            		<input type="text" name="street" id="general_required_street" value="" />
                            	</div>
                            	<div class="3u 12u$(large) 3u(medium) 12u$(xsmall)">
                                    <label for="city">City</label>
                            		<input type="text" name="city" id="general_required_city" value="" />
                            	</div>
								<div class="2u 12u$(large) 2u(medium) 12u$(xsmall)">
                                    <label for="state">State</label>
                                    <select name="state" id="general_required_state" style="color:#c0c0c0;">
                                    	<option value="" selected disabled>Select</option>
                                    	<option value="AL">AL</option>
                                    	<option value="AK">AK</option>
                                    	<option value="AZ">AZ</option>
                                    	<option value="AR">AR</option>
                                    	<option value="CA">CA</option>
                                    	<option value="CO">CO</option>
                                    	<option value="CT">CT</option>
                                    	<option value="DE">DE</option>
                                    	<option value="DC">DC</option>
                                    	<option value="FL">FL</option>
                                    	<option value="GA">GA</option>
                                    	<option value="HI">HI</option>
                                    	<option value="ID">ID</option>
                                    	<option value="IL">IL</option>
                                    	<option value="IN">IN</option>
                                    	<option value="IA">IA</option>
                                    	<option value="KS">KS</option>
                                    	<option value="KY">KY</option>
                                    	<option value="LA">LA</option>
                                    	<option value="ME">ME</option>
                                    	<option value="MD">MD</option>
                                    	<option value="MA">MA</option>
                                    	<option value="MI">MI</option>
                                    	<option value="MN">MN</option>
                                    	<option value="MS">MS</option>
                                    	<option value="MO">MO</option>
                                    	<option value="MT">MT</option>
                                    	<option value="NE">NE</option>
                                    	<option value="NV">NV</option>
                                    	<option value="NH">NH</option>
                                    	<option value="NJ">NJ</option>
                                    	<option value="NM">NM</option>
                                    	<option value="NY">NY</option>
                                    	<option value="NC">NC</option>
                                    	<option value="ND">ND</option>
                                    	<option value="OH">OH</option>
                                    	<option value="OK">OK</option>
                                    	<option value="OR">OR</option>
                                    	<option value="PA">PA</option>
                                    	<option value="RI">RI</option>
                                    	<option value="SC">SC</option>
                                    	<option value="SD">SD</option>
                                    	<option value="TN">TN</option>
                                    	<option value="TX">TX</option>
                                    	<option value="UT">UT</option>
                                    	<option value="VT">VT</option>
                                    	<option value="VA">VA</option>
                                    	<option value="WA">WA</option>
                                    	<option value="WV">WV</option>
                                    	<option value="WI">WI</option>
                                    	<option value="WY">WY</option>
                                    </select>								
                            	</div>
								<div class="2u$ 12u$(large) 2u$(medium) 12u$(xsmall)">
                                    <label for="zip">Zip</label>
                            		<input type="text" name="zip" id="general_required_zip" value=""  />
                            	</div> 									
								<div class="6u 12u$(large) 6u(medium) 12u$(xsmall)">
									<label for="email">Affiliation</label>
									<input type="email" name="affiliation" id="general_affiliation" />
								</div>
								<div class="6u$ 12u$(large) 6u$(medium) 12u$(xsmall)">
									<label for="general_neighborhood">Neighborhood</label>
									<div class="neighborhood_group">
										<select name="neighborhood" id="general_neighborhood"></select>
										<input type="text" name="neighborhood_other" id="general_neighborhood_other" placeholder="Enter neighborhood" style="display:none;" />
									</div>
								</div>
								<div class="12u$">
									<label for="notes">Notes</label>
									<textarea name="notes" id="general_notes" rows="4"></textarea>
								</div>
								<div class="12u$">
									<ul class="actions">
										<li id="enter_new_contact_button" action="general_message" class="button special" style="padding:0 1.0em;" />Enter Contact</li>
										<li><a href="account.php" class="button">Cancel</a></li>
									</ul>
								</div>
							</div>
					</section>
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
				document.querySelector('[id="enter_new_contact_button"]').onclick = EnterNewDataBaseContact;
				LoadNeighborhoodSelect('general_neighborhood', 'general_neighborhood_other');
			  });
			</script>
			
			<script>
			function EnterNewDataBaseContact() {
				var name = $("#general_name").val();
				var email = $("#general_email").val();
				var street_address = $("#general_required_street").val();
                var city =  $("#general_required_city").val();
                var state =  document.getElementById("general_required_state").value;
                var zip = $("#general_required_zip").val();				
				var affiliation = $("#general_affiliation").val();
				var neighborhood = GetNeighborhoodValue('general_neighborhood', 'general_neighborhood_other');
				var notes = $("#general_notes").val();
				if ($('#general_neighborhood').val() === '__other__' && neighborhood === '') {
				    alert('Please enter the neighborhood name for "Other".');
				    return;
				}
				if (name != '' && email != '' ){
				    $.ajax({
				      type: "POST",
				      url: "GENERALFunctions.php",
				      data: {method:'EnterNewContactManually', name:name, email:email, street_address:street_address, city:city, state:state, zip:zip, affiliation:affiliation, neighborhood:neighborhood, notes:notes},
					  dataType: 'json',
				      success:  function(data){
						if (data[0] == 'success') {
							alert(data[1]);
							$("#general_name").val('');
							$("#general_email").val('');
							$("#general_required_street").val('');
                 			$("#general_required_city").val('');
							var state = document.getElementById("general_required_state");
							state.value = '';
							state.text = 'Select';
							$("#general_required_zip").val('');
							SetNeighborhoodValue('general_neighborhood', 'general_neighborhood_other', '');
							$("#general_notes").val('');
						} else {
						  alert(data[1]);
						}
				      }
				    });
				} else {
				    alert('Please enter both the name and the email.');
				}
			}
			</script>

	</body>
</html>