<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, decurl($_POST['sid']));
$department = mysqli_real_escape_string($con, $_POST['department']);
$school = mysqli_real_escape_string($con, $_POST['school']);
$course_name = mysqli_real_escape_string($con, $_POST['course_name']);
$course_duration = mysqli_real_escape_string($con, $_POST['course_duration']);
$course_status = mysqli_real_escape_string($con, $_POST['course_status']);


////////////___________Validation
$courseOk = input_length($course_name, 6);
if ($courseOk == 0) {
  die(errormes('Course name is required'));
  exit();
}
if ($department > 0) {
  $departmentOk = 1;
} else {
  die(errormes('Department name is required'));
  exit();
}
if ($school > 0) {
  $schoolOk = 1;
} else {
  die(errormes('School/Fuculty name is required'));
  exit();
}
if ($course_duration > 0) {
  $course_durationOk = 1;
} else {
  die(errormes('Course Duration is required'));
  exit();
}
if ($course_status >= 0) {
  $course_statusOk = 1;
} else {
  die(errormes('Course Status is required'));
  exit();
}

$validation  = $courseOk + $departmentOk + $schoolOk + $course_durationOk + $course_statusOk;
if ($validation == 5) {
  if ($sid > 0) {
    ///update
    $updatestring = "department_tag='$department', course_name='$course_name', school_tag='$school',course_duration='$course_duration',course_status='$course_status'";
    $update = updatedb('d_courses', $updatestring, "uid='$sid'");
    if ($update == 1) {
      echo sucmes('Course Details updated Successfuly');
      $proceed = 1;
    } else {
      echo errormes('Unable to update Course Details');
    }
  } else {
    ///create


    $fds = array('course_name', 'department_tag', 'school_tag', 'course_duration', 'status');
    $vals = array("$course_name", "$department", "$school", "$course_duration", '$course_status');
    $create = addtodb('d_courses', $fds, $vals);

    if ($create == 1) {
      echo sucmes('New Course Registered Successfully');

      $proceed = 1;
    } else {
      echo errormes('Unable to Register for The New User');
    }
  }
}

?>


<script>
  var action = '<?php echo $proceed; ?>';
  if (action == '1') {
    {
      setTimeout(function() {
        window.location.href = 'register.php'; // the redirect goes here

      }, 5000); // 5 seconds

    }

  }
</script>
