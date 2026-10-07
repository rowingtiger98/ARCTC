<?php
  if(isset($_POST['method'])) {
    $_POST['method']();
  }

/* ************************************************************************ */
/* Funciton:    ConvertYesOrNoToInteger                                	    */
/* Description: This function takes a yes or no value and convert to 0 or 1.*/
/* Returns:     0 or 1                                        				*/
/* ************************************************************************ */
function ConvertYesOrNoToInteger($string) {
    if($string == 'unknown') {
        $int_value = 0;
    } else {
        $int_value = ($string == 'yes') ? 1 : 0;
    }
    return($int_value);
}


/* ************************************************************************ */
/* Funciton:    MailerFunction                                       	    */
/* Description: This function sends the message from the web page.          */
/* Returns:     Nothing                                        				*/
/* ************************************************************************ */
  function MailerFunction() {
	$action = $_POST['action'];
	$results = array();
	
	$captcha;
	if(isset($_POST['g_recaptcha_response'])){
      $captcha=$_POST['g_recaptcha_response'];
    } else { print "NOPE";}
	
	$secretKey = '6LcpQMUaAAAAAOb5hIByJCiJwvHeIm91XdKnZet7';	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) {
	  $results[] =  'failed';
      $results[] =  '<h3 style="color:red;">Please check the the captcha form and re-send</h3>';
    } else {
	  $escapeConn = connectDB('kirbypar_arctc_contacts');
	  switch($action) {
	  	case('general_message'):
          $name = $_POST['name'];
          $street_address = $_POST['street_address'];
          $city = $_POST['city'];
          $state = $_POST['state'];
          $zip = $_POST['zip'];
          $affiliation = $_POST['affiliation'];
          $email = $_POST['email'];
          $message = $_POST['message'];
          $signup = $_POST['signup'];	  	  
	  	  $ip = $_SERVER['REMOTE_ADDR'];
	  	  $to      = 'ARCTC2021@gmail.com';
	  	  $subject = sprintf('Message from %s, sent from the ARCTC contact page.', $name);
		  if ($signup == "yes") {
			$email_message = sprintf('The following message was sent via the ARCTC website from:<br><br> <b>Name:</b> %s <br><b>Email Address:</b> %s <br><b>Address:</b>%s : %s, %s %s<br><b>Affiliation:</b> %s <br><B>ADD THEM TO THE GROUP</b><br><br><b>Message:</b> %s', $name, $email, $street_address, $city, $state, $zip, $affiliation, $message);			  
		  } else {
			$email_message = sprintf('The following message was sent via the ARCTC website from:<br><br> <b>Name:</b> %s <br><b>Email Address:</b> %s <br><b>Address:</b>%s : %s, %s %s<br><b>Affiliation:</b> %s <br><br><br><b>Message:</b> %s', $name, $email, $street_address, $city, $state, $zip, $affiliation, $message);
		  }
	  	  $headers = 'MIME-Version: 1.0' . "\r\n" .
	  	  			'From: general.info@arctc.org' . "\r\n" .
	  	  			'CC: rhamner@gmail.com, soaronfoot@mindspring.com' . "\r\n" .
	  	  			'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
	  	  			'Reply-To: general.info@arctc.org' . "\r\n" .
	  	  			'X-Mailer: PHP/' . phpversion();
		  		  
	  	  mail($to, $subject, $email_message, $headers);
		  
		  if ($signup == 'yes') {
		    $insert_query = sprintf("INSERT INTO `subscriber_info` (`SUB_Name`, `SUB_Email`, `SUB_Affiliation`, `SUB_Street_Address`, `SUB_City`, `SUB_State`, `SUB_Zip`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		      $escapeConn->real_escape_string($name),
		      $escapeConn->real_escape_string($email),
		      $escapeConn->real_escape_string($affiliation),
		      $escapeConn->real_escape_string($street_address),
		      $escapeConn->real_escape_string($city),
		      $escapeConn->real_escape_string($state),
		      $escapeConn->real_escape_string($zip));
		    $dbresults = CreateNewTableRow('kirbypar_arctc_contacts', 'subscriber_info', $insert_query);
		    $results[] =  "success";
	  	    $results[] =  "Thank you for your message. Your contact information has been added to the ARCTC mailing list and an ARCTC representative will be in contact with you shortly.";
		  } else {
		    $results[] =  "success";
	  	    $results[] =  "Thank you for your message. An ARCTC representative will be in contact with you shortly.";
		  }
	  	break;
	  	  	
        case('incident_report'):

          // Insert the Incident Report into the system.
          $category = $_POST['category'];
          $file_anonymous = $_POST['file_anonymous'];                     
          $name = $_POST['name']; 
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $incident_date = $_POST['incident_date'];
          $incident_time = $_POST['incident_time'];
          $incident_location = $_POST['incident_location'];
          $incident_description = $_POST['incident_description'];                    
          $police_called = $_POST['police_called']; 
          $photos_avail = $_POST['photos_avail'];                     
          $vehicle_one_make = $_POST['vehicle_one_make'];
          $vehicle_one_model = $_POST['vehicle_one_model'];
          $vehicle_one_color = $_POST['vehicle_one_color'];
          $vehicle_one_plate = $_POST['vehicle_one_plate'];
          $vehicle_one_state = $_POST['vehicle_one_state'];
          $vehicle_two_make = $_POST['vehicle_two_make'];
          $vehicle_two_model = $_POST['vehicle_two_model'];
          $vehicle_two_color = $_POST['vehicle_two_color'];
          $vehicle_two_plate = $_POST['vehicle_two_plate'];
          $vehicle_two_state = $_POST['vehicle_two_state'];
          $stay_informed = $_POST['stay_informed']; 
          $stay_informed_name = $_POST['stay_informed_name'];
          $stay_informed_email = $_POST['stay_informed_email'];
          $stay_informed_street = $_POST['stay_informed_street'];
          $stay_informed_city = $_POST['stay_informed_city'];
          $stay_informed_state = $_POST['stay_informed_state'];
          $stay_informed_zip = $_POST['stay_informed_zip'];
          $stay_informed_affiliation = $_POST['stay_informed_affiliation'];

          $contact_phone = $_POST['phone'];
          $incident_date = $_POST["incident_date"];
          $police_called_text = $_POST['police_called'];
          $photos_avail_text = $_POST['photos_avail'];
          
          switch($category) {
            case('vehwithped'):
                $category_string = 'Vehicle vs. Pedestrian';
            break;

            case('vehwithcyc'):
                $category_string = 'Vehicle vs. Cyclist';
            break;

            case('vehwithveh'):
                $category_string = 'Vehicle vs. Vehicle';
            break;

            case('pedwithcyc'):
                $category_string = 'Pedestrian vs. Bicycle';
            break;

            case('vehonly'):
                $category_string = 'Vehicle Only';
            break;

            case('bikeonly'):
                $category_string = 'Bicycle Only';
            break;                        

            default:
                $category_string = 'Unknown Category';
            break;
          }

          $insert_query = sprintf("INSERT INTO `arctc_incident_reports` 
          (`INC_Category`,
          `INC_File_Anonymously`,
          `INC_Reporter_Name`,
          `INC_Reporter_Email`,
          `INC_Reporter_Phone`,
          `INC_Date`,
          `INC_Time`,
          `INC_Location`,
          `INC_Description`, 
          `INC_Police_Involved`, 
          `INC_Photos_Available`,
          `INC_Vehicle_One_Make`,
          `INC_Vehicle_One_Model`,
          `INC_Vehicle_One_Color`,
          `INC_Vehicle_One_Plate`,
          `INC_Vehicle_One_State`,
          `INC_Vehicle_Two_Make`,
          `INC_Vehicle_Two_Model`,
          `INC_Vehicle_Two_Color`,
          `INC_Vehicle_Two_Plate`,
          `INC_Vehicle_Two_State`)           
          VALUES 
          ('%s',
          %d, 
          '%s', 
          '%s', 
          '%s', 
          '%s', 
          '%s',
          '%s',
          '%s',
          %d, 
          %d, 
          '%s', 
          '%s', 
          '%s',
          '%s',
          '%s',
          '%s', 
          '%s', 
          '%s',
          '%s',
          '%s')",
           
           $escapeConn->real_escape_string($category),
           ConvertYesOrNoToInteger($file_anonymous),
           $escapeConn->real_escape_string($name),
           $escapeConn->real_escape_string($email),
           $escapeConn->real_escape_string($contact_phone),
           $escapeConn->real_escape_string($incident_date),
           $escapeConn->real_escape_string($incident_time),
           $escapeConn->real_escape_string($incident_location),
           $escapeConn->real_escape_string($incident_description),
           ConvertYesOrNoToInteger($police_called_text),
           ConvertYesOrNoToInteger($photos_avail_text),
           $escapeConn->real_escape_string($vehicle_one_make),
           $escapeConn->real_escape_string($vehicle_one_model),
           $escapeConn->real_escape_string($vehicle_one_color),
           $escapeConn->real_escape_string($vehicle_one_plate),
           $escapeConn->real_escape_string($vehicle_one_state),
           $escapeConn->real_escape_string($vehicle_two_make),
           $escapeConn->real_escape_string($vehicle_two_model),
           $escapeConn->real_escape_string($vehicle_two_color),
           $escapeConn->real_escape_string($vehicle_two_plate),
           $escapeConn->real_escape_string($vehicle_two_state));

          $dbresults = CreateNewTableRow('kirbypar_arctc_contacts', 'arctc_incident_reports', $insert_query);

          if( strpos($category, 'veh') !== false) {
            if ($category == 'vehwithveh') {
                $vehicle_information = '<h4>Vehicle One Information</h4>
                <b>Vehicle Make:</b>'.$vehicle_one_make.'<br><b>Vehicle Model:</b> '.$vehicle_one_model.'<br><b>Vehicle Color:</b> '.$vehicle_one_color.'<br><b>Vehicle Plate:</b> '.$vehicle_one_plate.'<br><b>Vehicle State:</b> '.$vehicle_one_state.'
                <h4>Vehicle Two Information</h4>
                <b>Vehicle Make:</b>'.$vehicle_two_make.'<br><b>Vehicle Model:</b> '.$vehicle_two_model.'<br><b>Vehicle Color:</b> '.$vehicle_two_color.'<br><b>Vehicle Plate:</b> '.$vehicle_two_plate.'<br><b>Vehicle State:</b> '.$vehicle_two_state.'<br><br><br>';

            } else {
                $vehicle_information = '<h4>Vehicle Information</h4><b>Vehicle Make:</b> '.$vehicle_one_make.'<br><b>Vehicle Model:</b> '.$vehicle_one_model.'<br><b>Vehicle Color:</b> '.$vehicle_one_color.'<br><b>Vehicle Plate:</b> '.$vehicle_one_plate.'<br><b>Vehicle State:</b> '.$vehicle_one_state.'<br><br><br>';
            }
          } else {
            $vehicle_information = '<b>Vehicle Information</b><br>There were no vehicles involved in this incident.<br><br>';
          }

          if ($stay_informed == "yes") {
            $stay_informed_text = 'This person has asked, and has been added to, the ARCTC contacts database.';
          } else {
            $stay_informed_text = '';
          }

          if($dbresults['success'] == 1){
            $ip = $_SERVER['REMOTE_ADDR'];
            $to      = 'general.info@arctc.org';
            $subject = sprintf('%s Incident Report sent from the ARCTC web page.', $category_string);

            $email_message = sprintf('The following incident report was sent via the ARCTC website from:<br><br>
            <h3>%s Report</h3>%s<b>Incident Date:</b> %s<br><b>Incident Time:</b> %s<br><b>Incident Location:</b> %s<br><b>Police Contacted:</b> %s<br><b>Photos / Video Available:</b> %s<br><b>Incident Description:</b> %s<br><br>
            %s%s'
            ,$category_string, 
            ($file_anonymous == 'yes' ? '<b>Reported By:</b> Anonymous Reporter<br><br>' : '<b>Reporter Name:</b> '.$name.'<br><b>Reporter Email:</b> '.$email.'<br><b>Reporter Phone:</b> '.$contact_phone.'<br><br>'),
            $incident_date,
            date('g:i A', strtotime($incident_time)),
            $incident_location,
            $police_called_text,
            $photos_avail_text,
            $incident_description,
            $vehicle_information,
            $stay_informed_text);

            $headers = 'MIME-Version: 1.0' . "\r\n" .
                        'From: general.info@arctc.org' . "\r\n" .
                        'CC: rhamner@gmail.com, soaronfoot@mindspring.com' . "\r\n" .
                        'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                        'Reply-To: general.info@arctc.org' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    
            mail($to, $subject, $email_message, $headers);
            if ($stay_informed == 'yes') {
                $insert_query2 = sprintf("INSERT INTO `subscriber_info` 
                (`SUB_Name`, 
                `SUB_Email`, 
                `SUB_Street_Address`,
                `SUB_City`,
                `SUB_State`,
                `SUB_Zip`,
                `SUB_Affiliation`) 
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                $escapeConn->real_escape_string($stay_informed_name),
                $escapeConn->real_escape_string($stay_informed_email),
                $escapeConn->real_escape_string($stay_informed_street),
                $escapeConn->real_escape_string($stay_informed_city),
                $escapeConn->real_escape_string($stay_informed_state),
                $escapeConn->real_escape_string($stay_informed_zip),
                $escapeConn->real_escape_string($stay_informed_affiliation));

                $dbresults2 = CreateNewTableRow('kirbypar_arctc_contacts', 'subscriber_info', $insert_query2);
                if($dbresults['success'] == 1){
                    $results[] =  "success";
                    $results[] =  '<div style="margin:5em 1em; padding:1em;">Thank you for your incident report. The report has been saved and your contact information has been added to our records.</div>';
                } else {
                    $results[] =  "success";
                    $results[] =  '<div style="margin:5em 1em; padding:1em;">Thank you for your incident report. The report has been saved. However, your contact information failed to be added to our records. We will investigate this and determine where the error occurred.</div>';
		  }
            } else {
                $results[] =  "success";
                $results[] =  '<div style="margin:5em 1em; padding:1em;">Thank you for your incident report. If needed, an ARCTC representative will be in contact with you shortly.</div>';
                $results[] = $insert_query;
            }
          } else {
                  $results[] =  "fail";
                  $results[] =  '<div style="margin:5em 1em; padding:1em;">The incident report was not entered into the system. ERROR = '.$insert_query.'</div>';		
          }
          
          




	  	break;
	  	  	
	  	default:
	  	break;
	  }
	  closeDB($escapeConn);
	}

	echo json_encode($results);
  }	

  
