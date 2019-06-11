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
            <a href="#" target="_blank">Bio-data</a>
            <span>/</span>
            <span>Update</span>
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
      
       
       
       
           $sid = $myid;
      $sd = fetchonerow('d_users_primary',"uid='$sid'");
      $first_name = $sd['first_name'];
      $last_name = $sd['last_name'];
      $primary_email = $sd['primary_email'];
      $primary_phone = $sd['primary_phone'];
      $national_id = $sd['national_id'];
      $user_name = $sd['user_name'];
      $user_group = $sd['user_group'];   
      $group_name = fetchrow('d_user_groups',"uid='$user_group'","group_name");
      $department = $sd['department'];  $department_name = fetchrow('d_departments',"uid='$department'","department_name");
      $school = $sd['faculty'];  $school_name = fetchrow('d_schools',"uid='$school'","school_name");
      $title = $sd['title'];  $title_name = fetchrow('d_title',"uid='$title'","name");
      
                 
      ?>
             
        <form role="form" method="POST" onsubmit="return false;">
           <table class="table table-bordered table-striped table-responsive">
           <tr><td>Title</td>
           <td>
           <select class="form-control" id="title" <?php echo $disabled; ?>>
                         <option value="0">~Select~</option>
                         <?php
                         $tl = fetchtable('d_title',"status=1","name","asc","100");
                         while($t = mysqli_fetch_array($tl))
                             {
                                $uid = $t['uid'];
                                $name = $t['name'];
                                if($uid == $title)
                                   {
                                    $tselected = 'SELECTED';
                                   }
                                else
                                   {
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
           <input type="text" class="form-control" value="<?php echo $first_name; ?>" id="first_name"/>
           </td
           ></tr>
           <tr>
           <td>Last Name</td><td>
           <input type="text" class="form-control" value="<?php echo $last_name; ?>" id="last_name"/>
           </td>
           </tr>
           <tr>
           <td>Primary Email</td><td>
           <input type="hidden" value="<?php echo $sid; ?>" id="sid" />
           <input type="text" disabled class="form-control" value="<?php echo $primary_email; ?>" />
           </td>
           </tr>
           <tr>
           <td>Primary Phone</td>
           <td>
           <input type="text" disabled class="form-control" value="<?php echo $primary_phone; ?>" />
           </td>
           </tr>
           <tr>
           <td>National Id</td>
           <td>
           <input type="text" disabled class="form-control" value="<?php echo $national_id; ?>" />
           </td>
           </tr>
           <tr>
           <td>Username</td><td>
           <input type="text" disabled class="form-control" value="<?php echo $user_name; ?>" />
           </td>
           </tr>           
           <tr>
           <td>Group</td><td>
           <input type="text" disabled class="form-control" value="<?php echo $group_name; ?>" />
           </td>
           </tr>
           <tr>
           <td>Department</td>
           <td>
           <select class="form-control" id="department" <?php echo $disabled; ?>>
                         <option value="0">~Select~</option>
                         <?php
                         $deps = fetchtable('d_departments',"department_status=1","department_name","asc","10000");
                         while($d = mysqli_fetch_array($deps))
                             {
                                $uid = $d['uid'];
                                $department_name = $d['department_name'];
                                if($uid == $department)
                                   {
                                    $dselected = 'SELECTED';
                                   }
                                else
                                   {
                                   $dselected = '';
                                   }
                                echo "<option $dselected value=\"$uid\">$department_name</option>";
                             }
                         ?>
                      </select>
           </td>
           </tr>
           <tr>
           <td>School/Faculty</td>
           <td>
           <select class="form-control" id="school" <?php echo $disabled; ?>>
                         <option value="0">~Select~</option>
                         <?php
                         $sch = fetchtable('d_schools',"school_status=1","school_name","asc","10000");
                         while($sc = mysqli_fetch_array($sch))
                             {
                                $uid = $sc['uid'];
                                $school_name = $sc['school_name'];
                                if($uid == $school)
                                   {
                                    $scselected = 'SELECTED';
                                   }
                                else
                                   {
                                   $scselected = '';
                                   }
                                echo "<option $scselected value=\"$uid\">$school_name</option>";
                             }
                         ?>
                      </select>
           </td>
           </tr>
           <tr>
           <td colspan="2" id="bio_feedback">
           
           </td>
           </tr>
           <tr>
           <td colspan="2">
           <button type="submit" class="btn" onclick="update_bio()" style="background-color: rgb( 17, 122, 101);color: #ffff">Update Profile</button>
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
