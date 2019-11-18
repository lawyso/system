<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
/* Database connection start */
$servername = "localhost";
$username = "dms_user";
$password = "prZ~1SnCk!Y-";
$dbname = "dms_portal";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

// storing  request (ie, get/post) global array to a variable
$requestData = $_REQUEST;


$columns = array(
  // datatable column index  => database column

  0 => 'first_name',
  1 => 'last_name',
  2 => 'topic_id',
  3 =>  'uid'
);

$sql = "SELECT uid,first_name,last_name,topic_id";
$sql .= " FROM d_users_primary WHERE status =1 AND supervisor_id='$myid' AND user_group='2'";

$query = mysqli_query($conn, $sql) or die("Student_list.php: get Assigned Students");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if (!empty($requestData['search']['value'])) {
  // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql .= " AND ( first_name LIKE '%" . $requestData['search']['value'] . "%' ";

  $sql .= " OR last_name LIKE '%" . $requestData['search']['value'] . "%' ";

  $sql .= " OR topic_id LIKE '%" . $requestData['search']['value'] . "%' ";

  $sql .= " OR uid LIKE '" . $requestData['search']['value'] . "%' )";
}

$query = mysqli_query($conn, $sql) or die("Student_list.php: get Assigned Students");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("Student_list.php: get Assigned Students");

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array
  $nestedData = array();

  $nestedData[] = $row["first_name"];
  $nestedData[] = $row["last_name"];
  $nestedData[] = topicName($row["topic_id"]);
  $nestedData[] = encurl($row["uid"]);
  $data[] = $nestedData;
}



$json_data = array(
  "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval($totalData),  // total number of records
  "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
