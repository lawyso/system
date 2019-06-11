<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = $_POST['sid'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$national_id = $_POST['national_id'];
$primary_email = $_POST['primary_email'];
$primary_phone = $_POST['primary_phone'];
$user_name = $_POST['user_name'];
$user_group = $_POST['user_group'];
$gender = $_POST['gender'];
$password = $user_name;
$status = $_POST['status'];
$department = $_POST['department'];
$faculty = $_POST['school'];
$title = $_POST['title'];



////////////___________Validation

$first_nameOk = input_length($first_name,2);           if($first_nameOk == 0){die(errormes('First name needed'));exit();}
$last_nameOk = input_length($last_name,2);             if($last_nameOk == 0){die(errormes('Last name needed'));exit();}
$national_idOk = input_between(6,10,$national_id); if($national_idOk == 0){die(errormes('National id invalid'));exit();}
$emailOk = emailOk($primary_email); if($emailOk == 0){echo errormes('Email invalid');} 
else{ $emailExists = checkrowexists('d_users_primary',"primary_email='$primary_email' AND uid!=$sid");
if($emailExists == 1){die(errormes('Email exists'));exit();} else{$emailUnique = 1;}}
$primary_phoneOk = validate_phone($primary_phone); 
if($primary_phoneOk == 0){die(errormes('Phone needed in the format 2547...'));exit();} 
else{  $phoneExists = checkrowexists('d_users_primary',"primary_phone='$primary_phone' AND uid!=$sid"); 
    if($phoneExists == 1){die(errormes('Primary Phone exists'));exit();} else{$phoneUnique = 1;}}
$user_nameOk = input_length($user_name,5);             if($user_nameOk == 0){die(errormes('Username too short <5'));exit();}
if($user_group > 0){$user_groupOk = 1;} else{die(errormes('User Group needed'));exit();}
if($gender > 0){$genderOk = 1;} else{die(errormes('Section needed'));exit();}
//if($status > 0){$statusOk = 1;} else{die(errormes('Status needed'));exit();}




$validation  =  $first_nameOk + $last_nameOk + $emailOk +$emailUnique + $primary_phoneOk + $phoneUnique + $user_nameOk + $user_groupOk + $genderOk + $national_idOk;
if($validation == 10)
    {
        if($sid > 0)
            {
                ///update
                $updatestring = "title='$title',first_name='$first_name', last_name='$last_name', primary_email='$primary_email',primary_phone='$primary_phone',department='$department',faculty='$faculty',user_group='$user_group', gender='$gender',status='$status',national_id='$national_id'";
                $update = updatedb('d_users_primary',$updatestring,"uid='$sid'");
                if($update == 1)
                   {
                    echo sucmes('User Details updated Successfuly');
                     $proceed = 1;   
                   }
                else
                   {
                    echo errormes('Unable to update User Details');
                   }
            }
        else
            {
                ///create
                
                
                 $epass = passencrypt($password);
        $hash = substr($epass, 0, 64);
        $salt = substr($epass, 64, 96);

                $fds = array('first_name','last_name','primary_email','primary_phone','user_name','pass','added_date','added_by','user_group','gender','status','national_id');
                $vals = array("$first_name","$last_name","$primary_email","$primary_phone","$user_name","$hash","$fulldate","$myid","$user_group","$gender",'1',"$national_id");
                $create = addtodb('d_users_primary',$fds,$vals);
                
                if($create == 1)
                    {
                  echo sucmes('User Created Successfully');  
                    $userid = fetchrow('d_users_primary', "primary_email='$primary_email'", "uid"); 
                    $proceed = 1;  
                        $fdss = array('user', 'pass');
                        $valss = array("$userid", "$salt");
                        $savesalt = addtodb('d_passes', $fdss, $valss);
                if ($savesalt == 1) {
                        echo sucmes('Default password created');
                        }
                        else
                        {
                            echo errormes('Unable to Create password');
                        }
                    }
                else
                   {
                   echo errormes('Unable to Create New User');
                   }
            }
    }

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'settings.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>