/*-------------------------------------------------------------*/
/*                                                             */
/* CSV File Generation Functions 							   */
/*                                                             */
/*-------------------------------------------------------------*/
function DownloadSubscriberCSV() {
	
	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="ARCTC_Subscribers.csv"');
    $data = array('Name,Email_Address,Street_Address,City,State,Zip,Affiliation');

	$user_query = "SELECT * FROM subscriber_info";
	$result = $link->query($user_query);
	if ($result->num_rows > 0) {
	  while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row['SUB_Name'].','.$row['SUB_Email'].','.$row['SUB_Street_Address'].','.$row['SUB_City'].','.$row['SUB_State'].','.$row['SUB_Zip'].','.$row['SUB_Affiliation'];
	  }
	}
	
	closeDB($link);
    
    $fp = fopen('php://output', 'wb');
    foreach ( $data as $line ) {
        $val = explode(",", $line);
        fputcsv($fp, $val);
    }
    fclose($fp);	
	
}


/*-------------------------------------------------------------*/
/*                                                             */
/*  INCIDENT REPORT FUNCTIONS                                  */
/*                                                             */
/*-------------------------------------------------------------*/
function getCategorySelectList() {
    $output_html = '';
    $output_html .= '<select name="incident_report_category_list" id="incident_report_category_list" style="color:rgba(0, 0, 0, 0.7)";>';
    $output_html .= '<option value="" selected disabled hidden>Select an incident category</option>';
  
      $conn = connectDB('kirbypar_arctc_contacts');
      $query = "SELECT * from `arctc_incident_categories` ORDER BY `INC_CAT_ID`";
      $result = $conn->query($query);
      if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $output_html .= '<option value="'.$row['INC_Category_Name'].'">'.$row['INC_Category_Title'].'</option>';
          }
      } else {
          $output_html .= '<option value="new">New Incident Category</option>';
      }
    $output_html .= '</select>';
    
    return $output_html;
}

