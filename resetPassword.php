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
    <title>Exodus| Account Recover</title>
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

    <?php
    if ((isset($_GET['fp_code'])) && (isset($_GET['fp_email']))) {
        $reset_token = $_GET['fp_code'];
        $reset_email = $_GET['fp_email'];

        $em = fetchonerow('d_users_primary', "primary_email='$reset_email'", "uid");
        $userid = $em['uid'];

        $unusedToken_exist = checkrowexists('d_passes', "pass_reset_token='$reset_token' AND reset_status='0' AND user='$userid'");

        if ($unusedToken_exist == 1) {
            ?>
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">
                        Reset Your Account Password
                    </p>
                    <br>
                    <form onsubmit="return false;" method="post">
                        <div class="form-group has-feedback">
                            <input type="hidden" id="userid" class="form-control" value="<?php echo $userid ?>" />
                            <input type="password" id="u_pass" class="form-control" placeholder="New Password" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" id="u_passConfirm" class="form-control" placeholder="Confirm Password" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">

                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" onclick="reset_pass();" class="btn btn-primary btn-block btn-flat" style="background-color: rgb(13, 27, 112);color: #f4c016">Reset Password</button>

                            </div><!-- /.col -->
                        </div>
                        <span id="resetPass_feedback"></span>
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
            <script>
                $(function() {
                    $('input').iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue',
                        increaseArea: '20%' // optional
                    });
                });
            </script>
    <?php
        } else {
            die('<span>
            <div class="alert alert-danger">
                <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                Invalid/Expired Link.
            </div>
        </span>');
            exit('');
        }
    } else {
        die('<span>
            <div class="alert alert-danger">
                <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                You don\'t have permission to view this page directly. Please use the link sent to you via your registered email.
            </div>
        </span>');
        exit('');
    }
    ?>

</body>

</html>
