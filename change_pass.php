<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Home || Dashboard</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
          <div class="card  align-center">

            <!--Card content-->
            <div class="card-body">

              <h3>Change Your Account Password</h3>

              <form onsubmit="return false;" method="post">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4">
                      <label for="Old Password">Old Password:</label>
                      <input type="password" id="old_pass" class="form-control" placeholder="Old Password" />
                    </div>
                    <div class="col-lg-4">
                      <label for="New Password">New Password:</label>
                      <input type="password" id="new_pass" class="form-control" placeholder="New Password" />
                    </div>
                    <div class="col-lg-4">
                      <label for="Confirm New Password">Confirm New Password:</label>
                      <input type="password" id="new_passConfirm" class="form-control" placeholder="Confirm New Password" /><span id='message'></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-12">
                      <span id="passfeed"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4">
                      <button type="submit" onclick="changepass();" class="btn btn-flat" style="background-color: rgb( 17, 122, 101);color: #ffff">Change Password</button>
                    </div>
                  </div>
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
        <script>
          $('#new_passConfirm').on('keyup', function() {
            if ($(this).val() == $('#new_pass').val()) {
              $('#message').html('matching').css('color', 'green');
            } else $('#message').html('not matching').css('color', 'red');
          });
        </script>


      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <?php include_once 'footer.php'; ?>
</body>

</html>