/*-------------------------------------------------------------*/
/*                                                             */
/*  DATABASE FUNCTIONS                                         */
/*                                                             */
/*-------------------------------------------------------------*/
	 
/* *********************************************************** */
/* Funciton:    MySQLi_connectDB                               */
/* Description: This function create a MySQLi object to the    */
/*              database passed in by the caller.              */
/* Inputs:      $databases - the database to connect to.       */
/* Returns:     $mysqli - the MySQLi object.                   */
/* *********************************************************** */
function connectDB($database) {

  $mysqli = new mysqli('localhost', 'kirbypar_arctc', 'l8}Xeen84A~9', $database);
  if ($mysqli->connect_errno) {
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    exit;
  }

  return ($mysqli);

}

/* *********************************************************** */
/* Funciton:    closeDB                                        */
/* Description: This function closes the database in use.      */
/* Inputs:      $DB - The database to close.                   */
/* Returns:     Nothing                                        */
/* *********************************************************** */
function closeDB($DB) {
  //mysql_close($DB);
  $DB->close();
}
  
/* *********************************************************** */
/* Funciton:    CreateNewTableRow                              */
/* Description: This function inserts a new xcoder encode job  */
/*              into the JobSchedule_Information database.     */
/* Inputs:      $database - database connection to modify.     */
/*              $table - table to insert into.                 */
/*              $query - INSERT query string.                  */
/* Returns:     $res - Results array.                          */
/* *********************************************************** */
function CreateNewTableRow($database, $table, $query) {
  $debug = 0;

  $mysqli = connectDB($database);
  $res = array('success' => NULL, 'id_number' => NULL, 'error_num' => NULL, 'err_message' => NULL);
  if (!$result = $mysqli->query($query))
  {
    $res['success'] = 0;
    $res['id_number'] = 0;
    $res['error_num'] = $mysqli->errno;
    $res['err_message'] = $mysqli->error;
  } else {
    $res['success'] = 1;
    $res['id_number'] = $mysqli->insert_id;
    $res['error_num'] = '';
    $res['err_message'] = 'Success';
  }

  if($debug) {
    print "Create New Table Row Results<br>";
    print " - Success: " . $res['success'] . "<br>";
    print " - Insert ID: " . $res['id_number'] . "<br>";
    print " - Error Number " . $res['error_num'] . "<br>";
    print " - Message " . $res['err_message'] . "<br>";
  }

  closeDB($mysqli);

  return ($res);
}  

