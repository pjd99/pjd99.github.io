<?php

/* Database connection start */
$servername = "138.68.133.203";
$username = "qubread";
$password = "hjhjfgf87$321AD9563852";
$dbname = "QUBProjects";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
	0 => 'id',
	1 => 'time',
	2 => 'tankmax',
  	3 => 'sensordist',
  	4 => 'level',
  //	5 => 'batt',


);

// getting total number records without any search

//$sql = "id, time, power_on, ";
//$sql.= "";
$sql = "SELECT * FROM slurrymon";
$query=mysqli_query($conn, $sql) or die("sensor-grid-data.php: get sensors 1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


//$sql = "SELECT ID, dateTime, current, ";
//$sql.= "FROM useData ";
$sql = "SELECT * FROM slurrymon";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( time LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR id LIKE '".$requestData['search']['value']."%' )";
//	$sql.=" OR temp LIKE '".$requestData['search']['value']."%' ";
//	$sql.=" OR hum LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("sensor-grid-data.php: get sensors 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("sensor-grid-data.php: get sensors 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();
	$nestedData[] = $row["id"];
	$nestedData[] = $row["time"];
	$nestedData[] = $row["tankmax"];
  	$nestedData[] = $row["sensordist"];
  	$nestedData[] = $row["level"];
//  	$nestedData[] = $row["batt"];


	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
