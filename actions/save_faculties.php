<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, $_POST['sid']);
$school_name = mysqli_real_escape_string($con, $_POST['school_name']);
$sch_status = mysqli_real_escape_string($con, $_POST['sch_status']);

////////////___________Validation
$school_nameOK = input_length($school_name, 4);
if ($school_nameOK == 0) {
  die(errormes('School/Faculty name is required'));
  exit();
}

if ($sch_status > 0) {
  $sch_statusOk = 1;
} else {
  die(errormes('Faculty Status Must be selected'));
  exit();
}

$validation  = $school_nameOK + $sch_statusOk;
if ($validation == 2) {
  if ($sid > 0) {
    ///update
    $updatestring = "school_name='$school_name',status='$sch_status'";
    $update = updatedb('d_schools', $updatestring, "uid='$sid'");
    if ($update == 1) {
      echo sucmes('School/Faculty updated Successfuly');
      $proceed = 1;
    } else {
      echo errormes('Unable to update School/Faculty Details');
    }
  } else {
    ///create
    $fds = array('school_name', 'status');
    $vals = array("$school_name", "$sch_status");
    $create = addtodb('d_schools', $fds, $vals);

    if ($create == 1) {
      echo sucmes('New School/Faculty Added Successfully');

      $proceed = 1;
    } else {
      echo errormes('Unable to Add the New School/Faculty');
    }
  }
}

?>


<script>
  var action = '<?php echo $proceed; ?>';
  if (action == '1') {
    {
      setTimeout(function() {
        window.location.href = 'details?faculties'; // the redirect goes here

      }, 5000); // 5 seconds

    }

  }
</script>
