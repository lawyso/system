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
  include_once 'includes/conn.inc';
  include_once 'includes/func.php';

  ?>
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-header">

              <h5 class="mb-2 mb-sm-0 pt-1">
                <a href="#" target="_blank">Profile</a>
                <span>/</span>
                <span>My details</span>
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
              $department = $sd['department'];
              $department_name = fetchrow('d_departments', "uid='$department'", "department_name");
              $school = $sd['faculty'];
              $school_name = fetchrow('d_schools', "uid='$school'", "school_name");
              $title = $sd['title'];
              $title_name = fetchrow('d_title', "uid='$title'", "name");
              ?>

              <table class="table table-bordered table-striped">

                <tr>
                  <td>Full Names</td>
                  <td><?php echo $title_name . ' ' . $first_name . ' ' . $last_name; ?></td>
                </tr>

                <tr>
                  <td>Primary Email</td>
                  <td><?php echo $primary_email; ?></td>
                </tr>
                <tr>
                  <td>Primary Phone</td>
                  <td><?php echo $primary_phone; ?></td>
                </tr>
                <tr>
                  <td>National Id</td>
                  <td><?php echo $national_id; ?></td>
                </tr>
                <tr>
                  <td>Username</td>
                  <td><?php echo $user_name; ?></td>
                </tr>
                <tr>
                  <td>Group</td>
                  <td><?php echo $group_name; ?></td>
                </tr>
                <?php
                if ($user_group == 2) {
                  ?>
                  <tr>
                    <td>Course</td>
                    <td></td>
                  </tr>
                <?php
                }
                if ($user_group != 1) {
                  ?>
                  <tr>
                    <td>Department</td>
                    <td><?php echo $department_name; ?></td>
                  </tr>
                  <tr>
                    <td>School/Faculty</td>
                    <td><?php echo $school_name; ?></td>
                  </tr>
                <?php
                }
                ?>
                <tr>
                  <td colspan="2"><button class="btn disabled" onclick="update_profile()" style="background-color: rgb( 17, 122, 101);color: #ffff;display:none">Update Profile</button></td>
                </tr>



              </table>

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
