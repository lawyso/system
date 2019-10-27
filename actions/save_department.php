<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, $_POST['sid']);
$department_name = mysqli_real_escape_string($con, $_POST['department_name']);
$dept_status = mysqli_real_escape_string($con, $_POST['dept_status']);

////////////___________Validation
$department_nameOK = input_length($department_name, 4);
if ($department_nameOK == 0) {
  die(errormes('Department name is required'));
  exit();
}

if ($dept_status > 0) {
  $dept_statusOk = 1;
} else {
  die(errormes('Department Status Must be selected'));
  exit();
}

$validation  = $department_nameOK + $dept_statusOk;
if ($validation == 2) {
  if ($sid > 0) {
    ///update
    $updatestring = "department_name='$department_name',status='$dept_status'";
    $update = updatedb('d_departments', $updatestring, "uid='$sid'");
    if ($update == 1) {
      echo sucmes('Department updated Successfuly');
      $proceed = 1;
    } else {
      echo errormes('Unable to update Department Details');
    }
  } else {
    ///create
    $fds = array('department_name', 'status');
    $vals = array("$department_name", '$dept_status');
    $create = addtodb('d_departments', $fds, $vals);

    if ($create == 1) {
      echo sucmes('New Department Added Successfully');

      $proceed = 1;
    } else {
      echo errormes('Unable to Add the New Department');
    }
  }
}

?>


<script>
  var action = '<?php echo $proceed; ?>';
  if (action == '1') {
    {
      setTimeout(function() {
        window.location.href = 'details?departments'; // the redirect goes here

      }, 5000); // 5 seconds

    }

  }
</script>
