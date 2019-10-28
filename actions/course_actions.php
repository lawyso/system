<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
$course_id = mysqli_real_escape_string($con, $_POST['course_id']);
$action = mysqli_real_escape_string($con, $_POST['action']);

$username = username($_SESSION['dms_']);
$c_id = decurl($course_id);

if ($course_id  > 0 && $action == 0) {
  $delete = deletedata('d_courses', "$c_id");
  if ($delete == 1) {

    echo sucmes('Operation successful, Course Entry has been deleted.');

    $proceed = 1;
  } else {
    echo errormes('Error: Unable to process request');
  }
}

?>

<script>
  var proceed = '<?php echo $proceed; ?>';
  if (proceed == '1') {
    setTimeout(function() {
      reload();
    }, 3000);
  }
</script>
