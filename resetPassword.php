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
    <title>DMS| Account Password Recovery</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/avatar.png" alt="Dissertation Management System" />
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

<body>
    <div class="login-page page-body">
        <div class="main-header">
            <h3 style="padding-left:20px">DMS SYSTEM <a href="https://www.desoletech.co.ke"><span class="fa fa-book" style="float:right;padding-right:20px;font-size:17px"> Docs</span></h3>
            </a>
        </div>
        <?php
        if ((isset($_GET['fp_code'])) && (isset($_GET['fp_email'])) && (isset($_GET["action"]))
            && ($_GET["action"] == "reset") && (!isset($_POST["action"]))
        ) {
            $reset_token = $_GET['fp_code'];
            $reset_email = $_GET['fp_email'];
            $curDate = date("Y-m-d H:i:s");

            $em = fetchonerow('d_users_primary', "primary_email='$reset_email'", "uid");
            $userid = $em['uid'];

            $unusedToken_exist = checkrowexists('d_passes', "pass_reset_token='$reset_token' AND reset_status='0' AND user='$userid'");

            if ($unusedToken_exist == 1) {
                $expDate = fetchrow('d_passes', "pass_reset_token='$reset_token' AND reset_status='0' AND user='$userid'", "expDate");
                if ($expDate >= $curDate) {
                    ?>
                    <div class="login-box">
                        <!-- /.login-logo -->
                        <div class="login-box-body">
                            <br>
                            <form onsubmit="return false;" method="post">
                                <fieldset>
                                    <legend style="color:rgb(17, 122, 101)">Reset Your Password</legend>
                                    <div class="form-group has-feedback">
                                        <input type="hidden" id="userid" class="form-control" value="<?php echo $userid ?>" />
                                        <input type="password" id="u_pass" class="form-control" placeholder="New Password" />
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" id="u_passConfirm" class="form-control" placeholder="Confirm Password" />
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <button type="submit" onclick="reset_pass();" class="btn btn-primary btn-block" style="background-color: rgb( 17, 122, 101);color: #ffff">Reset Password</button>

                                    </div><!-- /.col -->
                                    <span id="resetPass_feedback" class=notifications-menu></span>
                                </fieldset>
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
                } else {
                    $error .= "<h2><i class='fa fa-exclamation-triangle'></i> Link Expired</h2>
            <p>The link is expired. You are trying to use the expired link which was valid for only 24 hours (1 days after request).<br /><br /></p>";
                }
            } else {
                $error .= '<h2><i class="fa fa-exclamation-triangle text-red"></i> Invalid Link</h2>
            <p>The link is invalid/expired. Either you did not copy the correct link
            from the email, or you have already used the key in which case it is
            deactivated.</p>
            <p><a href="index.php"> Click here</a> to reset password.</p>';
            }
            if ($error != "") {
                echo "<div class='login-box'>
                    <div class='login-box-body'>
                        <div class='error'>" . $error . "</div>
                    </div>
            <div/>";
            }
        }
        ?>
    </div>

</body>

</html>
