<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$newpass = mysqli_real_escape_string($con, $_POST['new_pass']);
$old_pass = mysqli_real_escape_string($con, $_POST['old_pass']);
$new_passConfirm = mysqli_real_escape_string($con, $_POST['new_passConfirm']);
$user = $myid;

$oldpassavailable = input_available($old_pass);
if ($oldpassavailable == 0) {
    die(errormes('old password is required'));
    exit();
}

$newpassavailable = input_available($newpass);
if ($newpassavailable == 0) {
    die(errormes('New password is required'));
    exit();
}

if ($newpass == $old_pass) {
    die(errormes('New Password can not be the same as the old password.Choose a different password'));
    exit;
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
$thesalt = fetchrow('d_passes', "user='$user'", 'pass');
////apendsalt to inputted password
$fullpass = $thesalt . $old_pass;
$encpass = hash('SHA256', $fullpass);
////fetch user pass from db
$databasepass = fetchrow('d_users_primary', "uid='$user'", 'pass');

if ($encpass != $databasepass) {
    die(errormes('The old password is incorrect'));
    exit();
}
$passwordOk = input_length($newpass, 8);
if ($passwordOk == 0) {
    echo errormes('Password not strong enough. Make it at least 8 characters');
} else {
    $epass = passencrypt($newpass);
    $hash = substr($epass, 0, 64);
    $salt = substr($epass, 64, 96);
    $updateh = updatedb('d_users_primary', "pass='$hash'", "uid='$user'");
    $updates = updatedb('d_passes', "pass='$salt'", "user='$user'");
    if ($updateh + $updates == 2) {
        echo sucmes('Password updated successfully');
        $updated = 1;
    } else {
        echo errormes('Error updating password');
    }
}


?>
<script>
    var updated = '<?php echo $updated; ?>';
    if (updated == '1') {
        $('#new_pass').val('');

    }
</script>
