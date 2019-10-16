<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $password = mysqli_real_escape_string($con, $_POST['u_pass']);
    $password1 = mysqli_real_escape_string($con, $_POST['u_passConfirm']);
    $userid = $_POST['userid'];

    //////////////________________hard validation
    $passavailable = input_available($password);
    $confirmpassavailable = input_available($password1);

    if ($passavailable == 0) {
        die(errormes('New password is required'));
        exit();
    }
    if ($confirmpassavailable  == 0) {
        die(errormes('Confirm password is required'));
        exit();
    }
    $passwordOk = input_between(8, 16, $password);
    if ($passwordOk == 0) {
        die(errormes('The Password must be composed of 8 to 16 characters'));
        exit();
    }
    if ($password != $password1) {
        die(errormes('The New Password and Confirm Password Does not Match'));
        exit();
    } else {
        $passMatch = 1;
    }


    $validation = $passwordOk + $passavailable + $confirmpassavailable + $passMatch;
    if ($validation == 4) {

        // hashing the password
        $epass = passencrypt($password);
        $hash = substr($epass, 0, 64);
        $salt = substr($epass, 64, 96);

        $updatestring = "pass='$salt',reset_status='1'";
        $update = updatedb('d_passes', $updatestring, "user='$userid'");
        $updateh = updatedb('d_users_primary', "pass='$hash'", "uid='$userid'");

        if ($update == 1 && $updateh == 1) {
            // Password reset successfull.
            $refresh = 1;
            echo sucmes('Password Reset Successfully.Redirecting to login page in 3 seconds....');
        } else {
            //Password can not be updated at the moment.
            echo errormes('Some problem occurred, please try again Later.');
        }
    } else {     // Validation failed and Reset script can not be processed
        echo errormes('Some problem occurred,The Request can not be processed at the moment.Please check your details and try again.');
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
                window.location.href = 'login.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
