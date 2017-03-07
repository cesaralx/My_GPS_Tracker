<?php

header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" ); 
header( "Cache-Control: no-cache, must-revalidate" ); 
header( "Pragma: no-cache" );

$date1 = $date2 = $date3 = $date4 = $date5 = $date6 = $date7 =
	$lat1 = $lon1 = $lat2 = $lon2 = $lat3 = $lon3 = $lat4 = $lon4 =
	$lat5 = $lon5 = $lat6 = $lon6 = $lat7 = $lon7 = '';

$date_lat_lon1 = rtrim(file_get_contents("gps-position-team1.txt"));
$date_lat_lon2 = rtrim(file_get_contents("gps-position-team2.txt"));
$date_lat_lon3 = rtrim(file_get_contents("gps-position-team3.txt"));
$date_lat_lon4 = rtrim(file_get_contents("gps-position-team4.txt"));
$date_lat_lon5 = rtrim(file_get_contents("gps-position-team5.txt"));
$date_lat_lon6 = rtrim(file_get_contents("gps-position-team6.txt"));
$date_lat_lon7 = rtrim(file_get_contents("gps-position-team7.txt"));

if ($date_lat_lon1) {
	list($date1, $lat1, $lon1) = explode("_", $date_lat_lon1);
}
if ($date_lat_lon2) {
	list($date2, $lat2, $lon2) = explode("_", $date_lat_lon2);
}
if ($date_lat_lon3) {
	list($date3, $lat3, $lon3) = explode("_", $date_lat_lon3);
}
if ($date_lat_lon4) {
	list($date4, $lat4, $lon4) = explode("_", $date_lat_lon4);
}
if ($date_lat_lon5) {
	list($date5, $lat5, $lon5) = explode("_", $date_lat_lon5);
}
if ($date_lat_lon6) {
	list($date6, $lat6, $lon6) = explode("_", $date_lat_lon6);
}
if ($date_lat_lon7) {
	list($date7, $lat7, $lon7) = explode("_", $date_lat_lon7);
}
	
if ($lat1 && 'lon1') {
	$latlon[] = $lat1 . "_" . $lon1;
} else {
	$latlon[] = '';
}
if ($lat2 && 'lon2') {
	$latlon[] = $lat2 . "_" . $lon2;
} else {
	$latlon[] = '';
}
if ($lat3 && 'lon3') {
	$latlon[] = $lat3 . "_" . $lon3;
} else {
	$latlon[] = '';
}
if ($lat4 && 'lon4') {
	$latlon[] = $lat4 . "_" . $lon4;
} else {
	$latlon[] = '';
}
if ($lat5 && 'lon5') {
	$latlon[] = $lat5 . "_" . $lon5;
} else {
	$latlon[] = '';
}
if ($lat6 && 'lon6') {
	$latlon[] = $lat6 . "_" . $lon6;
} else {
	$latlon[] = '';
}
if ($lat7 && 'lon7') {
	$latlon[] = $lat7 . "_" . $lon7;
} else {
	$latlon[] = '';
}

require_once('json.php');
$json = new Services_JSON();
print $json->encode($latlon);
?>