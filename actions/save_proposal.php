<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, $_POST['sid']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$area_study = mysqli_real_escape_string($con, $_POST['area_study']);
$supervisors = mysqli_real_escape_string($con, $_POST['supervisors']);


////////////___________Validation
$titleOk = input_length($title, 12);
if ($titleOk == 0) {
    die(errormes('Proposal Title is required'));
    exit();
}

$area_studyOk = input_length($area_study, 15);
if ($area_studyOk == 0) {
    die(errormes('Area of study/research description too short'));
    exit();
}
$user_to_name = fetchrow('d_users_primary', "uid='$myid'", "first_name");
$user_to_email = fetchrow('d_users_primary', "uid='$myid'", "primary_email");
$user_to_title = fetchrow('d_users_primary', "uid='$myid'", "title");
$title_name = fetchrow('d_title', "uid='$user_to_title'", "name");
$from_mail = "Admin@dms.co.ke";
$subject = "PROPOSAL/CONCEPT PAPER SUBMISSION";
$message = "Hi $title_name $user_to_name, <br/>
                <br/>Your proposal/concept paper details has been saved Successfully.<br/>
                <br/>PLEASE NOTE: To complete the submission, upload the concept document on the proposal details page.<br />
                Proposal review period is 2 hours from the from upload time, Thereafter no review shall be allowed by the system.<br/>
                <br/>Please contact your system admin if having difficulties during review period.<br/><br/>Best Regards,<br/>DMS ACCOUNT MANAGEMENT TEAM";


$validation  = $titleOk + $area_studyOk;
if ($validation == 2) {
    ////________Proceed
    if ($sid > 0) {
        ///////__________-Update  without proposal
        $updatestring = "user='$myid',title='$title', area_study='$area_study', supervisor_1='$supervisors',date_modified='$fulldate'";
        $update = updatedb('d_proposals', $updatestring, "uid='$sid'");
        if ($update == 1) {
            echo sucmes('Proposal Details updated Successfuly');
            $proceed = 1;
        } else {
            echo errormes('Unable to update Proposal Details');
        }
    } else {
        ///________________________create new proposal

        $fds = array('user', 'title', 'area_study', 'supervisor_1', 'added_date', 'status');
        $vals = array("$myid", "$title", "$area_study", "$supervisors", "$fulldate", "1");
        $create = addtodb('d_proposals', $fds, $vals);

        if ($create == 1) {
             $sendmail = sendmail($from_mail, $user_to_email, $subject, $message);
            echo sucmes('Concept Paper/Proposal Submitted Successfully,Proceed to proposal page and upload the document');

            $proceed = 1;
        } else {
            echo errormes('Unable to Submit concept paper/proposal');
        }
    }
}

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'proposals.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
