<?php

$my_dept = fetchrow('d_users_primary', "uid='$myid'", "department");

$total_students = countotal('d_users_primary', "department='$my_dept' AND user_group='2'");

$total_supervisors = countotal('d_users_primary', "department='$my_dept' AND user_group='3'");

$total_courses = countotal('d_courses', "department_tag='$my_dept'");

$pending_defense_apps = countotal('d_defense', "uid>0 AND defense_status='1'");

$approved_defense_apps = countotal('d_defense', "uid>0 AND defense_status='2'");

$closed_defense_apps = countotal('d_defense', "uid>0 AND defense_status='4'");
// "<script>alert($my_dept)</script>";
?>
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h4> <?php echo $total_students; ?></h4>

        <p style="font-size: 18px">STUDENTS</p>

      </div>
      <div class="icon">
        <i class="fas fa-user-graduate"></i>
      </div>
      <a href="details?department_students" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <h4> <?php echo $total_supervisors; ?></h4>

        <p style="font-size: 18px">SUPERVISORS</p>

      </div>
      <div class="icon">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <a href="details?department_supervisors" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-blue">
      <div class="inner">
        <h4> <?php echo $total_courses; ?></h4>

        <p style="font-size: 18px">COURSES</p>

      </div>
      <div class="icon">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <a href="details?department_courses" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h4> <?php echo $pending_defense_apps; ?></h4>

        <p style="font-size: 15px;">Pending Defense Applications</p>

      </div>
      <div class=" icon">
        <i class="fas fa-blog"></i>
      </div>
      <a href="details?department_pendingDefenses" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-purple">
      <div class="inner">
        <h4> <?php echo $approved_defense_apps; ?></h4>

        <p style="font-size: 15px">Approved Defense Applications</p>

      </div>
      <div class="icon">
        <i class="fas fa-check"></i>
      </div>
      <a href="department_supervisors" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-navy">
      <div class="inner">
        <h4> <?php echo 0; ?></h4>

        <p style=" font-size: 15px;">ACTIVITIES</p>

      </div>
      <div class="icon">
        <i class="fas fa-history"></i>
      </div>
      <a href="details?courses" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<br />
