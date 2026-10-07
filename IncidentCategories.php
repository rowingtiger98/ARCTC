<?php
/* **************************************************************************************** */
/* Function:     getIncidentCategoryLabel                                                   */
/* Description:  Single source of truth mapping an incident report's stored category code   */
/*               to the human-readable label used across the admin tools (report table,     */
/*               CSV export, and PDF export).                                               */
/* **************************************************************************************** */
function getIncidentCategoryLabel($category) {
	$labels = array(
		'vehwithped' => 'Vehicle with Pedestrian',
		'vehwithveh' => 'Vehicle with Vehicle',
		'vehwithcyc' => 'Vehicle with Cyclist',
		'pedwithcyc' => 'Pedestrian with Cyclist',
		'vehonly'    => 'Vehicle Only',
		'bikeonly'   => 'Bike Only',
	);

	return isset($labels[$category]) ? $labels[$category] : 'Unknown Category';
}
?>
