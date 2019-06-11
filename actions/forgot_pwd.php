<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  $email = $_POST['u_name'];
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
    $fromid = 'admin@dms.com';
    $subject = 'Account Password Recovery';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $resetPassLink ="localhost/dms/resetPassword.php?fp_email=$email&fp_code=$uniqidStr";

    // Create email headers
    $headers .= 'From: ' . $fromid . "\r\n" .
      'no-Reply-To: ' . $fromid . "\r\n" .

      // Compose a simple HTML email message
    $message .= "<html><body>";
    $message = "<h3>Hi $fname $lname,</h3><br/>
            A request has been submitted to reset a password for your account.<br> 
            If this was a mistake, just ignore this email and nothing will happen.<br><br>
            To reset your password, visit the following link:<br><br> 
            <a href=$resetPassLink . '>$resetPassLink</a>
             <br><br><br>
            Regards,<br>
            <b>Exodus Account Management</b>";
    $message .= "</body></html>";

    
      $mail_sent = mail($toid, $subject, $message, $headers);

          if ($mail_sent == 1) 
          {
            
            $update = updatedb('s_passes',"pass_reset_token='$uniqidStr',reset_status='0'","user='$uid'");
            $refresh = 1;
            // mail sent successfully notify the user to check the email
            echo sucmes('Please check your e-mail, we have sent a password reset link to your registered email.Follow the link to complete setting the new password.');
          } 
          else 
          {
            //mail could not be sent try later
            echo errormes('Some problem occurred, please try again.');
          }
   
   
  }
  else 
  {
    // validation errors
    echo errormes('You are not authorized to reset new password of this account, contact system administrator.');
  }
} 
else 
{ /// wrong request method 
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