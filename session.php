<?php
session_start();
include_once('includes/conn.inc');
include_once('includes/func.php');
if (isset($_SESSION['dms_'])) {
    $valid_session = validate_session($_SESSION['dms_']);
    $_hasPass_chaged = check_passChange($_SESSION['dms_']);
    if ($valid_session == 1 && $_hasPass_chaged == 1) {
        ////_________Session is already set and default password has been changed. proceed to index page
    }
    if ($valid_session == 0) {
        header('location:login.php');
        echo '<meta http-equiv="refresh" content="0; url=login.php">'; ///Redirect plan c
        die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
        exit();
    }
    if ($_hasPass_chaged == 0) {
        header('location:default_pass_change.php?redirect_id=' . $_SESSION['dms_'] . '');
        echo '<meta http-equiv="refresh" content="0; url=login.php">'; ///Redirect plan c
        die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
        exit();
    }
} else {
    header('location:login.php');
    echo '<meta http-equiv="refresh" content="0; url=login.php">'; ///Redirect plan B
    die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
    exit();
}
