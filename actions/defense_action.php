<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$defense_id = decurl($_POST['defense_id']);
$action = $_POST['action'];


$username = username($_SESSION['dms_']);

$user = fetchrow('d_defense', "uid='$defense_id'", "defender");

$action_effect = fetchrow('d_defense_statuses', "uid='$action'", "name");

$user_to_name = profileName($user);

$user_to_email = fetchrow('d_users_primary', "uid='$user'", "primary_email");

$user_from_email = fetchrow('d_users_primary', "uid='$myid'", "primary_email");

$user_from_title = fetchrow('d_users_primary', "uid='$myid'", "title");

$title_name = fetchrow('d_title', "uid='$user_from_title'", "name");

$user_from_name = profileName($myid);

$subject = "Defense Action Notification";

$message = "Hi $user_to_name,<br/><br/> Your Defense Application previously submitted has been $action_effect by $title_name $user_from_name.<br/><br/>
Kindly find more details about this action by visiting your portal or department for the next step.<br/><br/>
Wishing you the very good luck in your defense.<br/><br/>

Best Regards,<br/> $title_name $user_from_name";

if ($defense_id > 0 && $action == 3) {

  $upd = updatedb('d_defense', "defense_status ='3'", "uid='$defense_id'");

  if ($upd == 1) {
    $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
    echo sucmes('Operation successful, Defense Rejected');
    $proceed = 1;
  } else {
    echo errormes('Error: Unable to process request');
  }
} elseif ($defense_id > 0 && $action == 2) {

  $upd = updatedb('d_defense', "defense_status ='2'", "uid='$defense_id'");

  if ($upd == 1) {

    $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
    echo sucmes('Operation successful, Defense has been approved');

    $proceed = 1;
  } else {
    echo errormes('Error: Unable to process request');
  }
} elseif ($defense_id > 0 && $action == 3) {

  $upd = updatedb('d_defense', "defense_status ='3'", "uid='$defense_id'");

  if ($upd == 1) {

    $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
    echo sucmes('Operation successful, Defense has been Closed');

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
