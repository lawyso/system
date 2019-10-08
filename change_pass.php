<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Home || Dashboard</title>
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  ?>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Profile</a>
            <span>/</span>
            <span>Change Password</span>
          </h4>


        </div>

      </div>
      <!-- Heading -->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">

              <h3>Change Your Account Password</h3>

              <form onsubmit="return false;" method="post">
                <div class="form-group">
                  <input type="password" id="old_pass" class="form-control" placeholder="Old Password" />
                </div>
                <div class="form-group">
                  <input type="password" id="new_pass" class="form-control" placeholder="New Password" />
                </div>
                <div class="form-group">
                  <input type="password" id="new_passConfirm" class="form-control" placeholder="Confirm New Password" />
                </div>
                <div class="form-group">
                  <span id="passfeed"></span>
                </div>
                <div class="form-group">

                  <button type="submit" onclick="changepass();" class="btn btn-block btn-flat" style="background-color: rgb( 17, 122, 101);color: #ffff">Change Password</button>
                </div>
                <div class="form-group">
                  <span><i>
                      <ul>
                        <li>Password must be atleast 8 characters</li>
                        <li>A mixture of both uppercase and lowercase letters</li>
                        <li>A mixture of letters and numbers.</li>
                        <li>Inclusion of at least one special character, e.g., ! @ # ? ]</li>
                      </ul>
                    </i></span>
                </div>

              </form>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->



      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <?php include_once 'footer.php'; ?>
</body>

</html>
