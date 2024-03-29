<?php
error_reporting(0);
$emyid = $_SESSION['dms_'];
$myid = decurl($emyid);
$fulldate = date('Y-m-d H:i:s');
$now = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$yr = date('Y');
$mnt = date('m');
$day = date('m');
$thisurl = $_SERVER['REQUEST_URI'];
$c_code = "DMS/001";

function passencrypt($pass)
{
  $oursalt = crazystring(32);  //generate a random number
  $longpass = $oursalt . $pass;                          //Prepend to the password
  $hash = hash('SHA256', $longpass);

  return $hash . $oursalt;
  //save hash and salt in diffrent tables
}
function checkrowexists($table, $where)            ////##########################################Fetch only one row
{
  global $con;
  $query = "SELECT * FROM $table WHERE $where"; //var_dump($query);
  $result = mysqli_query($con, $query);
  $totalrows = mysqli_num_rows($result);
  if ($totalrows > 0) {
    return 1;
  } else {
    return 0;
  }
}
function validate_session($session_id)
{
  $ses = decurl($session_id);
  $valid = checkrowexists('d_users_primary', "uid='$ses'", "uid");
  return $valid;
}

function check_passChange($session_id)
{
  $ses = decurl($session_id);

  $changed_defaultPass = checkrowexists('d_users_primary', "uid='$ses' AND pass_change='1'", "uid");

  return $changed_defaultPass;
}

function session_details($sid)
{
  $rid = decurl($sid);
  return $rid;
}
function profile($sid)
{
  $rid = decurl($sid);
  $d = fetchonerow('d_users_primary', "uid='$rid'");
  $fname = $d['first_name'];
  $lname = $d['last_name'];

  return $fname . ' ' . $lname;
}

function profileName($sid)
{
  $d = fetchonerow('d_users_primary', "uid='$sid'");
  $fname = $d['first_name'];
  $lname = $d['last_name'];
  $title = $d['title'];
  $thead = fetchrow('d_title', "uid='$title'", "name");

  return $thead . ' ' . $fname . ' ' . $lname;
}

function supervisor($sid)
{
  $supId = fetchrow('d_users_primary', "uid='$sid'", "supervisor_id");

  return $supId;
}

function topicName($sid)
{
  $tName = fetchrow('d_topics', "topic_id='$sid'", "topic_name");

  return $tName;
}

function university($sid)
{
  $uniName = fetchrow('d_uni_codes', "u_code='$sid'", "name");

  return $uniName;
}

function user_mail($sid)
{
  $rid = decurl($sid);
  $d = fetchonerow('d_users_primary', "uid='$rid'");
  $email = $d['primary_email'];

  return $email;
}

function usergroup($sid)
{
  $rid = decurl($sid);
  $d = fetchonerow('d_users_primary', "uid='$rid'");
  $u_group = $d['user_group'];

  return $u_group;
}

function usergroup_name($sid)
{
  $rid = usergroup($sid);
  $d = fetchonerow('d_user_groups', "uid='$rid'");
  $u_group_name = $d['group_name'];

  return $u_group_name;
}

function userlevel_name($gid)
{
  $d = fetchonerow('d_user_groups', "uid='$gid'");
  $u_group_name = $d['group_name'];

  return $u_group_name;
}

function emailOk($emaill)
{
  if (filter_var($emaill, FILTER_VALIDATE_EMAIL)) {
    return 1;
  } else {
    return 0;
  }
}

function username($sid)
{

  $rid = decurl($sid);
  $d = fetchonerow('d_users_primary', "uid='$rid'", "user_name");
  $username = $d['user_name'];


  return $username;
}

function generateRandomString($length)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function crazystring($length)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%^*()_+-~{}[];:|.<>';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
function input_available($x)
{
  $x = rtrim($x);
  if (empty($x)) {
    return 0;
  } else {
    return 1;
  }
}
function input_exists($table, $where, $field, $value)
{
  $where = "$field='$value' && $where";
  $ch = checkrowexists($table, $where);
  return $ch;
}


function input_length($x, $l)
{
  $x = rtrim($x);
  if ((strlen($x) < $l)) {
    return 0;
  } else {
    return 1;
  }
}
function input_between($low, $high, $string)
{
  $strlen = strlen($string);
  if ($strlen >= $low && $strlen <= $high) {
    return 1;
  } else {
    return 0;
  }
}
function validate_phone($phone)
{
  if ((strlen($phone)) == 12 && (substr($phone, 0, 3) === "254")) {
    return 1;
  } else {
    return 0;
  }
}

function errormes($x)
{
  return "<div class=\"alert alert-danger alert-dismissible\">$x</div>";
}
function sucmes($x)
{
  return "<div class=\"alert alert-success alert-dismissible\">$x</div>";
}
function success($x)
{
  return "<div class=\"alert successbox alert-dismissible\">$x</div>";
}
function notice($x)
{
  return "<div class=\"alert alert-info alert-dismissible\">$x</div>";
}

function error($x)
{
  return "<span class=\"errorbox\">$x</span>";
}

