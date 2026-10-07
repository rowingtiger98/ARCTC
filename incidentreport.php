<!DOCTYPE HTML>
<?php include 'GENERALFunctions.php'; ?>
<html>
	<head>
		<title>ARCTC - Incident Report</title>
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
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>				
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">

					<!-- Content -->
						<div class="content">
                        <h2>Submit an Incident Log</h2>
                            <div class="row uniform">
                                <div id="indident_image" class="2u 12u$(xsmall) active"> 
							        <a href="#" class="image fit"><img src="images/exclamation.jpeg" alt="" /></a>
                                </div>
                                <div class="10u 12u$(xsmall)">                                   
                                    <p>ARCTC is collecting information about vehicle, bicycle, and pedestrian incidents to monitor current safety measures. 
                                    Contact information is requested to allow better tracking of incidents and to validate reports but the report can be
                                    anonymous. If you provide your contact information, it will not be shared with anyone outside of the ARCTC Board without 
                                    your permission.<br><br>
                                    If you see a vehicle collision or incident with another vehicle, bicycle, or
                                    pedestrian along Edwards Mill, Reedy Creek or Trenton Roads, please do the
                                    following:</p>
                                    <ol>
                                        <li>Report the incident to the police, if applicable. <br>
										    If the incident is not an emergency, the non-emergency Raleigh Police response number is 919-829-1911. <br>
											ARCTC is not affiliated with the Raleigh Police and is not responsible for any report made to the police.</li>
                                        <li> Log the details on the ARCTC website using the form below.</li>
                                    </ol> 
                                    Required Fields are designated with a <span style="color:#ff0000;font-size: 1.25em;position: absolute;padding: 3px 0 0 4px;">*</span>

                                </div>
                            </div>
                            <div id="incident_report_conatiner">
                            <form method="post" action="#">
								
                                <div class="row uniform">                       
                                    <div class="12u 12u$(large) 12u(medium) ">
                                        <label for="incident_report_category_list">Incident Category
                                        <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                        </label>
                                        <?php print getCategorySelectList(); ?>
                                    </div>

                                    <!-- Contact Information Section -->
                                    <div id="collect_contactinfo" class="12u collect_contactinfo active">
                                        <h3>Reporter Information</h3>
                                        <div class="row uniform"> 
                                            <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">
                                                <label for="name">Reporter Name
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                                </label>
                                                <input type="text" name="name" id="contact_general_required_name" />
                                            </div>

                                            <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">
                                                <label for="email">Reporter Email
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                                </label>
                                                <input type="email" name="email" id="contact_general_required_email" />
                                            </div> 

                                            <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">
                                                <label for="phone">Reporter Phone</label>
                                                <input type="text" name="phone" id="contact_general_optional_phone" />
                                            </div>                                            
                                        </div>
                                    </div>  

                                    <div class="12u$">
                                        <input type="checkbox" name="anonymous_report" id="anonymous_report" />
                                        <label for="anonymous_report">Check this box if you wish to fill out anonymously.</label>
                                    </div>

                                    <div class="12u$" style="border-bottom:1px solid black;margin-left:1.5em;"></div>

                                    <!-- Incident Information Section -->
                                    <div class="4u 6u(large) 6u(medium) 12u$(xsmall)">
                                        <label for="date">Incident Date
                                        <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                        </label>
                                        <input type="date" name="date" id="general_required_date" />
                                    </div> 

                                    <div class="4u 6u(large) 6u(medium) 12u$(xsmall)">
                                        <label for="time">Incident Time <span style="font-weight:400;text-transform:none;font-family:san-serif;">(ex. 9:35AM)</span>
                                        <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                        </label>
                                        <input type="time" name="time" id="general_required_time"/>
                                    </div> 

                                    <div class="2u 6u(large) 6u(medium) 12u$(xsmall)">
                                        <label for="police">Police Contacted</label>
                                        <select name="police" id="general_optional_police" style="color:rgba(0,0,0, 0.7)";>
                                            <option value="" selected disabled hidden>Yes,No,Unknown</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="unknown">Unknown</option>

                                        </select>
                                    </div> 

                                    <div class="2u 6u(large) 6u(medium) 12u$(xsmall)">
                                        <label for="photos">Photos / Video Avail</label>
                                        <select name="photos" id="general_optional_photos" style="color:rgba(0,0,0, 0.7)";>
                                            <option value="" selected disabled hidden>Yes,No,Unknown</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="unknown">Unknown</option>
                                        </select>
                                    </div>

                                    <div class="12u">
                                        <label for="location">Incident Location
                                        <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                        </label>
                                        <input type="text" name="location" id="general_required_location" placeholder="ex. ROAD NAME, CLOSEST INTERSECTION, LANDMARK, etc..."/>
                                    </div>                                    

                                    <div class="12u$">
                                        <label for="message">Incident Description
                                        <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>
                                        </label>
                                        <textarea name="message" id="general_required_description" rows="5" placeholder="Please provide as much detail as possible."></textarea>
                                    </div>

                                    <div class="12u$" style="border-bottom:1px solid black #ff0000;margin-left:1.5em;"></div>

                                    <!-- Vehicle Description Sections -->
                                    <div id="collect_carinfo" class="12u collect_carinfo" style="margin-bottom: 2em;">
                                        <h3>Vehicle Information</h3>
                                        <span id="vehicle_one_statement" class="vehicle_block">
                                            <p>Any information you can provide about the vehicle involved could be helpful.</p>
                                        </span>
                                        <span id="vehicle_two_statement" class="vehicle_block">
                                            <p>Any information you can provide about either of the vehicles involved could be helpful.</p>
                                        </span>
                                     
                                        <div id="vehicle_one_info" class="vehicle_block">
                                            <span id="vehicle_one_title" class="vehicle_block" style="margin-top: 1em;color:#ff0000;font-weight:600;">Vehicle One:</span>
                                            <div class="row uniform">                       
                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carmake_vehilcle1">Vehicle Make</label>
                                                    <input type="text" name="carmake_vehilcle1" id="general_optional_carmake_vehilcle1" placeholder="ex. Honda"/>
                                                </div>
                                                
                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carmodel_vehilcle1">Vehicle Model</label>
                                                    <input type="text" name="carmodel_vehilcle1" id="general_optional_carmodel_vehilcle1" placeholder="ex. Civic"/>
                                                </div> 

                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carcolor_vehilcle1">Color</label>
                                                    <input type="text" name="carcolor_vehilcle1" id="general_optional_carcolor_vehilcle1" />
                                                </div>
                                                
                                                <div class="2u 2u(large) 4u(medium) 12u$(xsmall)">
                                                    <label for="platenumber_vehilcle1">License Plate </label>
                                                    <input type="text" name="platenumber_vehilcle1" id="general_optional_platenumber_vehilcle1" />
                                                </div>

                                                <div class="1u 1u(large) 2u$(medium) 12u$(xsmall)">
                                                    <label for="platestate_vehilcle1">State</label>
                                                    <select name="platestate_vehilcle1" id="general_optional_platestate_vehilcle1" style="color:rgba(0,0,0, 0.7)";>
                                                        <option value="" selected disabled hidden>State</option>
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
                                            </div> 
                                        </div>


                                        <div id="vehicle_two_info" class="vehicle_block">
                                            <span id="vehicle_two_title" class="vehicle_block" style="margin-top: 1em;color:#ff0000;font-weight:600;">Vehicle Two:</span>
                                            <div class="row uniform">
                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carmake_vehilcle2">Vehicle Make</label>
                                                    <input type="text" name="carmake_vehilcle2" id="general_optional_carmake_vehilcle2" placeholder="ex. Honda"/>
                                                </div>
                                                
                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carmodel_vehilcle2">Vehicle Model</label>
                                                    <input type="text" name="carmodel_vehilcle2" id="general_optional_carmodel_vehilcle2" placeholder="ex. Civic"/>
                                                </div> 

                                                <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">
                                                    <label for="carcolor_vehilcle2">Color</label>
                                                    <input type="text" name="carcolor_vehilcle2" id="general_optional_carcolor_vehilcle2" />
                                                </div>
                                                
                                                <div class="2u 2u(large) 4u(medium) 12u$(xsmall)">
                                                    <label for="platenumber_vehilcle2">License Plate </label>
                                                    <input type="text" name="platenumber_vehilcle2" id="general_optional_platenumber_vehilcle2" />
                                                </div>

                                                <div class="1u 1u(large) 2u$(medium) 12u$(xsmall)">
                                                    <label for="platestate_vehilcle2">State</label>
                                                    <select name="platestate_vehilcle2" id="general_optional_platestate_vehilcle2" style="color:rgba(0,0,0, 0.7)";>
                                                        <option value="" selected disabled hidden>State</option>
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
                                            </div>
                                        </div>                                             

                                        <div class="12u$" style="border-bottom:1px solid black;margin:1.0em 0;"></div>
                                    </div>
                                    <!-- End Vehicle Description Section -->


                                    <!-- Stay Informer Section -->
                                    <div class="12u$">
                                        <input type="checkbox" name="database" id="database" />
                                        <label for="database">Check this box to stay informed about all that ARCTC is doing.</label>
                                    </div>


                                    <div id="affiliation_input" class="12u$ 12u$(large) 12u$(medium) 12u$(xsmall) affiliation">
                                        <p>In order to stay informed, we will
                                             have to collect your contact information, but only for our contact database.
                                        If you have selected to file this report anonymously, the report will contain none of your personal information.</p>
                                        <div class="row uniform">
                                            <div class="6u 6u(large) 6u(medium) 6u(small) 12u$(xsmall)">
                                                <label for="affil_name">Name
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>   
                                                </label>
                                                <input type="text" name="affil_name" id="affil_general_required_name" />
                                            </div>
                                            <div class="6u 6u(large) 6u(medium) 6u(small) 12u$(xsmall)">
                                                <label for="affil_email">Email
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>     
                                                </label>
                                                <input type="email" name="affil_email" id="affil_general_required_email" />
                                            </div>
                                            <div class="5u 5u(large) 12u(medium) 12u(small) 12u$(xsmall)">
                                                <label for="affil_street">Street Address
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span> 
                                                </label>
                                                <input type="text" name="affil_street" id="affil_general_required_street" value="" />
                                            </div>
                                            <div class="3u 3u(large) 4u(medium) 6u(small) 12u$(xsmall)">
                                                <label for="affil_city">City
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span> 
                                                </label>
                                                <input type="text" name="affil_city" id="affil_general_required_city" value="" />
                                            </div>

                                            <div class="2u 2u(large) 4u(medium) 3u(small) 12u$(xsmall)">
                                                <label for="affil_state">State
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>     
                                                </label>
                                                <select name="affil_state" id="affil_general_required_state" style="color:#c0c0c0;">
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

                                            <div class="2u 2u(large) 4u(medium) 3u(small) 12u$(xsmall)">
                                                <label for="affil_zip">Zip
                                                <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>    
                                                </label>
                            		            <input type="text" name="affil_zip" id="affil_general_required_zip" value=""  />
                            	            </div>    

                                             <div class="12u$ 12u$(large) 12u$(medium) 12u$(xsmall) ">
                                                <label for="affiliation">Affiliation</label>
                                                <input type="text" name="affiliation" id="general_optional_affiliation" />
                                            </div>	  

                                        </div>
								    </div>

                                    <div class="g-recaptcha" data-sitekey="6LcpQMUaAAAAAPWqnBVJnrtE0E8ZkCeuvYeXtOSK" style="margin:1em 0;"></div>
                                    <div class="12u$">
                                        <ul class="actions">
                                            <li><a href="#" id="button_action_send_message" action="incident_report" class="button special">Log Incident</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            </div>
						</div>

				</div>
			</section>

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
                function ShowAndHideAffiliation(event) {
                    console.log('Affiliation');
                    var checkbox = document.getElementById('database').checked;
                    // Element is currently un-checked and has been checked
                    if (checkbox) {
                        $("#affiliation_input").addClass("active"); 
                       
                    // Element is currently checked and has been un-checked
                    } else {
                        $("#affiliation_input").removeClass("active");
                    }
                }
            </script>

            <script>
                function ShowAndHideContactInfo(event) {
                    console.log('Affiliation');
                    var checkbox = document.getElementById('anonymous_report').checked;
                    // Element is currently un-checked and has been checked
                    if (checkbox) {
                        $("#collect_contactinfo").removeClass("active");
                    // Element is currently checked and has been un-checked
                    } else { 
                        $("#collect_contactinfo").addClass("active");
                    }
                }
            </script>

            <script>
                function HandleCategorySelection() {
                    var category =  document.getElementById("incident_report_category_list").value;
                    console.log('React to category selection = ' + category);
                    if (category.includes('veh')) {
                        $("#collect_carinfo").addClass('active');
                        $("#vehicle_one_info").addClass('active');
                        if (category == 'vehwithveh') {
                            console.log('Show the two vehicle information collection section.');
                            $("#vehicle_one_statement").removeClass('active');
                            $("#vehicle_two_statement").addClass('active');
                            $("#vehicle_two_info").addClass('active');
                            $("#vehicle_two_title").addClass('active');
                            $("#vehicle_one_title").addClass('active');

                            
                            
                        } else {
                            $("#vehicle_one_statement").addClass('active');
                            $("#vehicle_two_statement").removeClass('active');
                            $("#vehicle_two_info").removeClass('active');
                            $("#vehicle_two_title").removeClass('active');
                            $("#vehicle_one_title").removeClass('active');
                            console.log('Show the vehicle information collection section.');
                        }
                    } else {
                        $("#collect_carinfo").removeClass('active');
                        console.log('Do NOT Sow the vehicle information collection section.');
                    }

                }
            </script>

			<script>
			  $( document ).ready(function() {
				var elms = document.querySelectorAll('[id^="button_action_"]');
				for (i = 0; i < elms.length; i++) {
					elms[i].onclick = HandleButtonActionClick;
				}			  
			  });

              document.querySelector('[id="database"]').onclick = ShowAndHideAffiliation;
              document.querySelector('[id="anonymous_report"]').onclick = ShowAndHideContactInfo;
              document.querySelector('[id="incident_report_category_list"]').onchange = HandleCategorySelection;
			
			</script>


	</body>
</html>