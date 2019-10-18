<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$response = array(
  'status' => 0,
  'message' => 'Form submission failed, please try again.'
);
// If form is submitted
if (isset($_POST['u_name'])) {
  // Get the submitted form data
  $email = mysqli_real_escape_string($con, $_POST['u_name']);

  // Check whether submitted data is not empty
  if (!empty($email)) {

    $emailOk = emailOk($email);

    if ($emailOk == 0) {
      $response['status'] = 0;
      $response['message'] = '<i class="fa fa-exclamation-triangle"></i> Invalid email address please type a valid email address!';
    }

    $emailExists = checkrowexists('d_users_primary', "primary_email='$email' AND status='1'");
    if ($emailExists == 0) {
      $response['status'] = 0;
      $response['message'] = '<i class="fa fa-exclamation-triangle"></i> No user is registered with this email address!';
    } else {
      $emailMatch = 1;

      // setting link expiry time
      $expFormat = mktime(
        date("H"),
        date("i"),
        date("s"),
        date("m"),
        date("d") + 1,
        date("Y")
      );
      $expDate = date("Y-m-d H:i:s", $expFormat);
      //generat unique string
      $key = md5(2418 * 2 + $email);
      $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
      $key = $key . $addKey;

      $udetails = fetchonerow('d_users_primary', "primary_email='$email' AND status ='1'", "first_name,last_name,uid");
      $fname = $udetails['first_name'];
      $lname = $udetails['last_name'];
      $uid = $udetails['uid'];

      // defining mail parameters to be sent

      $toid = $email;
      $fromid = 'admin@dms.co.ke';
      $subject = 'ACCOUNT PASSWORD RECOVERY';

      $resetPassLink = "localhost/system/resetPassword.php?fp_email=$email&fp_code=$key&action=reset";

      $message = "<p>Hi $fname $lname,</p>

      <p>A request has been submitted to reset a password for your account.If this was a mistake, just ignore this email and nothing will happen. However, you may want to log into
        your account and change your security password as someone may have guessed it.</p>

      <p>Please click on the following link to reset your password.</p>

      <p>..................................................................................................................</p>
      <p><a href=$resetPassLink . ' target='_blank'>$resetPassLink</a></p>
      <p>..................................................................................................................</p>
      <p>Please be sure to copy the entire link into your browser if it is not clickable.The link will expire after 1 day for security reasons.</p>

      <p>Regards,</p>
      <p><b>DMS Account Management Team</b></p>";

      $mail_sent = sendmail($fromid, $toid, $subject, $message);
      if ($mail_sent == 1) {

        $update = updatedb('d_passes', "pass_reset_token='$key',reset_status='0',expDate='$expDate'", "user='$uid'");
        $refresh = 1;
        // mail sent successfully notify the user to check the email
        $response['status'] = 1;
        $response['message'] = 'An email has been sent to you with instructions on how to reset your password.';
      } else {
        //mail could not be sent try later
        $response['status'] = 0;
        $response['message'] = '<i class="fa fa-exclamation-triangle"></i> Some problem occurred, please try again.';
      }
    }
  } else {

    $response['status'] = 0;
    $response['message'] = '<i class="fa fa-exclamation-triangle"></i> Email Address is required';
  }
}

// Return response
echo json_encode($response);