/* **************************************************************************************** */	
/* Function: 		EnterNewContactManually 												*/
/* Description: 	This function manually enters a contact into the database. 				*/
/* **************************************************************************************** */
function EnterNewContactManually() {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$street_address = $_POST['street_address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$affiliation = $_POST['affiliation'];
	$neighborhood = isset($_POST['neighborhood']) ? trim($_POST['neighborhood']) : '';
	$notes = $_POST['notes'];
	$results = array();

	$escapeConn = connectDB('kirbypar_arctc_contacts');
	$insert_query = sprintf(
		"INSERT INTO `subscriber_info` (`SUB_Name`, `SUB_Email`, `SUB_Affiliation`, `SUB_Neighborhood`, `SUB_Street_Address`, `SUB_City`, `SUB_State`, `SUB_Zip`, `SUB_Notes`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		$escapeConn->real_escape_string($name),
		$escapeConn->real_escape_string($email),
		$escapeConn->real_escape_string($affiliation),
		$escapeConn->real_escape_string($neighborhood),
		$escapeConn->real_escape_string($street_address),
		$escapeConn->real_escape_string($city),
		$escapeConn->real_escape_string($state),
		$escapeConn->real_escape_string($zip),
		$escapeConn->real_escape_string($notes)
	);
	closeDB($escapeConn);

	$dbresults = CreateNewTableRow('kirbypar_arctc_contacts', 'subscriber_info', $insert_query);
	if($dbresults['success'] == 1){
		  $results[] =  "success";
	  	  $results[] =  "".$name." has been added to the ARCTC Email database.";		
	} else {
		  $results[] =  "fail";
	  	  $results[] =  "".$name." failed when being added to the ARCTC email database : ".$dbresults['err_message'].".";		
	}
	
	echo json_encode($results);	
	
}

/* **************************************************************************************** */	
/* Function: 		RenderCurrentContactsTable 												*/
/* Description: 	This function generates the currently stored contacts table.			*/
/* **************************************************************************************** */
function RenderCurrentContactsTable() {	
	
	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');
			
	/************************************************/
	/* Search each registered "User" one at a time. */
	/************************************************/

	$user_query = "SELECT * FROM subscriber_info";
	$result = $link->query($user_query);
	if ($result->num_rows > 0) {
	  $output_html = '<table id="current_contacts_table" class="current_contacts_table"><thead><tr><th>Name</th><th>Email</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Affiliation</th><th>Delete</th></tr></thead><tbody>';
	  while ($row = mysqli_fetch_assoc($result)) {
		$output_html .= '<tr>';
		$output_html .= '<td class="contact_name">'.($row['SUB_Name']).'</td><td class="contact_email">'.$row['SUB_Email'].'</td><td class="contact_email">'.$row['SUB_Street_Address'].'</td><td class="contact_email">'.$row['SUB_City'].'</td><td class="contact_email">'.$row['SUB_State'].'</td><td class="contact_email">'.$row['SUB_Zip'].'</td><td class="contact_email">'.$row['SUB_Affiliation'].'</td><td><a href="#" id="delete_contact_link" SUB_ID="'.$row['SUB_ID'].'">delete</a></td>';	
		$output_html .= "</tr>";
	  }
	  $output_html .= "</tbody></table>";
	}
	
	closeDB($link);
	
	print $output_html;
}



/* **************************************************************************************** */	
/* Function: 		DeleteContactInformation 												*/
/* Description: 	This function deletes the specified contact information from the DB 	*/
/* **************************************************************************************** */
function DeleteContactInformation() {
  $SUB_ID = isset($_POST['SUB_ID']) ? (int)$_POST['SUB_ID'] : 0;

  /***********************/
  /* Setup DB Connection */
  /***********************/
  $mysqli = connectDB('kirbypar_arctc_contacts');
  $delete_query = sprintf("DELETE FROM `subscriber_info` WHERE `SUB_ID` = %d",  $SUB_ID);
  $res = array('success' => NULL, 'message' => NULL);
  if (!$result = $mysqli->query($delete_query))
  {
    $res['success'] = 0;
    $res['message'] = $mysqli->error;
  } else {
    $res['success'] = 1;
    $res['message'] = 'Successfully delete subscriver ID = '.$SUB_ID;
  }
  
  closeDB($mysqli);
  echo json_encode($res);
}

/* **************************************************************************************** */
/* Function: 		RenderSubscriberTable 													*/
/* Description: 	This function generates the subscriber table for the View / Edit		*/
/*					Subscribers admin tool, with an Edit link on each row.					*/
/* **************************************************************************************** */
function RenderSubscriberTable() {

	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');

	$user_query = "SELECT * FROM subscriber_info ORDER BY SUB_Name";
	$result = $link->query($user_query);

	$output_html = '<table id="subscriber_table" class="current_contacts_table"><thead><tr><th><input type="checkbox" id="select_all_subscribers" title="Select / deselect all" /><label for="select_all_subscribers"></label></th><th>Name <a href="#" class="sub_sort_arrow" data-sort-field="name">&#9660;</a></th><th>Email</th><th>Affiliation <a href="#" class="sub_sort_arrow" data-sort-field="affiliation">&#9660;</a></th><th>Neighborhood</th><th>Street Address</th><th>City</th><th>State</th><th>Zip</th><th class="sub_notes_column">Notes</th><th>&nbsp;</th></tr></thead><tbody>';
	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$output_html .= '<tr sub_id="'.$row['SUB_ID'].'">';
			$output_html .= '<td><input type="checkbox" class="sub_select_checkbox" id="sub_select_'.$row['SUB_ID'].'" value="'.$row['SUB_ID'].'" /><label for="sub_select_'.$row['SUB_ID'].'"></label></td>';
			$output_html .= '<td class="sub_field" data-field="name">'.htmlspecialchars($row['SUB_Name']).'</td>';
			$output_html .= '<td class="sub_field" data-field="email"><span class="email_text">'.htmlspecialchars($row['SUB_Email']).'</span> <a href="#" class="copy_email_link" title="Copy email address">&#128203;</a></td>';
			$output_html .= '<td class="sub_field" data-field="affiliation">'.htmlspecialchars($row['SUB_Affiliation']).'</td>';
			$output_html .= '<td class="sub_field" data-field="neighborhood">'.htmlspecialchars($row['SUB_Neighborhood']).'</td>';
			$output_html .= '<td class="sub_field" data-field="street_address">'.htmlspecialchars($row['SUB_Street_Address']).'</td>';
			$output_html .= '<td class="sub_field" data-field="city">'.htmlspecialchars($row['SUB_City']).'</td>';
			$output_html .= '<td class="sub_field" data-field="state">'.htmlspecialchars($row['SUB_State']).'</td>';
			$output_html .= '<td class="sub_field" data-field="zip">'.htmlspecialchars($row['SUB_Zip']).'</td>';
			$output_html .= '<td class="sub_field sub_notes_column" data-field="notes">'.htmlspecialchars($row['SUB_Notes']).'</td>';
			$output_html .= '<td class="sub_actions"><a href="#" id="edit_subscriber_link" sub_id="'.$row['SUB_ID'].'" class="icon fa-pencil sub_action_icon" title="Edit"><span class="label">Edit</span></a><a href="#" id="delete_subscriber_link" sub_id="'.$row['SUB_ID'].'" class="icon fa-trash sub_action_icon" title="Delete"><span class="label">Delete</span></a></td>';
			$output_html .= '</tr>';
		}
	} else {
		$output_html .= '<tr><td colspan="11">No subscribers found.</td></tr>';
	}
	$output_html .= '</tbody></table>';

	closeDB($link);

	print $output_html;
}

