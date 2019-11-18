<?php
$sid = $myid;
$sd = fetchonerow('d_users_primary', "uid='$sid'");
$first_name = $sd['first_name'];
$last_name = $sd['last_name'];
$title = $sd['title'];
$topic = $sd['topic_id'];
$topic_name = fetchrow('d_topics', "topic_id='$title'", "topic_name");
$title_name = fetchrow('d_title', "uid='$title'", "name");
$reg_no = $sd['Reg_No'];
$user_group = $sd['user_group'];
$group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
$totalStudents = countotal('d_users_primary', "topic_id='1' AND status='1'");
$pendingApprovals = countotal('d_topics', "status='0'");
$missingSups = countotal('d_users_primary', "supervisor_id='0' AND user_group='2' AND topic_id='1' AND status='1'");
?>
<div class="row">
  <div class="col-lg-12">
    <div class="card-header bg-orange">
      <?php echo $group_name; ?>'s Profile
    </div>
    <table class="table table-user-information table-striped table-bordered" style="font-weight:bold">
      <tbody>
        <tr>
          <td><b>Name:</b></td>
          <td><b><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?></b>
          </td>
        </tr>
        <tr>
          <td><b>Staff Id Number:</b></td>
          <td><b><?php echo $reg_no; ?></b></td>
        </tr>
        <tr>
          <td><b>Students Registered:</b></td>
          <td><b><?php echo $totalStudents; ?></b></td>
        </tr>
        <tr>
          <td><b>Pending Approvals:</b></td>
          <td><b><?php echo $pendingApprovals; ?></b></td>
        </tr>
        <tr>
          <td><b>Missing Supervisor:</b></td>
          <td><b><?php echo $missingSups; ?></b></td>
        </tr>
      </tbody>
    </table>
    <br />
  </div>

</div>
</div>
