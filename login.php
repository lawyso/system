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
  <title>DMS Portal</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="styles/layout.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="styles/main.css" />
</head>

<body class="login-page" style="background:url(images/grads2.jpg) no-repeat;">
  <div class="login-box" style="opacity:0.85">
    <br /> <br /> <br />
    <div class="login-box-body">
      <p class="login-box-msg">DMS PORTAL LOGIN</p>
      <br>
      <h5 onsubmit="return false;" method="post">
        <div class="form-group has-feedback">
          <input type="text" id="u_name" class="form-control" placeholder="Email/Username" auto-complete="off" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="u_pass" class="form-control" placeholder="Password" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <h4><a href="forgot_pwd">Forgot your Password ?</a></h4>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" onclick="login();" class="btn btn-primary btn-block btn-flat" style="background-color: rgb( 17, 122, 101);color: #ffff">Sign In</button>
          </div><!-- /.col -->
        </div>
        <br>
        <span id="login_feedback"></span>

    </div><!-- /.login-box-body -->
    <br>
    <div style="text-align: center;">
      <p class="copyright">
        <strong>DMS &copy;<script>
            var currentYear = new Date().getFullYear();
            document.write(currentYear);
          </script>
          All Rights Reserved. </strong>
      </p>
    </div>
  </div><!-- /.login-box -->

  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>

</body>

</html>