/* **************************************************************************************** */
/* Function: 		UpdateSubscriberInformation 											*/
/* Description: 	This function saves edits made to a subscriber's information from the	*/
/*					View / Edit Subscribers admin tool.									*/
/* **************************************************************************************** */
function UpdateSubscriberInformation() {
	$sub_id = isset($_POST['SUB_ID']) ? (int)$_POST['SUB_ID'] : 0;

	$mysqli = connectDB('kirbypar_arctc_contacts');

	$name = $mysqli->real_escape_string($_POST['name']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$affiliation = $mysqli->real_escape_string($_POST['affiliation']);
	$neighborhood = $mysqli->real_escape_string(trim($_POST['neighborhood']));
	$street_address = $mysqli->real_escape_string($_POST['street_address']);
	$city = $mysqli->real_escape_string($_POST['city']);
	$state = $mysqli->real_escape_string($_POST['state']);
	$zip = $mysqli->real_escape_string($_POST['zip']);
	$notes = $mysqli->real_escape_string($_POST['notes']);

	$update_query = sprintf(
		"UPDATE `subscriber_info` SET `SUB_Name` = '%s', `SUB_Email` = '%s', `SUB_Affiliation` = '%s', `SUB_Neighborhood` = '%s', `SUB_Street_Address` = '%s', `SUB_City` = '%s', `SUB_State` = '%s', `SUB_Zip` = '%s', `SUB_Notes` = '%s' WHERE `SUB_ID` = %d",
		$name, $email, $affiliation, $neighborhood, $street_address, $city, $state, $zip, $notes, $sub_id
	);

	$results = array();
	if (!$mysqli->query($update_query)) {
		$results[] = 'fail';
		$results[] = 'Failed to update '.$name.': '.$mysqli->error;
	} else {
		$results[] = 'success';
		$results[] = ''.$name.' has been updated.';
	}

	closeDB($mysqli);
	echo json_encode($results);
}

/* **************************************************************************************** */
/* Function: 		GetNeighborhoodList 													*/
/* Description: 	This function returns the neighborhoods from the arctc_neighborhoods	*/
/*					table as a JSON array of names, sorted alphabetically.					*/
/* **************************************************************************************** */
function GetNeighborhoodList() {
	$mysqli = connectDB('kirbypar_arctc_contacts');

	$neighborhoods = array();
	$result = $mysqli->query("SELECT DISTINCT TRIM(`HOOD_Name`) AS `HOOD_Name` FROM `arctc_neighborhoods` WHERE `HOOD_Name` IS NOT NULL AND TRIM(`HOOD_Name`) <> '' ORDER BY `HOOD_Name`");
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$neighborhoods[] = $row['HOOD_Name'];
		}
	}

	closeDB($mysqli);
	echo json_encode(array_values($neighborhoods));
}

