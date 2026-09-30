
    function HandleButtonActionClick(event) {
    event.preventDefault();

    var action = $(this).attr('action');
    if (action == 'general_message') {
        var ready = true;
        $('[id^="general_required_"]').each( function() {
            var id = $(this).attr('id');
            var elm = document.getElementById(""+id+"").value;
            if (elm.length <= 0) {
                document.getElementById(""+id+"").style.border = "1px solid red";
                ready = false;
            } else {
                document.getElementById(""+id+"").style.border = "1px solid #e6e6e6"; 
            }
        });	
                  
        var category = '';
        var name = $("#general_required_name").val();
        var email = $("#general_required_email").val();
        var street_address = $("#general_required_street").val();
        var city =  $("#general_required_city").val();
        var state =  document.getElementById("general_required_state").value;
        var zip = $("#general_required_zip").val();        
        var affiliation = $("#general_optional_affiliation").val();
        var message = document.getElementById("general_optional_message").value;
        var checkBox = document.getElementById("database");
        if (checkBox.checked) {
            var signup = "yes";
        } else {
            var signup = "no";
        }
        
        var g_recaptcha_response = document.getElementById('g-recaptcha-response').value;
        if(ready) {					    
            $.ajax({
                type: "POST",
                url: "GENERALFunctions.php",
                data: {method:'MailerFunction', action:action, category:category, name:name, email:email, street_address:street_address, city:city, state:state, zip:zip, affiliation:affiliation, message:message, g_recaptcha_response:g_recaptcha_response, signup:signup},
                // data: {method:'MailerFunction', action:action, category:category, name:name, email:email, affiliation:affiliation, message:message, g_recaptcha_response:g_recaptcha_response, signup:signup},
                dataType: 'json',
                success:  function(data){
                //alert(data);
                if (data[0] == 'success') {
                    $("#message_section").html(data[1]);
                } else {
                    $("#message_section").append(data[1]);
                }
                }
            });
        }
    } else if (action == 'incident_report'){
        var ready = true;

        // ---------------------------------------------------------------------------
        // Check the Category Selection
        // ---------------------------------------------------------------------------
        var category_type = document.getElementById("incident_report_category_list");
        console.log(category_type)
        if (category_type.value == "") {
            category_type.style.border="1px solid #ff0000";
            result = false;
        } else {
            category_type.style.border="1px solid #313A4E";
        }

        // ---------------------------------------------------------------------------
        // Check the contact information for missing data unless anonymous is selected.
        // ---------------------------------------------------------------------------
        var anonymous_checkbox = document.getElementById('anonymous_report').checked;
        if (!(anonymous_checkbox)) {
            var file_anonymous = "no";
            console.log('Check the contant information');
            $('[id^="contact_general_required_"]').each( function() {
                var id = $(this).attr('id');
                var elm = document.getElementById(""+id+"").value;
                if (elm.length <= 0) {
                document.getElementById(""+id+"").style.border = "1px solid red";
                ready = false;
                } else {
                        document.getElementById(""+id+"").style.border = "1px solid #e6e6e6"; 
                }                  
            });            
        } else {
            var file_anonymous = "yes";
        }

        // ---------------------------------------------------------------------------
        // Check the general fields for missing information.
        // ---------------------------------------------------------------------------

        $('[id^="general_required_"]').each( function() {
            var id = $(this).attr('id');
            var elm = document.getElementById(""+id+"").value;
            if (elm.length <= 0) {
            document.getElementById(""+id+"").style.border = "1px solid red";
            ready = false;
            } else {
                    document.getElementById(""+id+"").style.border = "1px solid #e6e6e6"; 
            }                  
        });					

        // ---------------------------------------------------------------------------
        // Check the Stay Informed Section for missing fields
        // ---------------------------------------------------------------------------
        var stayinformed_checkbox = document.getElementById('database').checked;
        if (stayinformed_checkbox) {
            console.log('Check the stay informed information');
            var stay_informed = "yes";
            $('[id^="affil_general_required_"]').each( function() {
                var id = $(this).attr('id');
                var elm = document.getElementById(""+id+"").value;
                if (elm.length <= 0) {
                document.getElementById(""+id+"").style.border = "1px solid red";
                ready = false;
                } else {
                    document.getElementById(""+id+"").style.border = "1px solid #e6e6e6"; 
                }                  
            });            
        } else {
            var stay_informed = "no";
        }

        var category = document.getElementById("incident_report_category_list").value;
        var name  = $("#contact_general_required_name").val(); 
        var email = $("#contact_general_required_email").val(); 
        var phone = $("#contact_general_optional_phone").val();
        var incident_date = $("#general_required_date").val();
        var incident_time = $("#general_required_time").val();
        var incident_location = $("#general_required_location").val();
        var incident_description = document.getElementById("general_required_description").value;
        var police_called = document.getElementById("general_optional_police").value;
        var photos_avail = document.getElementById("general_optional_photos").value;

        // Vehicle Information
        var vehicle_one_make = $("#general_optional_carmake_vehilcle1").val();
        var vehicle_one_model = $("#general_optional_carmodel_vehilcle1").val();
        var vehicle_one_color = $("#general_optional_carcolor_vehilcle1").val();
        var vehicle_one_plate = $("#general_optional_platenumber_vehilcle1").val();
        var vehicle_one_state = $("#general_optional_platestate_vehilcle1").val();

        var vehicle_two_make = $("#general_optional_carmake_vehilcle2").val();
        var vehicle_two_model = $("#general_optional_carmodel_vehilcle2").val();
        var vehicle_two_color = $("#general_optional_carcolor_vehilcle2").val();
        var vehicle_two_plate = $("#general_optional_platenumber_vehilcle2").val();
        var vehicle_two_state = $("#general_optional_platestate_vehilcle2").val();

        // Stay Informed Information
        var stay_informed_name = $("#affil_general_required_name").val();
        var stay_informed_email = $("#affil_general_required_email").val();
        var stay_informed_street = $("#affil_general_required_street").val();
        var stay_informed_city = $("#affil_general_required_city").val();
        var stay_informed_state = $("#affil_general_required_state").val();
        var stay_informed_zip = $("#affil_general_required_zip").val();
        var stay_informed_affiliation = $("#general_optional_affiliation").val();

        
        var g_recaptcha_response = document.getElementById('g-recaptcha-response').value;
        if(ready) {					    
            $.ajax({
            type: "POST",
            url: "GENERALFunctions.php",
                data: {
                    method:'MailerFunction',
                    action:action, 
                    category:category,
                    file_anonymous:file_anonymous,                     
                    name:name, 
                    email:email,
                    phone:phone,
                    incident_date:incident_date,
                    incident_time:incident_time,
                    incident_location:incident_location,
                    incident_description:incident_description,                    
                    police_called:police_called, 
                    photos_avail:photos_avail,                     
                    vehicle_one_make:vehicle_one_make,
                    vehicle_one_model:vehicle_one_model,
                    vehicle_one_color:vehicle_one_color,
                    vehicle_one_plate:vehicle_one_plate,
                    vehicle_one_state:vehicle_one_state,
                    vehicle_two_make:vehicle_two_make,
                    vehicle_two_model:vehicle_two_model,
                    vehicle_two_color:vehicle_two_color,
                    vehicle_two_plate:vehicle_two_plate,
                    vehicle_two_state:vehicle_two_state,
                    stay_informed:stay_informed, 
                    stay_informed_name:stay_informed_name,
                    stay_informed_email:stay_informed_email,
                    stay_informed_street:stay_informed_street,
                    stay_informed_city:stay_informed_city,
                    stay_informed_state:stay_informed_state,
                    stay_informed_zip:stay_informed_zip,
                    stay_informed_affiliation:stay_informed_affiliation,
                    g_recaptcha_response:g_recaptcha_response
                },
            dataType: 'json',
            success:  function(data){
                //alert(data);
                if (data[0] == 'success') {
                    $("#incident_report_conatiner").html(data[1]);
                } else {
                    $("#incident_report_conatiner").append(data[1]);
                }
            }
            });
        }
    } else {
        console.log('unknown action');
				}
			  }