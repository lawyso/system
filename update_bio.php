<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Bio-Data || Details</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    $(document).ready(function(e) {
      // Submit form data via Ajax
      $("#bioForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'actions/update_bio.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#bioForm').css("opacity", ".5");
          },
          success: function(response) { //console.log(response);
            $('.statusMsg').html('');
            if (response.status == 1) {
              $('#bioForm')[0].reset();
              $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
              setTimeout(function() {
                reload();
              }, 5000);

            } else {
              $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
            }
            $('#bioForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
          }
        });
      });
      // File type validation
      $("#profile_").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['image/jpg', 'image/png', 'image/jpeg'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
          alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
          $("#profile_").val('');
          return false;
        }
      });
    });
  </script>
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  include_once 'includes/conn.inc';
  include_once 'includes/func.php';

  ?>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-2 mb-sm-0 pt-1">
                <a href="#" target="_blank">Bio-data</a>
                <span>/</span>
                <span>Update</span>
              </h5>
            </div>
            <!--Card content-->
            <div class="card-body">

              <?php

              $sid = $myid;
              $sd = fetchonerow('d_users_primary', "uid='$sid'");
              $first_name = $sd['first_name'];
              $last_name = $sd['last_name'];
              $primary_email = $sd['primary_email'];
              $primary_phone = $sd['primary_phone'];
              $national_id = $sd['national_id'];
              $user_name = $sd['user_name'];
              $user_group = $sd['user_group'];
              $group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
              $title = $sd['title'];
              $title_name = fetchrow('d_title', "uid='$title'", "name");
              ?>
              <form role="form" method="POST" enctype="multipart/form-data" id="bioForm">
                <table class="table table-bordered table-striped">
                  <tr>
                    <td>Title</td>
                    <td>
                      <select class="form-control" name="title" <?php echo $disabled; ?> required>
                        <option value="0">~Select~</option>
                        <?php
                        $tl = fetchtable('d_title', "status=1", "name", "asc", "100");
                        while ($t = mysqli_fetch_array($tl)) {
                          $uid = $t['uid'];
                          $name = $t['name'];
                          if ($uid == $title) {
                            $tselected = 'SELECTED';
                          } else {
                            $tselected = '';
                          }
                          echo "<option $tselected value=\"$uid\">$name</option>";
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td>First Name</td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $first_name; ?>" name="first_name" required />
                    </td>
                  </tr>
                  <tr>
                    <td>Last Name</td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $last_name; ?>" name="last_name" required />
                    </td>
                  </tr>
                  <tr>
                    <td>Primary Email</td>
                    <td>
                      <input type="hidden" value="<?php echo $sid; ?>" name="sid" />
                      <input type="text" disabled class="form-control" value="<?php echo $primary_email; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td>Primary Phone</td>
                    <td>
                      <input type="text" name="phone_no" class="form-control" value="<?php echo $primary_phone; ?>" required />
                    </td>
                  </tr>
                  <tr>
                    <td>National Id</td>
                    <td>
                      <input type="text" disabled class="form-control" value="<?php echo $national_id; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td>Username</td>
                    <td>
                      <input type="text" disabled class="form-control" value="<?php echo $user_name; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td>Group</td>
                    <td>
                      <input type="text" disabled class="form-control" value="<?php echo $group_name; ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td>Profile Image</td>
                    <td>
                      <input type="file" name="profile_" class="form-control" id="profile_">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="statusMsg">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="submit" name="submit" class="btn btn-sm btn-dms submitBtn" value="Update Profile" />
                    </td>
                  </tr>
                </table>
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
