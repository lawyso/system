<?php
session_start();
include_once('includes/conn.inc');
include_once('includes/func.php');
if(isset($_SESSION['dms_']))
    {
$valid_session = validate_session($_SESSION['dms_']);
if($valid_session == 1)
         {
     ////_________Session is already set. proceed to page
         }
  else
         {
        header('location:login.php');
       echo '<meta http-equiv="refresh" content="0; url=login.php">'; ///Redirect plan B
       die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
       exit();
         }
    }
else
    {
       header('location:login.php');
       echo '<meta http-equiv="refresh" content="0; url=login.php">'; ///Redirect plan B
       die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
       exit();  
    }

?>