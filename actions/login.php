<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  $email = mysqli_real_escape_string($con, $_POST['u_name']);
  $password = mysqli_real_escape_string($con, $_POST['u_pass']);

  //////////////________________check if username is supplied
  $emailOk = input_available($email);
  if ($emailOk == 0) {
    echo error('<i class="fa fa-exclamation-triangle"></i> Email/Username invalid');
  }
  ////////////_____________________Check if Password is supplied
  $passwordOk = input_available($password);
  if ($passwordOk == 0) {
    echo error('<i class="fa fa-exclamation-triangle"></i> Password is required');
  }

  ///////////___________validation check
  $validation = $emailOk + $passwordOk;

  if ($validation == 2) {
    $username = $email;

    /////////_______________ Check account
    /////////~~~~~~~~Fetch user id
    $userid = fetchrow('d_users_primary', "status='1' AND primary_email='$username'
        || user_name='$username'AND status='1' ", 'uid');

    ///~~~~~~~Fetch  salt
    $username = fetchrow('d_users_primary', "status='1' AND primary_email='$username'
        || user_name='$username'AND status='1' ", 'user_name');

    if ($userid > 0) {
      $thesalt = fetchrow('d_passes', "user='$userid'", 'pass');
      ////apendsalt to inputted password
      $fullpass = $thesalt . $password;
      $encpass = hash('SHA256', $fullpass);
      ////fetch user pass from db
      $databasepass = fetchrow('d_users_primary', "uid='$userid'", 'pass');

      if ($encpass == $databasepass) {
        $encuserid = encurl($userid);
        ////////////////_________Registering session
        $_SESSION['dms_'] = $encuserid;
        if (isset($_SESSION['dms_'])) {
          $refresh = 1;
          ////////////________Login success proceed to homepage
          echo sucmes('Successfully loggedin. Please wait...');
        } else {
          echo errormes('<i class=\"fa fa-exclamation-triangle\"></i> Incorrect username and password combination');
        }
      } else {
        echo errormes("<i class=\"fa fa-exclamation-triangle\"></i> Incorrect password");
      }
    } else {
      echo errormes("<i class=\"fa fa-exclamation-triangle\"></i> Email/Username not found");
    }
  }
} else {
  echo $method . ' Not supported';
}

?>
<script>
  var action = '<?php echo $refresh; ?>';
  if (action == '1') {
    window.location = 'index';
  }
</script>
