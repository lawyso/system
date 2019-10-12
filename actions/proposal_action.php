<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
$proposal_id = $_POST['proposal_id'];
$action = $_POST['action'];

$username = username($_SESSION['dms_']);
$user = fetchrow('d_proposals', "uid='$proposal_id'", "user");
$current_comment = fetchrow('d_proposals', "uid='$proposal_id'", "comments");
$action_effect = fetchrow('d_proposal_statuses', "uid='$action'", "name");
$user_to_name = fetchrow('d_users_primary', "uid='$user'", "first_name");
$user_to_email = fetchrow('d_users_primary', "uid='$user'", "primary_email");
$user_from_email = fetchrow('d_users_primary', "uid='$myid'", "primary_email");
$user_from_title = fetchrow('d_users_primary', "uid='$myid'", "title");
$title_name = fetchrow('d_title', "uid='$user_from_title'", "name");
$user_from_fname = fetchrow('d_users_primary', "uid='$myid'", "first_name");
$user_from_lname = fetchrow('d_users_primary', "uid='$myid'", "last_name");
$subject = "Proposal Action Notification";
$message = "Hi $user_to_name,<br/><br/> Your Proposal previously submitted has been $action_effect by $title_name $user_from_fname $user_from_lname.<br/><br/>
Kindly find more details about this by clicking the link below:<br/><br/>
<a href='localhost/system/login.php'>https://localhost/system/login.php</a><br/><br/>
Best Regards,<br/> DMS ACCOUNT MANAGEMENT TEAM";

if ($proposal_id > 0 && $action == 1) {
   $delete = deletedata('d_proposals', "$proposal_id");
   if ($delete == 1) {
      $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
      echo sucmes('Operation successful, proposal content deleted.Please enter new proposal content.');

      $proceed = 1;
   } else {
      echo errormes('Error: Unable to process request');
   }
} elseif ($proposal_id > 0 && $action == 5) {
   $more_comment = $current_comment . "<br/>Proposal Document [Deleted] by [$username] on $fulldate ";
   $upd = updatedb('d_proposals', "proposal_upload ='',comments='$more_comment'", "uid='$proposal_id'");
   if ($upd == 1) {
      $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
      echo sucmes('Operation successful, proposal document deleted.You can upload a new document');

      $proceed = 1;
   } else {
      echo errormes('Error: Unable to process request');
   }
} elseif ($proposal_id > 0 && $action == 3) {

   $more_comment = $current_comment . "<br/>Proposal Document [Rejected] by [$username] on $fulldate ";
   $upd = updatedb('d_proposals', "status ='3',comments='$more_comment'", "uid='$proposal_id'");
   $update = updatedb('d_users_primary', "proposal_status ='3'", "uid='$user'");

   if ($upd == 1 && $update == 1) {
      $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
      echo sucmes('Operation successful, proposal Rejected');

      $proceed = 1;
   } else {
      echo errormes('Error: Unable to process request');
   }
} elseif ($proposal_id > 0 && $action == 2) {

   $more_comment = $current_comment . "<br/>Proposal Document [Approved] by [$username] on $fulldate ";
   $upd = updatedb('d_proposals', "status ='2',comments='$more_comment'", "uid='$proposal_id'");
   $update = updatedb('d_users_primary', "proposal_status ='2'", "uid='$user'");

   if ($upd == 1 && $update == 1) {
      $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
      echo sucmes('Operation successful, proposal Approved');

      $proceed = 1;
   } else {
      echo errormes('Error: Unable to process request');
   }
} elseif ($proposal_id > 0 && $action == 6) {

   $more_comment = $current_comment . "<br/>Proposal Document [Closed] by [$username] on $fulldate ";
   $upd = updatedb('d_proposals', "status ='6',comments='$more_comment'", "uid='$proposal_id'");
   $update = updatedb('d_users_primary', "proposal_status ='6'", "uid='$user'");
   if ($upd == 1 && $update == 1) {
      $sendMail = sendmail($user_from_email, $user_to_email, $subject, $message);
      echo sucmes('Operation successful, proposal Proposal closed awaits Defense');

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
      }, 5000);
   }
</script>
