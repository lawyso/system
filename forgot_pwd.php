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
  <title>Dissertation Management System || Password Recovery</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- favicon -->
  <link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
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
    .page-body {
      background: url(images/dms_bg.jpg);
      background-repeat: no-repeat;
      background-size: cover
    }

    .login-box {
      opacity: 0.9;
      position: relative;
    }

    .submit-button {
      background-color: rgb(17, 122, 101);
      color: #ffff
    }
  </style>
</head>

<body class="login-page page-body">
  <br /><br />
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-sm-8">
      <div class="login-box">
        <div class="login-box-body">
          <p class="login-box-msg">Lost Password Recovery</p>
          <p>Please enter your account email address below to reset your password.If you do not wish to proceed, please
            <a href="index">click here</a> to return to login
          </p>
          <br />
          <form method="POST" enctype="multipart/form-data" id="forgotPassForm">

            <div class="form-group has-feedback">
              <label for="Email Address">Email Address:</label>
              <input type="text" id="u_name" name="u_name" class="form-control" placeholder="e.g kamau@example.com" autofocus />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
              <div class="col-xs-8">
              </div>
              <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-md submitBtn submit-button" value="submit" />
              </div>
            </div>
            <br />
            <div class="statusMsg"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
  </div>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>

</body>

</html>
