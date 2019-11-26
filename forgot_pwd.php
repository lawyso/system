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
  <!-- ajax javascript library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
    $(document).ready(function(e) {
      // Submit form data via Ajax
      $("#forgotPassForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'actions/forgot_pwd.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#forgotPassForm').css("opacity", ".5");
          },
          success: function(response) { //console.log(response);
            $('.statusMsg').html('');
            if (response.status == 1) {
              $('#forgotPassForm')[0].reset();
              $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
              setTimeout(function() {
                reload();
              }, 5000);

            } else {
              $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
            }
            $('#forgotPassForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
          }
        });
      });
    });
  </script>
  <style>
    .login-box {
      opacity: 0.9;
      position: relative;
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
    <div class="login-box">
      <div class="statusMsg"></div>
      <div class="login-box-body">
        <form method="POST" enctype="multipart/form-data" id="forgotPassForm">
          <fieldset>
            <legend style="color:rgb(17, 122, 101)">Forgot your password?</legend>
            <p>Enter your registration Email Address and we will send you a password reset link.
            </p>
            <div class="form-group has-feedback">
              <label for="Email Address">Email Address:</label>
              <input type="text" id="u_name" name="u_name" class="form-control" placeholder="e.g kamau@example.com" autofocus required />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="submit" name="submit" class="btn btn-md btn-block submitBtn submit-button" value="Send" />
            </div>
            <h4>Already have an account? <a href="index" style="color:rgb(17, 122, 101)">Log In </a></h4>
          </fieldset>
        </form>
      </div>
    </div>
  </div>

  <!--/.Login page-footer -->
  <div class="main-footer">
    <p class="copyright">
      &copy;DMS, <script>
        var currentYear = new Date().getFullYear();
        document.write(currentYear);
      </script>,
      All Rights Reserved. </p>
  </div>
  <!--/.Login page-footer -->
  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>

</body>

</html>
