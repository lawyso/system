<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = $_POST['sid'];
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);


////////////___________Validation
if ($title > 0) {
    $titleOk = 1;
} else {
    die(errormes('Title is required'));
    exit();
}
$first_nameOk = input_length($first_name, 2);
if ($first_nameOk == 0) {
    die(errormes('First name is needed'));
    exit();
}
$last_nameOk = input_length($last_name, 2);
if ($last_nameOk == 0) {
    die(errormes('Last name is needed'));
    exit();
}
$phoneOk = validate_phone($phone_no);
if ($phoneOk == 0) {
    die(errormes('Phone needed in the format 2547...'));
    exit();
} else {
    $phoneExists = checkrowexists('d_users_primary', "primary_phone='$phone_no' AND uid!=$sid");
    if ($phoneExists == 1) {
        die(errormes('Phone Number already exists'));
        exit();
    } else {
        $phoneUnique = 1;
    }
}



$validation  =  $first_nameOk + $last_nameOk + $titleOk + $phoneUnique + $phoneOk;
if ($validation == 5) {

    ///update
    $updatestring = "title='$title',first_name='$first_name', last_name='$last_name', primary_phone='$phone_no'";
    $update = updatedb('d_users_primary', $updatestring, "uid='$sid'");
    if ($update == 1) {
        echo sucmes('Bio Details updated Successfuly');
        $proceed = 1;
    } else {
        echo errormes('Unable to update Bio Details.Try again Later');
    }
}

?>
<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'update_bio.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>
