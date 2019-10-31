<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$newpass = mysqli_real_escape_string($con, $_POST['new_pass']);
$new_passConfirm = mysqli_real_escape_string($con, $_POST['new_passConfirm']);
$user = mysqli_real_escape_string($con, $_POST['userid']);


$newpassavailable = input_available($newpass);
if ($newpassavailable == 0) {
  die(errormes('New password is required'));
  exit();
}

$confirmpassavailable = input_available($new_passConfirm);
if ($confirmpassavailable == 0) {
  die(errormes('Confirm password is required'));
  exit();
}

if ($newpass != $new_passConfirm) {
  die(errormes('The New Password and Confirm Password Does not Match'));
  exit();
}

$passwordOk = input_length($newpass, 8);
if ($passwordOk == 0) {
  echo errormes('Password not strong enough. Make it at least 8 characters');
} else {
  $epass = passencrypt($newpass);
  $hash = substr($epass, 0, 64);
  $salt = substr($epass, 64, 96);
  $updateh = updatedb('d_users_primary', "pass='$hash',pass_change='1'", "uid='$user'");
  $updates = updatedb('d_passes', "pass='$salt'", "user='$user'");
  if ($updateh + $updates == 2) {
    echo sucmes('Password Changed successfully');
    $redirect = 1;
  } else {
    echo errormes('Error Changing the password');
  }
}


?>
<script>
  var action = '<?php echo $redirect; ?>';
  if (action == '1') {
    {
      setTimeout(function() {
        window.location.href = 'login.php'; // the redirect goes here

      }, 3000); // 5 seconds

    }

  }
</script>
