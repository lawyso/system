<?php
$total_approved_proposal = countotal('d_proposals', "user='$myid' AND status='2'");
$total_proposal_pending_approval = countotal('d_proposals', "user='$myid' AND status='1'");
$total_rejected_proposal = countotal('d_proposals', "user='$myid' AND status='3'");
$total_closed_proposal = countotal('d_proposals', "user='$myid' AND status='4'");
$total_deleted_proposal = countotal('d_proposals', "user='$myid' AND status='5'");
$total_approved_defense = countotal('d_defense', "user='$myid' AND status='1'");
$total_approved_defense = countotal('d_defense', "user='$myid' AND status='3'");
?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h4> <?php echo $total_approved_proposal; ?></h4>

        <p style="font-size: 18px">Approved Proposal</p>

      </div>
      <div class="icon">
        <i class="fa fa-check"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <h4> <?php echo $total_rejected_proposal; ?></h4>

        <p style="font-size: 18px">Rejected Proposal</p>

      </div>
      <div class="icon">
        <i class="fa fa-ban"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-olive">
      <div class="inner">
        <h4> <?php echo 0; ?></h4>

        <p style="font-size: 18px">Approved Defense</p>

      </div>
      <div class="icon">
        <i class="fa fa-check"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h4> <?php echo 0; ?></h4>

        <p style="font-size: 18px">Rejected Defense</p>

      </div>
      <div class="icon">
        <i class="fa fa-ban"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h4> <?php echo $total_proposal_pending_approval; ?></h4>

        <p style="font-size: 18px">Pending Approval </p>

      </div>
      <div class="icon">
        <i class="fa fa-hourglass-start"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-teal">
      <div class="inner">
        <h4> <?php echo $total_closed_proposal; ?></h4>

        <p style="font-size: 18px">Closed Proposals</p>

      </div>
      <div class="icon">
        <i class="fas fa-window-close"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-fuchsia">
      <div class="inner">
        <h4> <?php echo $total_deleted_proposal; ?></h4>

        <p style="font-size: 18px">Deleted Proposals</p>

      </div>
      <div class="icon">
        <i class="fas fa-trash"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-gray-active">
      <div class="inner">
        <h4> <?php echo 0; ?></h4>

        <p style="font-size: 18px">New Messages</p>

      </div>
      <div class="icon">
        <i class="fa fa-envelope"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