/* **************************************************************************************** */
/* Function: 		NormalizeNeighborhoodName 												*/
/* Description: 	Lower-cases a neighborhood name and collapses spaces so subscriber		*/
/*					entries match the arctc_neighborhoods names the same way the			*/
/*					subscriber edit form does.												*/
/* **************************************************************************************** */
function NormalizeNeighborhoodName($name) {
	return strtolower(preg_replace('/\s+/', ' ', trim((string)$name)));
}

/* **************************************************************************************** */
/* Function: 		GetSubscribersByNeighborhood 											*/
/* Description: 	Groups every subscriber under the matching arctc_neighborhoods row.		*/
/*					Returns the neighborhood rows (with a 'subscribers' list on each), the	*/
/*					subscribers whose neighborhood is not in the table ('other') and the	*/
/*					subscribers with no neighborhood entered ('none').						*/
/* **************************************************************************************** */
function GetSubscribersByNeighborhood($mysqli) {
	$hoods = array();
	$lookup = array();
	$result = $mysqli->query("SELECT `HOOD_ID`, `HOOD_Name`, `HOOD_In_Cor`, `HOOD_Notes` FROM `arctc_neighborhoods` ORDER BY `HOOD_Name`");
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$row['subscribers'] = array();
			$hoods[$row['HOOD_ID']] = $row;
			$key = NormalizeNeighborhoodName($row['HOOD_Name']);
			if ($key != '' && !isset($lookup[$key])) {
				$lookup[$key] = $row['HOOD_ID'];
			}
		}
	}

	$other = array();
	$none = array();
	$result = $mysqli->query("SELECT `SUB_ID`, `SUB_Name`, `SUB_Email`, `SUB_Affiliation`, `SUB_Neighborhood`, `SUB_Street_Address`, `SUB_City` FROM `subscriber_info` ORDER BY `SUB_Name`");
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$key = NormalizeNeighborhoodName($row['SUB_Neighborhood']);
			if ($key == '') {
				$none[] = $row;
			} else if (isset($lookup[$key])) {
				$hoods[$lookup[$key]]['subscribers'][] = $row;
			} else {
				$other[] = $row;
			}
		}
	}

	return array('hoods' => $hoods, 'other' => $other, 'none' => $none);
}

