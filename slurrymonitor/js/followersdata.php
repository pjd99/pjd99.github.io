<?php
//setting header to json
header('Content-Type: application/json');
//database
define('DB_HOST', '209.97.190.53');
define('DB_USERNAME', 'auger01');
define('DB_PASSWORD', 'RFpr0x!Auger');
define('DB_NAME', 'auger');



//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
//query to get data from the table
$query = sprintf("SELECT * FROM auger_data");
//execute query
$result = $mysqli->query($query);
//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);
