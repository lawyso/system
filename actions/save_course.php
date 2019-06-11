<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$sid = $_POST['sid'];
$department = $_POST['department'];
$school = $_POST['school'];
$course = $_POST['course'];
$admission_date = $_POST['admission_date'];


////////////___________Validation

if($course > 0){$courseOk = 1;} else{die(errormes('Course name is required'));exit();}
if($department > 0){$departmentOk = 1;} else{die(errormes('Department name is required'));exit();}
if($school > 0){$schoolOk = 1;} else{die(errormes('School/Fuculty name is required'));exit();}
$admission_dateOk = input_length($admission_date,2);if($admission_dateOk == 0){die(errormes('Admission Date is required'));exit();}

$course_duration = fetchrow('d_courses',"uid='$course'",'course_duration');



$validation  = $courseOk + $departmentOk + $schoolOk + $admission_dateOk;
if($validation == 4)
    {
        if($sid > 0)
            {
                ///update
                $updatestring = "department='$department', course='$course', school='$school',admission_date='$admission_date',course_duration='$course_duration'";
                $update = updatedb('d_users_courses',$updatestring,"uid='$sid'");
                if($update == 1)
                   {
                    echo sucmes('Course Details updated Successfuly');
                     $proceed = 1;   
                   }
                else
                   {
                    echo errormes('Unable to update Course Details');
                   }
            }
        else
            {
                ///create
                
                

                $fds = array('user','course','admission_date','department','school','course_duration','status');
                $vals = array("$myid","$course","$admission_date","$department","$school","$course_duration",'1');
                $create = addtodb('d_users_courses',$fds,$vals);
                
                if($create == 1)
                    {
                    echo sucmes('New Course Registered Successfully');  
                     
                    $proceed = 1;  
                       
                    }
                else
                   {
                   echo errormes('Unable to Register for The New User');
                   }
            }
    }

?>


<script>
    var action = '<?php echo $proceed; ?>';
    if (action == '1') {
        {
            setTimeout(function() {
                window.location.href = 'register.php'; // the redirect goes here

            }, 5000); // 5 seconds

        }

    }
</script>


