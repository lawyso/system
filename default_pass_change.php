<?php
session_start();
include_once('includes/conn.inc');
include_once('includes/func.php');

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>DMS| Account Password Change</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="styles/layout.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="styles/main.css" />
  <style>
    .error p {
      color: #FF0000;
      font-size: 20px;
      font-weight: bold;
      margin: 50px;
      text-align: center
    }
  </style>
</head>

<body class="login-page">

  <?php
  if (isset($_GET['redirect_id'])) {
    $userid = decurl($_GET['redirect_id']);

    ?>
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
          Change Your Default Password
        </p>
        <br>
        <form onsubmit="return false;" method="post">
          <input type="hidden" id="userid" class="form-control" value="<?php echo $userid ?>" />

          <div class="form-group has-feedback">
            <label for="New Password">New Password:</label>
            <input type="password" id="new_pass" class="form-control" placeholder="New Password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <label for="Confirm New Password">Confirm New Password:</label>
            <input type="password" id="new_passConfirm" class="form-control" placeholder="Confirm New Password" required /><span id='message'></span>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-8">

            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" onclick="change_Defaultpass();" class="btn btn-primary btn-block btn-flat" style="background-color: rgb( 17, 122, 101);color: #ffff">Change Password</button>

            </div><!-- /.col -->
          </div>
          <br />
          <span id="changePass_feedback"></span>
        </form>

      </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>

  <?php

  }
  ?>

</body>

</html>