function fetchrow($table, $where, $name)
{ ///#############Fetch only one row
  global $con;
  $query = "SELECT $name FROM $table WHERE ($where)";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result); //var_dump($query);
  $attrequired = $row[$name];

  return $attrequired;
}
function fetchonerow($table, $where, $fds = '*')
{                ////############Fetch only one row
  global $con;
  $query = "SELECT $fds FROM $table WHERE ($where)";  //var_dump($query);
  $result = mysqli_query($con, $query);
  $roww = mysqli_fetch_array($result);

  return $roww;
}

function deletedata($tb, $did)
{
  global $con;
  $insertd = "DELETE FROM $tb WHERE uid=$did"; //var_dump($insertd);
  if (!mysqli_query($con, $insertd)) {
    return 0;
  } else {
    return 1;
  }
}

function deletetopic($tb, $did)
{
  global $con;
  $insertd = "DELETE FROM $tb WHERE topic_id=$did"; //var_dump($insertd);
  if (!mysqli_query($con, $insertd)) {
    return 0;
  } else {
    return 1;
  }
}

function delete2($tb, $where)
{
  global $con;
  $insertd = "DELETE FROM $tb $where";
  if (!mysqli_query($con, $insertd)) {
    return 0;
  } else {
    return 1;
  }
}

function encurl($id)
{
  $secureId = $id * 1321;
  return $secureId;
}
function decurl($id)
{
  $originalId = $id / 1321;
  return $originalId;
}

function updatedb($tb, $fds, $where)
{
  global $con;
  $insertq = "UPDATE $tb SET $fds WHERE $where"; //var_dump($insertq);

  if (!mysqli_query($con, $insertq)) {
    return mysqli_error($con);
  } else {
    return 1;
  }
}
function addtodb($tb, $fds, $vals)
{
  global $con;
  ////example              // $ffields=array('user_id','module_id','vie','ad','edi','del');
  // $vvals=array("$selectedval","$uuid","0","0","0","0");
  // $iinsertnew=addtodbsilent('user_permissions',$ffields,$vvals);

  /////////________Secure input
  // $vals = array_map('stripslashes', $vals);
  $fields = implode(',', $fds);
  $values = implode("','", $vals);
  $values = "'$values'";

  $insertq = "INSERT into $tb ($fields) VALUES ($values)";
  //echo $insertq;

  if (!mysqli_query($con, $insertq)) {
    return mysqli_error($con); // var_dump($e);
  } else {
    return 1;
  }
}

function fetchtable($table, $category, $orderby, $dir, $limit, $fds = '*')      ////####################################Fetch whole table
{
  global $con;
  $query = "SELECT $fds FROM " . $table . " WHERE " . $category . " ORDER BY " . $orderby . ' ' . $dir . " LIMIT " . $limit;  //var_dump($query);
  $result = mysqli_query($con, $query);

  return $result;
}
function countotal($table, $where, $fds = '*')
{
  global $con;
  $query = "SELECT $fds FROM $table WHERE $where"; //var_dump($query);
  $result = mysqli_query($con, $query);
  $totalrows = mysqli_num_rows($result);
  return $totalrows;
}

function admin_status($state)
{


  if ($state == 0) {
    $status = "<span class=\"label label-default\">Inactive</span>";
  } elseif ($state == 1) {
    $status = "<span class=\"label label-success\">Active</span>";
  } elseif ($state == 2) {
    $status = "<span class=\"label label-success\">Blocked</span>";
  } elseif ($state == 3) {
    $status = "<span class=\"label label-success\">Former</span>";
  }

  return $status;
}

function dateadd($date, $ys, $mts, $dys)
{
  $newtime = strtotime($date . " + $ys years + $mts months   + $dys days");
  return date("Y-m-d", $newtime);
}

function datesub($date, $ys, $mts, $dys)
{
  $newtime = strtotime($date . " - $ys years - $mts months   - $dys days");
  return date("Y-m-d", $newtime);
}

//////////----------------Date functions
function timeago($startdate, $enddate)
{
  $sfdate = strtotime($startdate);
  $sldate = strtotime($enddate);
  $diff = strtotime($enddate) - strtotime($startdate);

  if ($diff < 0) {
    $diff = strtotime($startdate) - strtotime($enddate);
    $m = '-';
  } else {
    $m = '';
    //  echo "[+]";
    // $late=0; $ico='bomb.png'; $color='orange';
  }

  // immediately convert to days
  $temp = $diff / 86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
  // days
  $days = floor($temp);
  $temp = 24 * ($temp - $days);
  // hours
  $hours = floor($temp);
  $temp = 60 * ($temp - $hours);
  // minutes
  $minutes = floor($temp);
  $temp = 60 * ($temp - $minutes);
  // seconds
  $seconds = floor($temp);


  $date_ = date("d M -y", strtotime($startdate));
  $time_ = date("g:i A", strtotime($startdate));

  if ($days == 0 and $hours == 0) {
    return "$minutes mins remaining";
  } elseif ($days == 0 and $hours > 0) {
    return "$hours hrs remaining";
  } elseif ($days == 1) {
    return "Yesterday $time_";
  } elseif ($days > 1) {
    return "$days days remaining";
  } else {
    return 'Expired';
  }
}

