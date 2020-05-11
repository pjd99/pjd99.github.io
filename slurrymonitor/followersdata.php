<?php
//setting header to json
header('Content-Type: application/json');
//database
define('DB_HOST', '138.68.133.203');
define('DB_USERNAME', 'qubread');
define('DB_PASSWORD', 'hjhjfgf87$321AD9563852');
define('DB_NAME', 'QUBProjects');



//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
//query to get data from the table
//$query = sprintf("SELECT * FROM temp WHERE nodeName = 'NetvoxR711' ORDER BY dateTime ASC");
//$query = sprintf("SELECT * FROM auger_data WHERE time >= now() - INTERVAL 3 DAY");

//SELECT DATE(sales_time) AS sales_date,
//       SUM(gross) AS total,
//       COUNT(*) AS transactions
//  FROM sales
// GROUP BY DATE(sales_time)
// ORDER BY DATE(sales_time)

// $query = sprintf("SELECT DATE(time) AS date, SUM(Power_on) AS auger_time FROM auger_data WHERE DATE(time) > '2020-01-06' GROUP BY date");
// $query = sprintf("SELECT timestamp, value1, value2 FROM sigfox WHERE timestamp >= now() - INTERVAL 3 DAY AND device_id = 'F5168' ORDER BY timestamp ASC");
$query = sprintf("SELECT time, level FROM slurrymon WHERE time >= now() - INTERVAL 7 DAY ORDER BY time ASC");


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

?>
