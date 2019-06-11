<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>DMS Home || Dashboard</title>
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

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Profile</a>
            <span>/</span>
            <span>Details</span>
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
        <?php
                      if(isset($_GET['user']))
     {
      $esid = $_GET['user'];     $sid = decurl($esid);
      $sd = fetchonerow('d_users_primary',"uid='$sid'");
      $first_name = $sd['first_name'];
      $last_name = $sd['last_name'];
      $primary_email = $sd['primary_email'];
      $primary_phone = $sd['primary_phone'];
      $national_id = $sd['national_id'];
      $user_name = $sd['user_name'];
      $department = $sd['department'];  $department_name = fetchrow('d_departments',"uid='$department'","department_name");
      $school = $sd['faculty'];  $school_name = fetchrow('d_schools',"uid='$school'","school_name");
      $title = $sd['title'];  $title_name = fetchrow('d_title',"uid='$title'","name");
      $added_date = $sd['added_date'];
      $user_group = $sd['user_group'];   $group_name = fetchrow('d_user_groups',"uid='$user_group'","group_name");
      $gender = $sd['gender']; $gender_name = gender($gender);
      
      $status = $sd['status']; $status_name = admin_status($status);           
     
     }
      ?>       
         <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Name:</b></td>
                        <td><?php echo $title_name.' '.$first_name.' '.$last_name;  ?>
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
                       <tr>
                        <td><b>Department:</b></td>
                        <td><?php echo $department_name; ?></td>
                      </tr>
                       <tr>
                        <td><b>School/Faculty</b></td>
                        <td><?php echo $school_name; ?></td>
                      </tr>
                      <tr>
                        <td><b>Join Date</b></td>
                        <td><?php echo $added_date; ?></td>
                      </tr>
                      <tr>
                        <td><b>User Group</b></td>
                        <td><?php echo $group_name; ?>
                        </td>
                           
                      </tr>
                      
                      <tr>
                        <td><b>Status</b></td>
                        <td><?php echo "$status_name"; ?></td>                           
                      </tr>
                    
                    </tbody>
                  </table>
                  <?php
                 
                  if($ugroup == 1)
                     {
                    echo " <a href=\"settings.php?edit-user=$esid\" class=\"btn\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Edit User</a>";    
                     }
                  
                  ?>
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
