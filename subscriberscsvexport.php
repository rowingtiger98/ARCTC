<?php
include('session.php'); // Restrict this page to logged-in admin panel users.

$ids = array();
$filename = 'ARCTC_Selected_Subscribers.csv';
if (isset($_GET['neighborhood'])) {
	// Export every subscriber in one neighborhood (HOOD_ID), or the 'other' / 'none' groups.
	$group = $_GET['neighborhood'];
	$groupConn = connectDB('kirbypar_arctc_contacts');
	$groups = GetSubscribersByNeighborhood($groupConn);
	closeDB($groupConn);

	if ($group === 'other') {
		$subscribers = $groups['other'];
		$groupName = 'Other';
	} else if ($group === 'none') {
		$subscribers = $groups['none'];
		$groupName = 'No_Neighborhood';
	} else if (isset($groups['hoods'][(int)$group])) {
		$subscribers = $groups['hoods'][(int)$group]['subscribers'];
		$groupName = $groups['hoods'][(int)$group]['HOOD_Name'];
	} else {
		$subscribers = array();
		$groupName = '';
	}

	foreach ($subscribers as $sub) {
		$ids[] = (int)$sub['SUB_ID'];
	}
	$filename = 'ARCTC_'.trim(preg_replace('/[^A-Za-z0-9]+/', '_', $groupName), '_').'_Subscribers.csv';
} else if (isset($_GET['ids'])) {
	foreach (explode(',', $_GET['ids']) as $rawId) {
		$id = (int)$rawId;
		if ($id > 0) {
			$ids[] = $id;
		}
	}
}

if (empty($ids)) {
	http_response_code(400);
	exit('No subscribers to export.');
}

$link = connectDB('kirbypar_arctc_contacts');

$idList = implode(',', $ids); // safe - every element cast to int above
$query = "SELECT * FROM `subscriber_info` WHERE `SUB_ID` IN ($idList) ORDER BY `SUB_Name`";
$result = $link->query($query);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$fp = fopen('php://output', 'wb');
fputcsv($fp, array('Name', 'Email', 'Affiliation', 'Neighborhood', 'Street Address', 'City', 'State', 'Zip', 'Notes'));

if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		fputcsv($fp, array(
			$row['SUB_Name'],
			$row['SUB_Email'],
			$row['SUB_Affiliation'],
			$row['SUB_Neighborhood'],
			$row['SUB_Street_Address'],
			$row['SUB_City'],
			$row['SUB_State'],
			$row['SUB_Zip'],
			$row['SUB_Notes'],
		));
	}
}

fclose($fp);
closeDB($link);
?>
