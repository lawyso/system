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
  // datatable column index  => database column name


  0 => 'topic_name',
  1 => 'created_by',
  2 => 'topic_id'

);

$sql = "SELECT created_by,topic_name,topic_id";
$sql .= " FROM d_topics WHERE status ='4'";

$query = mysqli_query($conn, $sql) or die("Global_Research_list.php: get Research Topics");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if (!empty($requestData['search']['value'])) {
  // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql .= " AND ( topic_name LIKE '%" . $requestData['search']['value'] . "%' ";

  $sql .= " OR topic_id LIKE '" . $requestData['search']['value'] . "%' ";

  $sql .= " OR created_by LIKE '" . $requestData['search']['value'] . "%' )";
}

$query = mysqli_query($conn, $sql) or die("Global_Research_list.php: get Research Topics");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("Global_Research_list.php: get Research Topics");

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array
  $nestedData = array();

  $nestedData[] = $row["topic_name"];
  $nestedData[] = profileName($row["created_by"]);
  $nestedData[] = profileName(supervisor($row["created_by"]));
  $data[] = $nestedData;
}

$json_data = array(
  "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval($totalData),  // total number of records
  "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
