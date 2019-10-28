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



  0 => 'course_name',
  1 => 'course_duration',
  2 => 'status'

);
$my_dept = fetchrow('d_users_primary', "uid='$myid'", "department");

$sql = "SELECT course_name,course_duration,status";
$sql .= " FROM d_courses WHERE status in (1,2) AND department_tag='$my_dept'";

$query = mysqli_query($conn, $sql) or die("course_list.php: get Courses");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if (!empty($requestData['search']['value'])) {
  // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql .= " AND ( course_name LIKE '%" . $requestData['search']['value'] . "%' ";

  $sql .= " OR course_duration LIKE '" . $requestData['search']['value'] . "%' ";

  $sql .= " OR status LIKE '" . $requestData['search']['value'] . "%' )";
}
$query = mysqli_query($conn, $sql) or die("Course_list.php: get Courses" . mysqli_connect_error());
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query = mysqli_query($conn, $sql) or die("dep_list.php: get Users401");

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array
  $nestedData = array();

  $nestedData[] = $row["course_name"];
  $nestedData[] = $row["course_duration"];
  $nestedData[] = item_state($row["status"]);
  $data[] = $nestedData;
}



$json_data = array(
  "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval($totalData),  // total number of records
  "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
