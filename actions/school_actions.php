<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
$faculty_id = mysqli_real_escape_string($con, $_POST['fac_id']);
$action = mysqli_real_escape_string($con, $_POST['action']);

$username = username($_SESSION['dms_']);
$fa_id = decurl($faculty_id);

if ($fa_id  > 0 && $action == 0) {
  $delete = deletedata('d_schools', "$fa_id");
  if ($delete == 1) {

    echo sucmes('Operation successful, Faculty Entry has been deleted.');

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
    }, 10000);
  }
</script>
