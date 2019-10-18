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


  0 => 'first_name',
  1 => 'last_name',
  2 => 'uid',
  3 => 'primary_phone',
  4 => 'primary_email',
  5 => 'proposal_status',
  6 => 'uid'
);


$sql = "SELECT first_name,last_name,primary_phone,primary_email,uid,proposal_status";
$sql .= " FROM d_users_primary WHERE user_group ='2' AND proposal_status in (0,1,2,3,4,5) AND FIND_IN_SET('$myid',supervisor) > 0";
$query = mysqli_query($conn, $sql) or die("student_list.php: get proposal400");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if (!empty($requestData['search']['value'])) {
  // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql .= " AND ( first_name LIKE '" . $requestData['search']['value'] . "%' ";

  $sql .= " OR last_name LIKE '" . $requestData['search']['value'] . "%' ";

  $sql .= " OR primary_email LIKE '" . $requestData['search']['value'] . "%' ";

  $sql .= " OR primary_phone LIKE '" . $requestData['search']['value'] . "%' )";
}

$query = mysqli_query($conn, $sql) or die("student_list.php.php: get defense401");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("student_list.php.php: get defense403");

$data = array();

while ($row = mysqli_fetch_array($query)) {  // preparing an array
  $nestedData = array();


  $nestedData[] = $row["first_name"];
  $nestedData[] = $row["last_name"];
  $nestedData[] = course_name($row["uid"]);
  $nestedData[] = $row["primary_phone"];
  $nestedData[] = $row["primary_email"];
  $nestedData[] = proposal($row["proposal_status"]);
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
