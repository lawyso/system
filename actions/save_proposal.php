<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = mysqli_real_escape_string($con, $_POST['sid']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$area_study = mysqli_real_escape_string($con, $_POST['area_study']);
$supervisor_1 = $_POST['supervisor_1'];
$supervisor_2 = $_POST['supervisor_2'];
$supervisor_3 = $_POST['supervisor_3'];

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


if ($supervisor_1 > 0) {
    $supervisor_1Ok = 1;
}

if ($supervisor_2 > 0) {
    $supervisor_2Ok = 1;
}

if ($supervisor_3 > 0) {
    $supervisor_3Ok = 1;
}

$val = $supervisor_1Ok + $supervisor_2Ok + $supervisor_3Ok;

if ($val < 1) {
    die(errormes('Atleast one supervisor is required'));
    exit();
}

$validation  = $titleOk + $area_studyOk;
if ($validation == 2) {
    ////________Proceed
    if ($sid > 0) {
        ///////__________-Update  without proposal
        $updatestring = "user='$myid',title='$title', area_study='$area_study', supervisor_1='$supervisor_1',supervisor_2='$supervisor_2',supervisor_3='$supervisor_3',date_modified='$fulldate'";
        $update = updatedb('d_proposals', $updatestring, "uid='$sid'");
        if ($update == 1) {
            echo sucmes('Proposal Details updated Successfuly');
            $proceed = 1;
        } else {
            echo errormes('Unable to update Proposal Details');
        }
    } else {
        ///________________________create new proposal

        $fds = array('user', 'title', 'area_study', 'supervisor_1', 'supervisor_2', 'supervisor_3', 'added_date', 'status');
        $vals = array("$myid", "$title", "$area_study", "$supervisor_1", "$supervisor_2", "$supervisor_3", "$fulldate", "1");
        $create = addtodb('d_proposals', $fds, $vals);

        if ($create == 1) {
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
