<?php
  include_once('IncidentCategories.php');

  if(isset($_POST['method'])) {
    $_POST['method']();
  }

/*-------------------------------------------------------------*/
/*                                                             */
/* CSV File Generation Functions 							   */
/*                                                             */
/*-------------------------------------------------------------*/
function DownloadIncidentCSV() {

	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="ARCTC_Incidents.csv"');
    $data = array('Category,Anonymous,Reporter_Name,Reporter_Email,Reporter_Phone,Date,Time,Location,Description,Police_Called,Photos_AVailable,Vehicle_One_Make,Vehicle_One_Model,Vehicle_One_Color,Vehicle_One_Plate,Vehicle_One_State,Vehicle_Two_Make,Vehicle_Two_Model,Vehicle_Two_Color,Vehicle_Two_Plate,Vehicle_Two_State');
	$user_query = "SELECT * FROM arctc_incident_reports";
	$result = $link->query($user_query);
	if ($result->num_rows > 0) {
	  while ($row = mysqli_fetch_assoc($result)) {
            $data[] = getIncidentCategoryLabel($row['INC_Category']).','.
            ($row['INC_File_Anonymously'] == 1?"Yes":"No").','.
            ($row['INC_File_Anonymously'] == 1?"Anonymous":$row['INC_Reporter_Name']).','.
            ($row['INC_File_Anonymously'] == 1?"Anonymous":$row['INC_Reporter_Email']).','.
            ($row['INC_File_Anonymously'] == 1?"Anonymous":$row['INC_Reporter_Phone']).','.
            $row['INC_Date'].','.
            $row['INC_Time'].','.
            str_replace(",", " ", $row['INC_Location']).','.
            str_replace(",", " ", $row['INC_Description']).','.
            ($row['INC_Police_Involved'] == 1?"Yes":"No").','.
            ($row['INC_Photos_Available'] == 1?"Yes":"No").','.
            $row['INC_Vehicle_One_Make'].','.
            $row['INC_Vehicle_One_Model'].','.
            $row['INC_Vehicle_One_Color'].','.
            $row['INC_Vehicle_One_Plate'].','.
            $row['INC_Vehicle_One_State'].','.
            $row['INC_Vehicle_Two_Make'].','.
            $row['INC_Vehicle_Two_Model'].','.
            $row['INC_Vehicle_Two_Color'].','.
            $row['INC_Vehicle_Two_Plate'].','.
            $row['INC_Vehicle_Two_State'].',';            
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

/* **************************************************************************************** */	
/* Function: 		RenderCurrentIncidentReports 											*/
/* Description: 	This function generates the currently stored incident report table.  	*/
/* **************************************************************************************** */
function RenderCurrentIncidentReports() {

	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');
			
	/************************************************/
	/* Search each registered "User" one at a time. */
	/************************************************/
	$user_query = "SELECT * FROM arctc_incident_reports";
	$result = $link->query($user_query);
	if ($result->num_rows > 0) {
	  $output_html = '<table id="current_reports_table" class="current_reports_table"><thead><tr><th>Date / Time</th><th>Category</th><th>Location</th><th>&nbsp;</th></tr></thead><tbody>';
	  while ($row = mysqli_fetch_assoc($result)) {
		$output_html .= '<tr incident_id="'.$row['INC_ID'].'">';
		$output_html .= '<td class="inc_date">'.($row['INC_Date']).' / '.($row['INC_Time']).'</td><td class="inc_category">'.(getIncidentCategoryLabel($row['INC_Category'])).'</td><td>'.($row['INC_Location']).'</td><td><a href="#" id="show_selected_incident_report_'.$row['INC_ID'].'" incident_id="'.trim($row['INC_ID']).'" action="show" class="button small special">Full Details</a> <a href="incidentreportpdf.php?INC_ID='.trim($row['INC_ID']).'" target="_blank" class="button small special">Download PDF</a></td>';
		$output_html .= "</tr>";
	  }
	  $output_html .= "</tbody></table>";
	}
	
	closeDB($link);
	print $output_html;
}

/* **************************************************************************************** */	
/* Function: 		ShowSelectedIncidentReport 											    */
/* Description: 	This function generates the selected incident reports details.        	*/
/* **************************************************************************************** */
function ShowSelectedIncidentReport() {	
    $inc_id = $_POST['inc_id'];
    $output_html = '';
    $output_html .= '<a href="#" id="show_selected_incident_report_all" incident_id="all" action="hide" class="button small special">Back To Reports</a>';

	/***********************/
	/* Setup DB Connection */
	/***********************/
	$link = connectDB('kirbypar_arctc_contacts');    
	$user_query = sprintf("SELECT * FROM arctc_incident_reports WHERE `INC_ID` = %d", $inc_id);
	$result = $link->query($user_query);
	if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        /* Submitter Information Section */
        $output_html .= showSubmitterInformation($row);

        /* Report Details Sections */
        $output_html .= showReportDetailsSection($row);

        /* Vehicle Information */
        if (strpos($row['INC_Category'], "veh") !== false) {
            $output_html .= showVehicleInformation($row, 'One');
        }

        /* Vehicle Two Information */
        if ($row['INC_Category'] == 'vehwithveh') {
            $output_html .= showVehicleInformation($row, 'Two');
        } 
        
        /* Printer Friendly Link */
        $output_html .= '<br><a href="incidentreportprintfriendly.php?INC_ID='.trim($row['INC_ID']).'" id="show_printer_friendly_version" class="button small special">Printer Friendly Version</a>';

	}
	
	closeDB($link);
    print ($output_html);        

}

/* **************************************************************************************** */	
/* Function: 		showSubmitterInformation 											    */
/* Description: 	This function generates the submitter details for an indident report. 	*/
/* **************************************************************************************** */
function showSubmitterInformation($row) {
    if($row['INC_File_Anonymously']) {
        $output_html = '<div id="collect_contactinfo" class="12u collect_contactinfo active" style="margin-top:2em;">';
        $output_html .= '    <h3>Reporter Information</h3>';
        $output_html .= "       This report was filled out ANONYMOUSLY.";
        $output_html .= '</div>';
        $output_html .= '<div class="12u$" style="border-bottom:1px solid black;margin: 10px 0;"></div>';
  
    } else {
        $output_html = '<div id="collect_contactinfo" class="12u collect_contactinfo active" style="margin-top:2em;">';
        $output_html .= '    <h3>Reporter Information</h3>';
        $output_html .= '    <div class="row uniform"> ';
        $output_html .= '        <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">';
        $output_html .= '            <label for="name">Reporter Name';
        $output_html .= '            <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>';
        $output_html .= '            </label>';
        $output_html .= '            <input type="text" name="name" id="contact_general_required_name" readonly value="'.($row['INC_Reporter_Name']).'"/>';
        $output_html .= '        </div>';

        $output_html .= '        <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">';
        $output_html .= '            <label for="email">Reporter Email';
        $output_html .= '            <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>';
        $output_html .= '            </label>';
        $output_html .= '            <input type="email" name="email" id="contact_general_required_email" readonly value='.$row['INC_Reporter_Email'].' />';
        $output_html .= '        </div> ';

        $output_html .= '        <div class="4u 4u(large) 12u(medium) 12u$(xsmall)">';
        $output_html .= '            <label for="phone">Reporter Phone</label>';
        $output_html .= '            <input type="text" name="phone" id="contact_general_optional_phone" readonly value="'.$row['INC_Reporter_Phone'].'"/>';
        $output_html .= '        </div> ';                                           
        $output_html .= '    </div>';
        $output_html .= '</div>';  
        $output_html .= '<div class="12u$" style="border-bottom:1px solid black;margin: 10px 0;"></div>';

    }

    return $output_html;
}

/* **************************************************************************************** */	
/* Function: 		showReportDetailsSection 											    */
/* Description: 	This function generates the report's details of an indident report. 	*/
/* **************************************************************************************** */
function showReportDetailsSection($row) {
    $output_html =  '<div class="row uniform">';
    $output_html .= '<div class="4u 6u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '    <label for="date">Incident Date</label>';
    $output_html .= '    <input type="date" name="date" id="general_required_date"  value="'.$row['INC_Date'].'"/>';
    $output_html .= '</div> ';

    $output_html .= '<div class="4u 6u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '    <label for="time">Incident Time <span style="font-weight:400;text-transform:none;font-family:san-serif;">(ex. 9:35AM)</span></label>';
    $output_html .= '    <input type="time" name="time" id="general_required_time" value="'.$row['INC_Time'].'"/>';
    $output_html .= '</div> ';

    $output_html .= '<div class="2u 6u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '    <label for="police">Police Contacted</label>';
    $output_html .= '    <input type="text" name="police" id="general_required_police" value="'.($row['INC_Police_Involved'] == 1?"Yes":"No").'"/>';
    $output_html .= '</div> ';

    $output_html .= '<div class="2u 6u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '    <label for="photos">Photos / Video Avail</label>';
    $output_html .= '    <input type="text" name="photos" id="general_required_photos" value="'.($row['INC_Photos_Available'] == 1?"Yes":"No").'"/>';
    $output_html .= '</div>';

    $output_html .= '<div class="12u">';
    $output_html .= '    <label for="location">Incident Location';
    $output_html .= '    <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span></label>';
    $output_html .= '    <input type="text" name="location" id="general_required_location" value="'.$row['INC_Location'].'"/>';
    $output_html .= '</div>                                    ';

    $output_html .= '<div class="12u$">';
    $output_html .= '    <label for="message">Incident Description';
    $output_html .= '    <span style="color:#ff0000;font-size: 2.5em;position: absolute;padding: 7px 0 0 4px;">*</span>';
    $output_html .= '    </label>';
    $output_html .= '    <textarea name="message" id="general_required_description" rows="5">'.$row['INC_Description'].'</textarea>';
    $output_html .= '</div>';
    $output_html .= '</div>';    

    return $output_html;
}

/* **************************************************************************************** */	
/* Function: 		showVehicleInformation 										            */
/* Description: 	This function generates the report's details for the vehicle(s) in an   */
/*                  incident report.                                                        */
/* **************************************************************************************** */
function showVehicleInformation($row, $vehicle) {

    
    $output_html =  '<br><br><h3>Vehicle Information</h3>';
    $output_html .= '<div id="vehicle_one_info" class="vehicle_block active">';
    $output_html .= '    <span id="vehicle_one_title" class="vehicle_block active" style="margin-top: 1em;color:#ff0000;font-weight:600;">Vehicle '.$vehicle.':</span>';
    $output_html .= '    <div class="row uniform">                       ';
    $output_html .= '        <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '            <label for="carmake_vehilcle1">Vehicle Make</label>';
    $output_html .= '            <input type="text" name="carmake_vehilcle1" id="general_optional_carmake_vehilcle1" value="'.$row['INC_Vehicle_'.$vehicle.'_Make'].'"/>';
    $output_html .= '        </div>';
            
    $output_html .= '        <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '            <label for="carmodel_vehilcle1">Vehicle Model</label>';
    $output_html .= '            <input type="text" name="carmodel_vehilcle1" id="general_optional_carmodel_vehilcle1" value="'.$row['INC_Vehicle_'.$vehicle.'_Model'].'"/>';
    $output_html .= '        </div> ';

    $output_html .= '        <div class="3u 3u(large) 6u(medium) 12u$(xsmall)">';
    $output_html .= '            <label for="carcolor_vehilcle1">Color</label>';
    $output_html .= '            <input type="text" name="carcolor_vehilcle1" id="general_optional_carcolor_vehilcle1" value="'.$row['INC_Vehicle_'.$vehicle.'_Color'].'"/>';
    $output_html .= '        </div>';
            
    $output_html .= '        <div class="2u 2u(large) 4u(medium) 12u$(xsmall)">';
    $output_html .= '            <label for="platenumber_vehilcle1">License Plate </label>';
    $output_html .= '            <input type="text" name="platenumber_vehilcle1" id="general_optional_platenumber_vehilcle1" value="'.$row['INC_Vehicle_'.$vehicle.'_Plate'].'"/>';
    $output_html .= '        </div>';

    $output_html .= '        <div class="1u 1u(large) 2u$(medium) 12u$(xsmall)">';
    $output_html .= '            <label for="platestate_vehilcle1">State</label>';
    $output_html .= '            <input type="text" name="platestate_vehilcle1" id="general_optional_platestate_vehilcle1" value="'.$row['INC_Vehicle_'.$vehicle.'_State'].'"/>';
    $output_html .= '        </div>';
    $output_html .= '    </div> ';
    $output_html .= '</div>';

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


?>
