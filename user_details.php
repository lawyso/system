<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dissertation Management System || System Users</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
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

              <?php
              if (isset($_GET['user'])) {
                $esid = $_GET['user'];
                $sid = decurl($esid);
                $sd = fetchonerow('d_users_primary', "uid='$sid'");
                $first_name = $sd['first_name'];
                $last_name = $sd['last_name'];
                $primary_email = $sd['primary_email'];
                $primary_phone = $sd['primary_phone'];
                $national_id = $sd['national_id'];
                $user_name = $sd['user_name'];
                $title = $sd['title'];
                $topic = $sd['topic_id'];
                $topic_name = fetchrow('d_topics', "topic_id='$title'", "topic_name");
                $title_name = fetchrow('d_title', "uid='$title'", "name");
                $added_date = $sd['registerDate'];
                $reg_no = $sd['Reg_No'];
                $user_group = $sd['user_group'];
                $group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
                $gender = $sd['gender'];
                $gender_name = gender($gender);

                $status = $sd['status'];
                $status_name = admin_status($status);
              }
              ?>
              <a href="#" target="_blank"><?php echo $group_name; ?>'s Profile</a>


            </div>
            <div class="card-body box-body">
              <div class="col-lg-12">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td><b>Name:</b></td>
                      <td><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Gender:</b></td>
                      <td><?php echo $gender_name; ?></td>
                    </tr>
                    <tr>
                      <td><b>Email:</b></td>
                      <td><?php echo $primary_email; ?></td>
                    </tr>
                    <tr>
                      <td><b>Phone:</b></td>
                      <td><?php echo $primary_phone; ?></td>
                    </tr>
                    <tr>
                      <td><b>National Id:</b></td>
                      <td><?php echo $national_id; ?></td>
                    </tr>
                    <tr>
                      <td><b>Username:</b></td>
                      <td><?php echo $user_name; ?></td>
                    </tr>
                    <?php
                    if ($user_group == 1) {
                      ?>
                      <tr>
                        <td><b>Reg Number:</b></td>
                        <td><?php echo $reg_no; ?></td>
                      </tr>
                    <?php
                    }
                    if ($user_group == 2) {
                      ?>
                      <tr>
                        <td><b>Reg Number:</b></td>
                        <td><?php echo $reg_no; ?></td>
                      </tr>
                      <tr>
                        <td><b>Research Topic:</b></td>
                        <td><?php echo $topic_name; ?></td>
                      </tr>
                    <?php
                    } else {
                      ?>
                      <tr>
                        <td><b>Staff Id Number:</b></td>
                        <td><?php echo $reg_no; ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                    <tr>
                      <td><b>Created Date</b></td>
                      <td><?php echo $added_date; ?></td>
                    </tr>
                    <tr>
                      <td><b>Status</b></td>
                      <td><?php echo "$status_name"; ?></td>
                    </tr>

                  </tbody>
                </table>
                <?php
                if ($ugroup == 1) {
                  echo " <a href=\"settings.php?edit-user=$esid\" class=\"btn btn-md\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Edit User</a>";
                }

                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
  <?php include_once 'footer.php'; ?>
</body>

</html>
