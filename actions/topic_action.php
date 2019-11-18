<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
$topic_id = mysqli_real_escape_string($con, decurl($_POST['topic_id']));
$action = mysqli_real_escape_string($con, $_POST['action']);
$created_by = fetchrow('d_topics', "topic_id='$topic_id'", "created_by");

if ($topic_id > 0 && $action == 4) {
  $delete = deletetopic('d_topics', "$topic_id");
  if ($delete == 1) {
    $update = updatedb('d_users_primary', "topic_id ='0'", "uid='$created_by'");
    echo sucmes('Operation successful, Topic content deleted.');

    $proceed = 1;
  } else {
    echo errormes('Error: Unable to process request');
  }
} elseif ($topic_id > 0 && $action == 2) {

  $upd = updatedb('d_topics', "status ='2'", "topic_id='$topic_id'");
  echo sucmes('Operation successful, Research Topic Rejected');
  $proceed = 1;
} elseif ($topic_id > 0 && $action == 1) {

  $upd = updatedb('d_topics', "status ='1'", "topic_id='$topic_id'");
  $update = updatedb('d_users_primary', "topic_id ='1'", "uid='$created_by'");

  if ($upd == 1 && $update == 1) {

    echo sucmes('Operation successful, Research Topic Approved');
    $proceed = 1;
  } else {
    echo errormes('Error: Unable to process request');
  }
} elseif ($topic_id > 0 && $action == 3) {

  $upd = updatedb('d_topics', "status ='3'", "topic_id='$topic_id'");
  $update = updatedb('d_users_primary', "topic_id ='3'", "uid='$created_by'");

  if ($upd == 1 && $update == 1) {

    echo sucmes('Operation successful, Research Topic closed awaits Publish');

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
