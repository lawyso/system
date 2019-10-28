<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';


$project_title = mysqli_real_escape_string($con, $_POST['project_title']);
$defense_date = mysqli_real_escape_string($con, $_POST['defense_date']);
$user = $myid;

$department = fetchrow('d_users_primary', "uid='$myid'", "department");
$school = fetchrow('d_users_primary', "uid='$myid'", "faculty");
////////////___________Validation
$titleOk = input_length($project_title, 12);
if ($titleOk == 0) {
    die(errormes('Project Title is required'));
    exit();
}

if ($department > 0) {
    $departmenteOk = 1;
} else {
    die(errormes('Error in specifying the department'));
    exit();
}

if ($school > 0) {
    $schoolOk = 1;
} else {
    die(errormes('Error in specifying the school/faculty'));
    exit();
}
$defense_dateOk = input_length($defense_date, 5);
if ($defense_dateOk == 0) {
    die(errormes('Please specify the defense date'));
    exit();
}


$validation  = $titleOk + $departmenteOk + $schoolOk + $defense_dateOk;
if ($validation == 4) {

    ///________________________create new defense

    $fds = array('project_title', 'department', 'faculty', 'defender', 'defense_date', 'added_date', 'defense_status');
    $vals = array("$project_title", "$department", "$school", "$user", "$defense_date", "$fulldate", "0");
    $create = addtodb('d_defense', $fds, $vals);

    if ($create == 1) {
        echo sucmes('Defense Application Successfully Sent');

        $proceed = 1;
    } else {
        echo errormes('Unable to Submit Defense Application');
    }
}

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'defense.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
