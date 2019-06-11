<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = $_POST['sid'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$department = $_POST['department'];
$faculty = $_POST['school'];
$title = $_POST['title'];



////////////___________Validation
if($title > 0){$titleOk = 1;} else{die(errormes('Title is required'));exit();}
$first_nameOk = input_length($first_name,2);           if($first_nameOk == 0){die(errormes('First name needed'));exit();}
$last_nameOk = input_length($last_name,2);             if($last_nameOk == 0){die(errormes('Last name needed'));exit();}
if($department > 0){$departmentOk = 1;} else{die(errormes('Department is Required'));exit();}
if($faculty > 0){$facultyOk = 1;} else{die(errormes('Faculty/school is required'));exit();}


$validation  =  $first_nameOk + $last_nameOk + $titleOk + $departmentOk + $facultyOk;
if($validation == 5)
    {
        
                ///update
                $updatestring = "title='$title',first_name='$first_name', last_name='$last_name',department='$department',faculty='$faculty'";
                $update = updatedb('d_users_primary',$updatestring,"uid='$sid'");
                if($update == 1)
                   {
                    echo sucmes('Bio Details updated Successfuly');
                     $proceed = 1;   
                   }
                else
                   {
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