function datecompare($date1, $date2)
{
  $date1 = strtotime($date1);
  $date2 = strtotime($date2);

  $diff = $date1 - $date2;
  if ($diff > 0) /////first date is newer than second
  {
    return 1;
  } elseif ($diff < 0) ////fisrt date is older than second
  {
    return -1;
  } elseif ($diff == 0) ///date are the same
  {
    return 0;
  }
}

function file_type($filename, $search_array)
{
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $ext = strtolower($ext);
  if ((!in_array("$ext", $search_array))) {
    return 0;
  } else {
    return 1;
  }
}
function file_size($x, $max)
{
  if (($x > 0) && ($x > $max)) {
    return 0;
  } else {
    return 1;
  }
}

function upload_file($fname, $tmpName, $upload_dir)
{
  $ext = pathinfo($fname, PATHINFO_EXTENSION);
  $nfileName = generateRandomString(10) . '.' . "$ext";

  $filePath = $upload_dir . $nfileName;

  $result = move_uploaded_file($tmpName, $filePath); //var_dump($result);
  if (!$result) {
    return 0;
  } elseif ($result) {
    return $nfileName;
  }
}
function fileext_fetch($filename)
{
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  return $ext;
}

function course_name($id)
{
  $co = fetchrow('d_users_courses', "user='$id' AND status=1", "course");
  $cos = fetchrow('d_courses', "uid='$co'", "course_name");
  return $cos;
}

function department($id)
{
  $dep = fetchrow('d_departments', "uid='$id'", "department_name");
  return $dep;
}
function school($id)
{
  $sc = fetchrow('d_schools', "uid='$id'", "school_name");
  return $sc;
}

function user_roles($id)
{
  $ug = fetchrow('d_user_groups', "uid='$id'", "group_name");
  return $ug;
}
function gender($gender)
{
  if ($gender == 1) {
    return 'Male';
  } elseif ($gender == 2) {
    return 'Female';
  } else {
    return 'Unspecified';
  }
}

function title($id)
{
  $ut = fetchrow('d_title', "uid='$id'", "name");
  return $ut;
}

function sendmail($from, $to, $subject, $body)
{
  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // Create email headers
  $headers .= 'From: ' . $from . "\r\n" .
    'Reply-To: ' . $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  // Compose a simple HTML email message
  $message = '<html><body>';
  $message .= '<p style="font-size:15px;">' . $body . '</p>';
  $message .= '</body></html>';

  // Sending email

  $sm = mail($to, $subject, $message, $headers);

  return $sm;
}

function topic_status($id)
{
  $status = fetchrow('d_topics', "topic_id='$id'", "status");
  $topic_state = fetchrow('d_topic_statuses', "uid='$status'", "name");

  if ($status == 0) {
    $state_name = "<span class=\"label label-primary\">$topic_state</span>";
  }
  if ($status == 1) {
    $state_name = "<span class=\"label label-success\">$topic_state</span>";
  }
  if ($status == 2) {
    $state_name = "<span class=\"label label-dager\">$topic_state</span>";
  }
  if ($status == 3) {
    $state_name = "<span class=\"label label-warning\">$topic_state</span>";
  }

  return $state_name;
}

function fetchmaxid($table, $where, $fds = '*')
{
  global $con;
  $query = "SELECT $fds FROM $table WHERE $where order by uid desc LIMIT 0,1"; //var_dump($query);
  $result = mysqli_query($con, $query);
  $roww = mysqli_fetch_array($result, MYSQLI_ASSOC);

  return $roww;
}
function fetchmax($table, $where, $orderby, $fds = '*')
{
  global $con;
  $query = "SELECT $fds FROM $table WHERE $where order by $orderby desc LIMIT 0,1"; //var_dump($query);
  $result = mysqli_query($con, $query);
  $roww = mysqli_fetch_array($result, MYSQLI_ASSOC);

  return $roww;
}
function fetchminid($table, $where)
{
  global $con;
  $query = "SELECT * FROM $table WHERE $where order by uid asc LIMIT 0,1"; //var_dump($query);
  $result = mysqli_query($con, $query);
  $roww = mysqli_fetch_array($result, MYSQLI_ASSOC);

  return $roww;
}

function item_state($sid)
{
  if ($sid == 1) {
    $statename = "<span class=\"label label-success\">Active</span>";
  }
  if ($sid == 2) {
    $statename = "<span class=\"label label-danger\">Inactive</span>";
  }
  return $statename;
}

function topic_name($tip)
{
  if ($tip > 0) {
    $tName = fetchrow('d_topics', "topic_id='$tip'", "topic_name");
  } else {
    $tName = "NULL";
  }

  return $tName;
}

function research_progress($pid)
{
  if ($pid > 0) {
    $progress_stage = fetchrow('d_progress_stages', "uid='$pid'", "name");
  } else {
    $progress_stage = "Not Started";
  }

  return $progress_stage;
}
function topicStatus($sid)
{

  $topic_state = fetchrow('d_topic_statuses', "uid='$sid'", "name");

  return $topic_state;
}
