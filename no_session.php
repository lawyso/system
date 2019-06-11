<?php

include_once('includes/conn.inc');
include_once('includes/func.php');

if(isset($_SESSION['dms_']))
    {
$valid_session = validate_session($_SESSION['dms_']);
if($valid_session == 1)
         {
      ////_________Session is already set. Go to dashboard
       header('location:index');
       echo '<meta http-equiv="refresh" content="0; url=index">'; ///Redirect plan B
       die('Error displaying page. Please consult your administrator'); ///System could not redirect nor display the page
       exit();
         }
  else
         {
       
         }
    }
else
    {
      
    }

?>