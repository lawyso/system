<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  $email = mysqli_real_escape_string($con, $_POST['u_name']);
  //////////////________________validation
  $emailAvailable = input_available($email);

  if ($emailAvailable == 0) {
    die(errormes('Email Address is required'));
    exit();
  }
  $emailOk = emailOk($email);
  if ($emailOk == 0) {
    die(errormes('Email invalid/ Please input the correct Email'));
    exit();
  }

  $emailExists = checkrowexists('d_users_primary', "primary_email='$email' AND status='1'");
  if ($emailExists == 0) {
    die(errormes('The Email supplied does not match our records'));
    exit();
  } else {
    $emailMatch = 1;
  }


  $validation = $emailOk + $emailMatch + $emailAvailable;
  if ($validation == 3) {
    //generat unique string
    $uniqidStr = md5(uniqid(mt_rand()));

    $udetails = fetchonerow('d_users_primary', "primary_email='$email' AND status ='1'", "first_name,last_name,uid");
    $fname = $udetails['first_name'];
    $lname = $udetails['last_name'];
    $uid = $udetails['uid'];
    $reset_email = encurl($email);

    // defining mail parameters to be sent

    $toid = $email;
    $fromid = 'admin@dms.co.ke';
    $subject = 'ACCOUNT PASSWORD RECOVERY';

    $resetPassLink = "localhost/system/resetPassword.php?fp_email=$email&fp_code=$uniqidStr";

    $message = "Hi $fname $lname,<br/><br/>A request has been submitted to reset a password for your account.<br/><br/>
            If this was a mistake, just ignore this email and nothing will happen.<br><br>
            To reset your password, visit the following link:<br><br>
            <a href=$resetPassLink . '>$resetPassLink</a>
             <br><br><br>
            Regards,<br>
            <b>DMS Account Management Team</b>";


    $mail_sent = sendmail($fromid, $toid, $subject, $message);

    if ($mail_sent == 1) {

      $update = updatedb('d_passes', "pass_reset_token='$uniqidStr',reset_status='0'", "user='$uid'");
      $refresh = 1;
      // mail sent successfully notify the user to check the email
      echo sucmes('Please check your e-mail, we have sent a password reset link to your registered email.Follow the link to complete setting the new password.');
    } else {
      //mail could not be sent try later
      echo errormes('Some problem occurred, please try again.');
    }
  } else {
    // validation errors
    echo errormes('You are not authorized to reset new password of this account, contact system administrator.');
  }
} else { /// wrong request method
  echo $method . ' Not supported';
}

?>
<script>
  var action = '<?php echo $refresh; ?>';
  if (action == '1') {
    {
      setTimeout(function() {
        reload();
      }, 5000);

    }

  }
</script>
