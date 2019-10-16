<?php
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$cs = mysqli_real_escape_string($con,  $_GET['course']);
$sid = mysqli_real_escape_string($con, decurl($_GET['sid']));

$cd = fetchonerow('d_courses', "uid='$cs'");
$course = $cd['uid'];
$department = $cd['department_tag'];
$school = $cd['school_tag'];
$disabled = "disabled";

?>
<div class="form-group">
  <label for="user_group">Department</label>
  <select class="form-control" id="department" <?php echo $disabled; ?>>
    <option value="0">~Select~</option>
    <?php
    $deps = fetchtable('d_departments', "status=1 AND uid='$department'", "department_name", "asc", "1");
    while ($d = mysqli_fetch_array($deps)) {
      $uid = $d['uid'];
      $department_name = $d['department_name'];
      if ($uid == $department) {
        $dselected = 'SELECTED';
      } else {
        $dselected = '';
      }
      echo "<option $dselected value=\"$uid\">$department_name</option>";
    }
    ?>
  </select>
</div>
<div class="form-group">
  <label for="user_group">School/Faculty</label>
  <select class="form-control" id="school" <?php echo $disabled; ?>>
    <option value="0">~Select~</option>
    <?php
    $sch = fetchtable('d_schools', "status='1' AND uid='$school'", "school_name", "asc", "1");
    while ($sc = mysqli_fetch_array($sch)) {
      $uid = $sc['uid'];
      $school_name = $sc['school_name'];
      if ($uid == $school) {
        $scselected = 'SELECTED';
      } else {
        $scselected = '';
      }
      echo "<option $scselected value=\"$uid\">$school_name</option>";
    }
    ?>
  </select>
</div>
