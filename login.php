<?php
session_start();
if (isset($_GET['logout'])) {
  unset($_SESSION['dms_']);
  session_destroy();
} else {
  include_once 'no_session.php';
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dissertation Management System</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- favicon -->
  <link rel="shortcut icon" href="images/avatar.png" alt="Dissertation Management System" />
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- Customed Theme style -->
  <link href="styles/layout.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="styles/main.css" />
  <style>
    .login-box {
      opacity: 0.8;
      position: relative;
    }

    .login-button {
      background-color: rgb(17, 122, 101);
      color: #ffff
    }
  </style>
</head>

<body>
  <div class="login-page page-body">
    <div class="main-header">
      <h3 style="padding-left:20px">DMS SYSTEM <a href="https://www.desoletech.co.ke"><span class="fa fa-book" style="float:right;padding-right:20px;font-size:17px"> Docs</span></h3>
      </a>
    </div>
    <hr />

    <!-- /.login-box -->
    <div class="login-box">
      <span id="login_feedback"></span>
      <!-- /.login-box-body -->
      <div class="login-box-body">

        <form onsubmit="return false;" method="post">
          <fieldset>
            <legend style="color:rgb(17, 122, 101)">Log in to your account</legend>
            <div class="form-group has-feedback">
              <label for="Username">Username/Email:</label>
              <input type="text" id="u_name" autofocus="" auto-complete="off" class="form-control" placeholder="Email/Username" auto-complete="off" />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="Password">Password:</label>
              <input type="password" id="u_pass" class="form-control" auto-complete="off" placeholder="Password" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <button type="submit" onclick="login();" class="btn btn-block btn-md login-button">Sign In</button>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <h4><a href="forgot_pwd" style="color:rgb(17, 122, 101)">Forgot your Password ?</a></h4>
              </div>
            </div>


          </fieldset>
        </form>
      </div> <!-- /.login-box-body -->
    </div>
    <!--/.Login page-footer -->

  </div>
  <div class="main-footer">
    <p class="copyright">
      &copy;DMS, <script>
        var currentYear = new Date().getFullYear();
        document.write(currentYear);
      </script>,
      All Rights Reserved. </p>
  </div>
  <!--/.Login page-footer -->
  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
