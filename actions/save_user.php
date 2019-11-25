<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);

if (isset($_POST['sid']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['national_id']) || isset($_POST['primary_email']) || isset($_POST['primary_phone']) || isset($_POST['user_name']) || isset($_POST['user_group']) || isset($_POST['reg_no']) || isset($_POST['status'])) {

    ////////////____________capture and sanitizing posted details
    $sid = $_POST['sid'];
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $national_id = mysqli_real_escape_string($con, $_POST['national_id']);
    $primary_email = mysqli_real_escape_string($con, $_POST['primary_email']);
    $primary_phone = mysqli_real_escape_string($con, $_POST['primary_phone']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_group = mysqli_real_escape_string($con, $_POST['user_group']);
    //$gender = mysqli_real_escape_string($con, $_POST['gender']);
    $reg_no = mysqli_real_escape_string($con, $_POST['reg_no']);
    $password = $user_name;
    $status = mysqli_real_escape_string($con, $_POST['status']);


    ////////////___________Validation

    $first_nameOk = input_length($first_name, 2);
    if ($first_nameOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'First name needed';
    }

    $last_nameOk = input_length($last_name, 2);
    if ($last_nameOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'Last name needed';
    }

    $national_idOk = input_between(6, 10, $national_id);
    if ($national_idOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'National id invalid';
    }

    $emailOk = emailOk($primary_email);
    if ($emailOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'Email invalid';
    } else {
        $emailExists = checkrowexists('d_users_primary', "primary_email='$primary_email' AND uid!=$sid");
        if ($emailExists == 1) {
            $response['status'] = 0;
            $response['message'] = 'Email exists';
        } else {
            $emailUnique = 1;
        }
    }
    $primary_phoneOk = validate_phone($primary_phone);
    if ($primary_phoneOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'Phone needed in the format 2547...';
    } else {
        $phoneExists = checkrowexists('d_users_primary', "primary_phone='$primary_phone' AND uid!=$sid");
        if ($phoneExists == 1) {
            $response['status'] = 0;
            $response['message'] = 'Primary Phone exists';
        } else {
            $phoneUnique = 1;
        }
    }
    $user_nameOk = input_length($user_name, 5);
    if ($user_nameOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'Username too short <5';
    }
    if ($user_group > 0) {
        $user_groupOk = 1;
    } else {
        $response['status'] = 0;
        $response['message'] = 'User Group needed';
    }

    $reg_noOk = input_length($reg_no, 2);
    if ($reg_noOk == 0) {
        $response['status'] = 0;
        $response['message'] = 'Registration/Staff Number is needed';
    }

    $validation  = $reg_noOk + $first_nameOk + $last_nameOk + $emailOk + $emailUnique + $primary_phoneOk + $phoneUnique + $user_nameOk + $user_groupOk + $national_idOk;
    if ($validation == 10) {
        if ($sid > 0) {
            ///////////////_________update user details
            $updatestring = "first_name='$first_name',Reg_No='$reg_no', last_name='$last_name', primary_email='$primary_email',primary_phone='$primary_phone',user_group='$user_group',status='$status',national_id='$national_id'";
            $update = updatedb('d_users_primary', $updatestring, "uid='$sid'");
            if ($update == 1) {
                $response['status'] = 1;
                $response['message'] = 'User Details updated Successfuly';
            } else {
                $response['status'] = 0;
                $response['message'] = 'Unable to update User Details';
            }
        } else {
            /////////////____________create new user entry
            $epass = passencrypt($password);
            $hash = substr($epass, 0, 64);
            $salt = substr($epass, 64, 96);

            $fds = array('u_code', 'first_name', 'Reg_No', 'last_name', 'primary_email', 'primary_phone', 'user_name', 'pass', 'registerDate', 'added_by', 'user_group', 'status', 'national_id');
            $vals = array("$c_code", "$first_name", "$reg_no", "$last_name", "$primary_email", "$primary_phone", "$user_name", "$hash", "$fulldate", "$myid", "$user_group", '1', "$national_id");
            $create = addtodb('d_users_primary', $fds, $vals);

            if ($create == 1) {
                $response['status'] = 1;
                $response['message'] = 'User Created Successfully';
                //////____________________prepare login credentials to send to user through email
                $userid = fetchrow('d_users_primary', "primary_email='$primary_email'", "uid");
                $fdss = array('user', 'pass');
                $valss = array("$userid", "$salt");
                ////////////////________store pass
                $savesalt = addtodb('d_passes', $fdss, $valss);
                if ($savesalt == 1) {

                    $response['status'] = 1;
                    $response['message'] = 'Default password created and Emailed';

                    ///////////___________send email
                    $from_mail = "Admin@dms.co.ke";
                    $subject = "DMS USER ACCOUNT LOGIN CREDENTIALS";
                    $message = "Hi $first_name $last_name, <br/>
                <br/>Your user account for the Dissertation Management System portal has been created successfully.<br/>
                <br/>A default password has been created, use it to login in thereafter change your password to your most preferred one.<br/>
                <br/>USERNAME: $user_name OR $primary_email <br/>DEFAULT PASSWORD: $user_name<br/><br/>Best Regards,<br/>DMS ACCOUNT MANAGEMENT TEAM";
                    $sendmail = sendmail($from_mail, $primary_email, $subject, $message);
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Unable to Create password';
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'Unable to Create New User';
            }
        }
    }
}
// Return response
echo json_encode($response);
