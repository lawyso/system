<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $email = $_POST['u_name'];
    $password = $_POST['u_pass'];
    //////////////________________validation
    $emailOk = input_available($email);                    
    if ($emailOk==0){echo error('Email/Username invalid');}

    $passwordOk = input_available($password);
    if ($passwordOk==0){echo error('Password needed');}

    $validation = $emailOk+$passwordOk;

    if($validation==2)
          {
        $username=$email;
       

       //// Check account
        ///~~~~~~~~Fetch user id
        $userid=fetchrow('d_users_primary',"status='1' AND primary_email='$username' 
        || user_name='$username'AND status='1' ",'uid');  

        ///~~~~~~~Fetch  salt
        $username=fetchrow('d_users_primary',"status='1' AND primary_email='$username' 
        || user_name='$username'AND status='1' ",'user_name');  
       
         if($userid>0)
            {
        $thesalt=fetchrow('d_passes',"user='$userid'",'pass');
           ////apendsalt to inputted password
           $fullpass=$thesalt.$password;   
           $encpass=hash('SHA256',$fullpass);  
            ////fetch user pass from db
           $databasepass=fetchrow('d_users_primary',"uid='$userid'",'pass'); 
         
        
           if($encpass==$databasepass)
                 {
                       $encuserid = encurl($userid);
                       $_SESSION['dms_']=$encuserid;
                           if(isset($_SESSION['dms_']))
                                   {
                                    $refresh = 1; 
                                   
                                    ////////////________
                                  echo sucmes('Successfully loggedin. Please wait...');
                                  
                                  
                                   }
                                else
                                    {
                                  echo errormes('*Incorrect username and password combination');
                                    }
                 }
                 else
                  {
                  echo errormes("Incorrect password");
                  }
          
            }
            else
             {
             echo errormes("Email not found in our records");
             }
           
       }


}
else
  {
  echo $method.' Not supported';
  }


?>
<script>
var action = '<?php echo $refresh; ?>';
if(action == '1')
   {
 window.location='index'; 
   }
 </script>
 
 
   