<div id="topic_feedback"></div>
<div class="card">
  <?php
  if (!isset($_GET['user'])) {
    ?>
    <div class="card-header">
      <p>Research Topics Awaiting Approval</p>
    </div>
    <div class="card-body box-body">
      <div class="col-lg-12">
        <table id="approval_table" class="table table-bordered table-striped display table-responsive-lg">
          <thead>
            <tr>
              <th>Student Name </th>
              <th>Research Topic</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $topics = fetchtable('d_topics', "status='0'", "topic_id", "desc", "1000");
              $total = mysqli_num_rows($topics);
              while ($rt = mysqli_fetch_array($topics)) {
                $etopic_id = encurl($rt['topic_id']);
                $created_byId = $rt['created_by'];
                $created_by = profileName($rt['created_by']);
                $topic_name = $rt['topic_name'];
                $action = "<button onclick=\"approve_topic($etopic_id);\" class=\"btn btn-sm btn-primary\" title=\"Approve Research Topic\"><i class=\"fa fa-check\"></i>&nbsp;Approve</button>
                <button onclick=\"reject_topic($etopic_id)\" class=\"btn btn-sm btn-danger\" title=\"Reject Research Topic\"><i class=\"fa fa-ban\"></i>&nbsp;Reject</button>";
                echo "<tr>
                            <td>$created_by</td>
                            <td>$topic_name</td>
                            <td>$action</td>
                            </tr>";
              }
              if ($total == 0) {
                echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No pending Research Topic Approval at the moment<b></em></td>
                                  </tr> ";
              }
              ?>
          </tbody>
          <tfoot style="background-color: #F0F0F0">
          </tfoot>
        </table>
      </div>

    </div>
  <?php
  }
  ?>
  <!-----------------------------------------------------Modal window ----------------!>

   <!-- Modal -->
  <?php
  $nogender = 'SELECTED';
  $male = '';
  $female = '';
  if (isset($_GET['edit-user'])) {
    $esid = $_GET['edit-user'];
    $sid = decurl($esid);
    $sd = fetchonerow('d_users_primary', "uid='$sid'");
    $first_name = $sd['first_name'];
    $last_name = $sd['last_name'];
    $national_id = $sd['national_id'];
    $primary_email = $sd['primary_email'];
    $primary_phone = $sd['primary_phone'];
    $user_name = $sd['user_name'];
    $reg_no = $sd['Reg_No'];
    $user_group = $sd['user_group'];
    $title = $sd['title'];
    $group_name = fetchrow('s_user_groups', "uid='$user_group'", "group_name");
    $status = $sd['status'];
    $status_name = fetchrow('s_user_status', "uid='$status'", "status_name");
    $gender = $sd['gender'];
    if ($gender == 1) {
      $male = 'SELECTED';
    } elseif ($gender == 2) {
      $female = 'SELECTED';
    } else {
      $nogender = 'SELECTED';
    }
    $action = "Edit User";
    $edi = 1;
  } else {
    $sid = 0;
    $action = "Add User";
  }
  if ($sid == 0) {
    $disabled = "disabled";
  } else {
    $disabled = '';
  }

  ?>
  <!-- Central Modal Large Info-->
  <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-notify" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
          <p class="heading lead"><?php echo $action; ?></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <!-- form start -->
          <form role="form" method="POST" onsubmit="return false;">
            <div class="box-body">
              <div class="form-group">
                <div class="form-group">
                  <label for="regNo/staffNo">Reg Number/Staff Number</label>
                  <input type="text" class="form-control" value="<?php echo $reg_no; ?>" id="reg_no" auto-complete="off" />
                </div>
                <div class="form-group">
                  <label for="first_name">First Name</label><input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                  <input type="text" class="form-control" value="<?php echo $first_name; ?>" id="first_name" />
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" value="<?php echo $last_name; ?>" id="last_name" />
                </div>
                <div class="form-group">
                  <label>National Id</label>
                  <input type="text" class="form-control" value="<?php echo $national_id; ?>" id="national_id" />
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select id="gender" class="form-control">
                    <option <?php echo $nogender; ?> value="0">~Select~</option>
                    <option <?php echo $male; ?> value="1">Male</option>
                    <option <?php echo $female; ?> value="2">Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="primary_email">Primary_email</label>
                  <input type="text" value="<?php echo $primary_email; ?>" class="form-control" id="primary_email" />
                </div>
                <div class="form-group">
                  <label for="primary_phone">Primary Phone</label>
                  <input type="text" class="form-control" value="<?php echo $primary_phone; ?>" id="primary_phone" />
                </div>
                <div class="form-group">
                  <label for="user_name">User Name</label>
                  <input type="text" class="form-control" value="<?php echo $user_name; ?>" id="user_name" />
                </div>
                <div class="form-group">
                  <label for="user_group">User Group</label>
                  <select class="form-control" id="user_group">
                    <option value="0">~Select~</option>
                    <?php
                    $groups = fetchtable('d_user_groups', "group_status=1", "group_name", "asc", "100");
                    while ($g = mysqli_fetch_array($groups)) {
                      $uid = $g['uid'];
                      $group_name = $g['group_name'];
                      if ($uid == $user_group) {
                        $gselected = 'SELECTED';
                      } else {
                        $gselected = '';
                      }
                      echo "<option $gselected value=\"$uid\">$group_name</option>";
                    }
                    ?>
                  </select>
                </div>

                <?php
                if ($sid > 0) {

                  ?>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status">
                      <option value="0">~Select~</option>
                      <?php
                        $state = fetchtable('d_user_status', "status=1", "status_name", "asc", "100");
                        while ($t = mysqli_fetch_array($state)) {
                          $uid = $t['uid'];

                          if ($status == $uid) {
                            $tselected = 'SELECTED';
                          } else {
                            $tselected = '';
                          }
                          $status_name = $t['status_name'];
                          echo "<option $tselected value=\"$uid\">$status_name</option>";
                        }
                        ?>
                    </select>
                  </div>
                <?php
                }
                ?>
                <div id="user_feedback"></div>

          </form>
        </div>

        <!--Footer-->
        <div class="modal-footer">

          <button type="submit" onclick="saveuser();" class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff">Save</button>
          <i class="far fa-gem ml-1"></i>

          <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
            thanks</a>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <!-- Central Modal Large Info-->
  <script>
    $('document').ready(function() {
      var edit = '<?php echo $edi; ?>';
      if (edit == '1') {
        $('#centralModalLGInfoDemo').modal('toggle');
      }
    });
  </script>
</div>
