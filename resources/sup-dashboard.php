<?php
$total_students = countotal('d_users_primary', "uid>0 AND FIND_IN_SET('$myid',supervisor) > 0");
$total_pending_approval = countotal('d_users_primary', "uid>0 AND FIND_IN_SET('$myid',supervisor) > 0 AND proposal_status='1'");
$total_approved = countotal('d_users_primary', "uid>0 AND FIND_IN_SET('$myid',supervisor) > 0 AND proposal_status='2'");
$total_rejected = countotal('d_users_primary', "uid>0 AND FIND_IN_SET('$myid',supervisor) > 0 AND proposal_status='3'");

?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h4> <?php echo $total_students; ?></h4>

        <p style="font-size: 18px">ASSIGNED STUDENTS</p>

      </div>
      <div class="icon">
        <i class="fa fa-tasks"></i>
      </div>
      <a href="assigned_students" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <h4> <?php echo $total_pending_approval; ?></h4>

        <p style="font-size: 18px">PENDING APPROVALS</p>

      </div>
      <div class="icon">
        <i class="fas fa-hourglass-start"></i>
      </div>
      <a href="assigned_students" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-olive">
      <div class="inner">
        <h4> <?php echo $total_approved; ?></h4>

        <p style="font-size: 18px">APPROVALS</p>

      </div>
      <div class="icon">
        <i class="fas fa-check"></i>
      </div>
      <a href="assigned_students" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h4> <?php echo $total_rejected; ?></h4>

        <p style="font-size: 18px">REJECTIONS</p>

      </div>
      <div class="icon">
        <i class="fas fa-ban"></i>
      </div>
      <a href="dormant_students" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<br />
