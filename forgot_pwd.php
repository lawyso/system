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
  <title>DMS| Password Recovery</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="styles/layout.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="styles/main.css" />

</head>

<body class="login-page">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-sm-8">
      <img src="images/pass_reset.jpg" style="width:180px;height:150px;margin-top:100px; float:inline-start;margin-left:250px" class="img-responsive">

      <div class="login-box">
        <div class="login-logo">
          <a href="index2.html">Reset Password</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Enter Your Registered Email to Reset Your Password</p>
          <br>
          <form onsubmit="return false;" method="post">
            <div class="form-group has-feedback">
              <input type="text" id="u_name" class="form-control" placeholder="Email" />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
              <div class="col-xs-4">
              </div>
              <div class="col-xs-4">
              </div>

              <div class="col-xs-4">
                <button type="submit" onclick="forgot_pwd();" class="btn btn-primary btn-block btn-flat" style="background-color: rgb( 17, 122, 101);color: #F7F7F7">Submit</button>

              </div><!-- /.col -->
            </div>
            <span id="forgot_pswd_feedback"></span>
          </form>

        </div><!-- /.login-box-body -->
      </div><!-- /.login-box -->
    </div>
    <div class="col-md-2">
    </div>
  </div>
  <!-- jQuery 2.1.3 -->
  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>