/* **************************************************************************************** */
/* Function: 		RenderNeighborhoodTable 												*/
/* Description: 	This function generates the neighborhood table for the View / Edit		*/
/*					Neighborhoods admin tool, with subscriber counts for each row.			*/
/* **************************************************************************************** */
function RenderNeighborhoodTable() {
	$mysqli = connectDB('kirbypar_arctc_contacts');
	$groups = GetSubscribersByNeighborhood($mysqli);
	closeDB($mysqli);

	$corridor_total = 0;
	foreach ($groups['hoods'] as $hood) {
		if ($hood['HOOD_In_Cor'] == 1) {
			$corridor_total += count($hood['subscribers']);
		}
	}

	$output_html = '<p class="hood_summary">Subscribers in corridor neighborhoods: <b>'.$corridor_total.'</b></p>';
	$output_html .= '<table id="neighborhood_table" class="current_contacts_table"><thead><tr><th>Neighborhood</th><th>In Corridor</th><th>Subscribers</th><th class="sub_notes_column">Notes</th><th>&nbsp;</th></tr></thead><tbody>';
	if (count($groups['hoods']) > 0) {
		foreach ($groups['hoods'] as $hood) {
			$in_cor = ($hood['HOOD_In_Cor'] == 1);
			$output_html .= '<tr hood_id="'.$hood['HOOD_ID'].'" in_cor="'.($in_cor ? 1 : 0).'"'.($in_cor ? '' : ' class="hood_not_in_cor"').'>';
			$output_html .= '<td class="sub_field" data-field="name">'.htmlspecialchars($hood['HOOD_Name']).'</td>';
			$output_html .= '<td class="sub_field">'.($in_cor ? 'Yes' : 'No').'</td>';
			$output_html .= '<td class="sub_field"><a href="#" class="hood_view_subscribers" data-group="'.$hood['HOOD_ID'].'">'.count($hood['subscribers']).'</a> <a href="#" class="hood_view_subscribers hood_view_icon icon fa-search" data-group="'.$hood['HOOD_ID'].'" title="View subscribers"><span class="label">View subscribers</span></a></td>';
			$output_html .= '<td class="sub_field sub_notes_column" data-field="notes">'.htmlspecialchars($hood['HOOD_Notes']).'</td>';
			$output_html .= '<td class="sub_actions"><a href="#" class="hood_edit_link icon fa-pencil sub_action_icon" title="Edit"><span class="label">Edit</span></a></td>';
			$output_html .= '</tr>';
		}
	} else {
		$output_html .= '<tr><td colspan="5">No neighborhoods found.</td></tr>';
	}
	$output_html .= '<tr class="hood_extra_row"><td class="sub_field"><i>Other / not listed</i></td><td class="sub_field">&nbsp;</td><td class="sub_field"><a href="#" class="hood_view_subscribers" data-group="other">'.count($groups['other']).'</a> <a href="#" class="hood_view_subscribers hood_view_icon icon fa-search" data-group="other" title="View subscribers"><span class="label">View subscribers</span></a></td><td class="sub_field sub_notes_column">Subscribers whose neighborhood is not in the list.</td><td>&nbsp;</td></tr>';
	$output_html .= '<tr class="hood_extra_row"><td class="sub_field"><i>No neighborhood entered</i></td><td class="sub_field">&nbsp;</td><td class="sub_field"><a href="#" class="hood_view_subscribers" data-group="none">'.count($groups['none']).'</a> <a href="#" class="hood_view_subscribers hood_view_icon icon fa-search" data-group="none" title="View subscribers"><span class="label">View subscribers</span></a></td><td class="sub_field sub_notes_column">&nbsp;</td><td>&nbsp;</td></tr>';
	$output_html .= '</tbody></table>';

	print $output_html;
}

/* **************************************************************************************** */
/* Function: 		RenderNeighborhoodSubscribers 											*/
/* Description: 	This function generates the list of subscribers for one neighborhood	*/
/*					(HOOD_ID), or for the 'other' / 'none' groups.							*/
/* **************************************************************************************** */
function RenderNeighborhoodSubscribers() {
	$group = isset($_POST['group']) ? $_POST['group'] : '';

	$mysqli = connectDB('kirbypar_arctc_contacts');
	$groups = GetSubscribersByNeighborhood($mysqli);
	closeDB($mysqli);

	if ($group === 'other') {
		$title = 'Other / not listed';
		$subscribers = $groups['other'];
	} else if ($group === 'none') {
		$title = 'No neighborhood entered';
		$subscribers = $groups['none'];
	} else if (isset($groups['hoods'][(int)$group])) {
		$title = $groups['hoods'][(int)$group]['HOOD_Name'];
		$subscribers = $groups['hoods'][(int)$group]['subscribers'];
	} else {
		$title = 'Unknown neighborhood';
		$subscribers = array();
	}

	$output_html = '<h3>'.htmlspecialchars($title).' ('.count($subscribers).')</h3>';
	if (count($subscribers) > 0) {
		$output_html .= '<ul class="actions"><li><a href="subscriberscsvexport.php?neighborhood='.urlencode($group).'" class="button special small" target="_blank">Download CSV File</a></li></ul>';
	}
	$output_html .= '<table class="current_contacts_table"><thead><tr><th>Name</th><th>Email</th><th>Neighborhood (as entered)</th><th>Affiliation</th><th>Street Address</th><th>City</th></tr></thead><tbody>';
	if (count($subscribers) > 0) {
		foreach ($subscribers as $sub) {
			$output_html .= '<tr>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_Name']).'</td>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_Email']).'</td>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_Neighborhood']).'</td>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_Affiliation']).'</td>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_Street_Address']).'</td>';
			$output_html .= '<td>'.htmlspecialchars($sub['SUB_City']).'</td>';
			$output_html .= '</tr>';
		}
	} else {
		$output_html .= '<tr><td colspan="6">No subscribers.</td></tr>';
	}
	$output_html .= '</tbody></table>';

	print $output_html;
}

