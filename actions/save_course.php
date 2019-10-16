<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, decurl($_POST['sid']));
$department = mysqli_real_escape_string($con, $_POST['department']);
$school = mysqli_real_escape_string($con, $_POST['school']);
$course = mysqli_real_escape_string($con, $_POST['course']);
$admission_date = mysqli_real_escape_string($con, $_POST['admission_date']);


////////////___________Validation

if ($course > 0) {
    $courseOk = 1;
} else {
    die(errormes('Course name is required'));
    exit();
}
if ($department > 0) {
    $departmentOk = 1;
} else {
    die(errormes('Department name is required'));
    exit();
}
if ($school > 0) {
    $schoolOk = 1;
} else {
    die(errormes('School/Fuculty name is required'));
    exit();
}
$admission_dateOk = input_length($admission_date, 2);
if ($admission_dateOk == 0) {
    die(errormes('Admission Date is required'));
    exit();
}

$course_duration = fetchrow('d_courses', "uid='$course'", 'course_duration');
$user_to_name = fetchrow('d_users_primary', "uid='$myid'", "first_name");
$user_to_email = fetchrow('d_users_primary', "uid='$myid'", "primary_email");
$user_to_title = fetchrow('d_users_primary', "uid='$myid'", "title");
$title_name = fetchrow('d_title', "uid='$user_to_title'", "name");
$from_mail = "Admin@dms.co.ke";
$subject1 = "COURSE REGISTRATION NOTIFICATION";
$subject2 = "COURSE REGISTRATION UPDATE NOTIFICATION";
$message1 = "Hi $title_name $user_to_name, <br/>
                <br/>Your course registration process has been completed Successfully.<br/>
                <br/>PLEASE NOTE: Course review period is 30 days from the admission date, Thereafter no review shall be allowed by the system.<br/>
                <br/>Please contact your system admin if having difficulties during review period.<br/><br/>Best Regards,<br/>DMS ACCOUNT MANAGEMENT TEAM";
$message2 = "Hi $title_name $user_to_name, <br/>
                <br/>Your course has been updated Successfully.<br/>
                <br/>PLEASE NOTE: Course review period is 30 days from the admission date, Thereafter no review shall be allowed by the system.<br/>
                <br/>Please contact your system admin if having difficulties during review period.<br/><br/>Best Regards,<br/>DMS ACCOUNT MANAGEMENT TEAM";
$validation  = $courseOk + $departmentOk + $schoolOk + $admission_dateOk;
if ($validation == 4) {
    if ($sid > 0) {
        ///update
        $updatestring = "department='$department', course='$course', school='$school',admission_date='$admission_date',course_duration='$course_duration'";
        $update = updatedb('d_users_courses', $updatestring, "uid='$sid'");
        $update2 = updatedb('d_users_primary', "department='$department', faculty='$school'", "uid='$myid'");
        if ($update == 1) {
            $sendmail = sendmail($from_mail, $user_to_email, $subject2, $message2);
            echo sucmes('Course Details updated Successfuly');
            $proceed = 1;
        } else {
            echo errormes('Unable to update Course Details');
        }
    } else {
        ///create


        $fds = array('user', 'course', 'admission_date', 'department', 'school', 'course_duration', 'status');
        $vals = array("$myid", "$course", "$admission_date", "$department", "$school", "$course_duration", '1');
        $create = addtodb('d_users_courses', $fds, $vals);

        if ($create == 1) {
            $sendmail = sendmail($from_mail, $user_to_email, $subject1, $message1);
            $update2 = updatedb('d_users_primary', "department='$department', faculty='$school'", "uid='$myid'");
            echo sucmes('New Course Registered Successfully');

            $proceed = 1;
        } else {
            echo errormes('Unable to Register for The New User');
        }
    }
}

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'register.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
