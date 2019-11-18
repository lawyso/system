<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';
////////////____________capture and sanitizing posted details
$sid = $_POST['sid'];
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$national_id = mysqli_real_escape_string($con, $_POST['national_id']);
$primary_email = mysqli_real_escape_string($con, $_POST['primary_email']);
$primary_phone = mysqli_real_escape_string($con, $_POST['primary_phone']);
$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
$user_group = mysqli_real_escape_string($con, $_POST['user_group']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$reg_no = mysqli_real_escape_string($con, $_POST['reg_no']);
$password = $user_name;
$status = mysqli_real_escape_string($con, $_POST['status']);

////////////___________Validation

$first_nameOk = input_length($first_name, 2);
if ($first_nameOk == 0) {
    die(errormes('First name needed'));
    exit();
}
$last_nameOk = input_length($last_name, 2);
if ($last_nameOk == 0) {
    die(errormes('Last name needed'));
    exit();
}
$national_idOk = input_between(6, 10, $national_id);
if ($national_idOk == 0) {
    die(errormes('National id invalid'));
    exit();
}
$emailOk = emailOk($primary_email);
if ($emailOk == 0) {
    echo errormes('Email invalid');
} else {
    $emailExists = checkrowexists('d_users_primary', "primary_email='$primary_email' AND uid!=$sid");
    if ($emailExists == 1) {
        die(errormes('Email exists'));
        exit();
    } else {
        $emailUnique = 1;
    }
}
$primary_phoneOk = validate_phone($primary_phone);
if ($primary_phoneOk == 0) {
    die(errormes('Phone needed in the format 2547...'));
    exit();
} else {
    $phoneExists = checkrowexists('d_users_primary', "primary_phone='$primary_phone' AND uid!=$sid");
    if ($phoneExists == 1) {
        die(errormes('Primary Phone exists'));
        exit();
    } else {
        $phoneUnique = 1;
    }
}
$user_nameOk = input_length($user_name, 5);
if ($user_nameOk == 0) {
    die(errormes('Username too short <5'));
    exit();
}
if ($user_group > 0) {
    $user_groupOk = 1;
} else {
    die(errormes('User Group needed'));
    exit();
}
if ($gender > 0) {
    $genderOk = 1;
} else {
    die(errormes('Section needed'));
    exit();
}

$reg_noOk = input_length($reg_no, 4);
if ($reg_noOk == 0) {
    die(errormes('Registration/Staff Number is needed'));
    exit();
}

$validation  = $reg_noOk + $first_nameOk + $last_nameOk + $emailOk + $emailUnique + $primary_phoneOk + $phoneUnique + $user_nameOk + $user_groupOk + $genderOk + $national_idOk;
if ($validation == 11) {
    if ($sid > 0) {
        ///////////////_________update user details
        $updatestring = "first_name='$first_name',Reg_No='$reg_no', last_name='$last_name', primary_email='$primary_email',primary_phone='$primary_phone',user_group='$user_group', gender='$gender',status='$status',national_id='$national_id'";
        $update = updatedb('d_users_primary', $updatestring, "uid='$sid'");
        if ($update == 1) {
            echo sucmes('User Details updated Successfuly');
            $proceed = 1;
        } else {
            echo errormes('Unable to update User Details');
        }
    } else {
        /////////////____________create new user entry
        $epass = passencrypt($password);
        $hash = substr($epass, 0, 64);
        $salt = substr($epass, 64, 96);

        $fds = array('u_code', 'first_name', 'Reg_No', 'last_name', 'primary_email', 'primary_phone', 'user_name', 'pass', 'registerDate', 'added_by', 'user_group', 'gender', 'status', 'national_id');
        $vals = array("$c_code", "$first_name", "$reg_no", "$last_name", "$primary_email", "$primary_phone", "$user_name", "$hash", "$fulldate", "$myid", "$user_group", "$gender", '1', "$national_id");
        $create = addtodb('d_users_primary', $fds, $vals);

        if ($create == 1) {
            echo sucmes('User Created Successfully');
            //////____________________prepare login credentials to send to user through email
            $userid = fetchrow('d_users_primary', "primary_email='$primary_email'", "uid");
            $proceed = 1;
            $fdss = array('user', 'pass');
            $valss = array("$userid", "$salt");
            ////////////////________store pass
            $savesalt = addtodb('d_passes', $fdss, $valss);
            if ($savesalt == 1) {

                echo sucmes('Default password created and Emailed');

                ///////////___________send email
                $from_mail = "Admin@dms.co.ke";
                $subject = "DMS USER ACCOUNT LOGIN CREDENTIALS";
                $message = "Hi $first_name $last_name, <br/>
                <br/>Your user account for the Dissertation Management System portal has been created successfully.<br/>
                <br/>A default password has been created, use it to login in thereafter change your password to your most preferred one.<br/>
                <br/>USERNAME: $user_name OR $primary_email <br/>DEFAULT PASSWORD: $user_name<br/><br/>Best Regards,<br/>DMS ACCOUNT MANAGEMENT TEAM";
                $sendmail = sendmail($from_mail, $primary_email, $subject, $message);
            } else {
                echo errormes('Unable to Create password');
            }
        } else {
            echo errormes('Unable to Create New User');
        }
    }
}

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'settings.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