/* **************************************************************************************** */
/* Function: 		AddNeighborhood 														*/
/* Description: 	This function adds a neighborhood to the arctc_neighborhoods table.		*/
/*					Names already in the table (ignoring case / spaces) are rejected.		*/
/* **************************************************************************************** */
function AddNeighborhood() {
	$name = isset($_POST['name']) ? preg_replace('/\s+/', ' ', trim($_POST['name'])) : '';
	$in_cor = (isset($_POST['in_cor']) && $_POST['in_cor'] == 1) ? 1 : 0;
	$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
	$results = array();

	if ($name == '') {
		$results[] = 'fail';
		$results[] = 'Please enter a neighborhood name.';
		echo json_encode($results);
		return;
	}

	$mysqli = connectDB('kirbypar_arctc_contacts');

	$result = $mysqli->query("SELECT `HOOD_Name` FROM `arctc_neighborhoods`");
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			if (NormalizeNeighborhoodName($row['HOOD_Name']) == NormalizeNeighborhoodName($name)) {
				closeDB($mysqli);
				$results[] = 'fail';
				$results[] = $row['HOOD_Name'].' is already in the neighborhood list.';
				echo json_encode($results);
				return;
			}
		}
	}

	$insert_query = sprintf(
		"INSERT INTO `arctc_neighborhoods` (`HOOD_Name`, `HOOD_In_Cor`, `HOOD_Notes`) VALUES ('%s', %d, '%s')",
		$mysqli->real_escape_string($name),
		$in_cor,
		$mysqli->real_escape_string($notes)
	);

	if (!$mysqli->query($insert_query)) {
		$results[] = 'fail';
		$results[] = 'Failed to add '.$name.': '.$mysqli->error;
	} else {
		$results[] = 'success';
		$results[] = $name.' has been added.';
	}

	closeDB($mysqli);
	echo json_encode($results);
}

/* **************************************************************************************** */
/* Function: 		UpdateNeighborhood 														*/
/* Description: 	This function saves edits to a neighborhood. If the name changes,		*/
/*					subscribers entered under the old name are moved to the new name so		*/
/*					they stay counted under this neighborhood.								*/
/* **************************************************************************************** */
function UpdateNeighborhood() {
	$hood_id = isset($_POST['HOOD_ID']) ? (int)$_POST['HOOD_ID'] : 0;
	$name = isset($_POST['name']) ? preg_replace('/\s+/', ' ', trim($_POST['name'])) : '';
	$in_cor = (isset($_POST['in_cor']) && $_POST['in_cor'] == 1) ? 1 : 0;
	$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
	$results = array();

	if ($name == '') {
		$results[] = 'fail';
		$results[] = 'Please enter a neighborhood name.';
		echo json_encode($results);
		return;
	}

	$mysqli = connectDB('kirbypar_arctc_contacts');

	$old_name = NULL;
	$result = $mysqli->query("SELECT `HOOD_ID`, `HOOD_Name` FROM `arctc_neighborhoods`");
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['HOOD_ID'] == $hood_id) {
				$old_name = $row['HOOD_Name'];
			} else if (NormalizeNeighborhoodName($row['HOOD_Name']) == NormalizeNeighborhoodName($name)) {
				closeDB($mysqli);
				$results[] = 'fail';
				$results[] = $row['HOOD_Name'].' is already in the neighborhood list.';
				echo json_encode($results);
				return;
			}
		}
	}

	if ($old_name === NULL) {
		closeDB($mysqli);
		$results[] = 'fail';
		$results[] = 'That neighborhood no longer exists.';
		echo json_encode($results);
		return;
	}

	$update_query = sprintf(
		"UPDATE `arctc_neighborhoods` SET `HOOD_Name` = '%s', `HOOD_In_Cor` = %d, `HOOD_Notes` = '%s' WHERE `HOOD_ID` = %d",
		$mysqli->real_escape_string($name),
		$in_cor,
		$mysqli->real_escape_string($notes),
		$hood_id
	);

	if (!$mysqli->query($update_query)) {
		closeDB($mysqli);
		$results[] = 'fail';
		$results[] = 'Failed to update '.$name.': '.$mysqli->error;
		echo json_encode($results);
		return;
	}

	$moved = 0;
	if ($name !== $old_name) {
		$old_key = NormalizeNeighborhoodName($old_name);
		$sub_ids = array();
		$result = $mysqli->query("SELECT `SUB_ID`, `SUB_Neighborhood` FROM `subscriber_info`");
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				if (NormalizeNeighborhoodName($row['SUB_Neighborhood']) == $old_key) {
					$sub_ids[] = (int)$row['SUB_ID'];
				}
			}
		}
		if (count($sub_ids) > 0) {
			$mysqli->query(sprintf(
				"UPDATE `subscriber_info` SET `SUB_Neighborhood` = '%s' WHERE `SUB_ID` IN (%s)",
				$mysqli->real_escape_string($name),
				implode(',', $sub_ids)
			));
			$moved = $mysqli->affected_rows;
		}
	}

	closeDB($mysqli);
	$results[] = 'success';
	$results[] = $name.' has been updated.'.($moved > 0 ? ' '.$moved.' subscriber(s) were moved to the new name.' : '');
	echo json_encode($results);
}
?>