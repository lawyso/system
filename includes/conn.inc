<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
date_default_timezone_set("Africa/Nairobi");
$hostname = 'localhost';        // Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
$dbname   = 'dms_portal'; // Your database name.
$username = 'dms_user';             // Your database username.
$password = 'prZ~1SnCk!Y-';     

// Your database password. If your database has no password, leave it empty.
// Let's connect to host
$con=mysqli_connect($hostname,$username,$password,$dbname);
if(mysqli_connect_errno())
    {
        printf('Error Establishing a database connection');
        exit();
    }
$thislocation='dms';
$date=date('Y-m-d');
$date2=date('Y-M-D');
$fulldate=date('Y-m-d H:i:s');
$thisyear=date('Y');
$thismonth=date('m');
$thismonthname=date('M');
$thisday=date('d');
$thisdayname=date('D');
     

?>