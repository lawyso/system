<?php
$sid = $myid;
$sd = fetchonerow('d_users_primary', "uid='$sid'");
$first_name = $sd['first_name'];
$last_name = $sd['last_name'];
$title = $sd['title'];
$topic = $sd['topic_id'];

if ($topic == 0) {
  $topic_name = "<i class=\"text-red\">No Research Topic Registered</i>";
} else {
  $topic_name = fetchrow('d_topics', "topic_id='$topic'", "topic_name");
}

$title_name = fetchrow('d_title', "uid='$title'", "name");
$reg_no = $sd['Reg_No'];
$user_group = $sd['user_group'];
$group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
$directed_to = 0;
?>
<div class="row">
  <div class="col-lg-5">
    <div class="card-header dark" style="font-size:16px;">
      My <?php echo $group_name; ?>'s Profile
    </div>
    <table class="table table-user-information table-bordered" style="font-weight:bold">
      <tbody>
        <tr>
          <td><b>Name:</b></td>
          <td><b><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?></b>
          </td>
        </tr>
        <tr>
          <td><b>Reg Number:</b></td>
          <td><b><?php echo $reg_no; ?></b></td>
        </tr>
        <tr>
          <td><b>Research Topic:</b></td>
          <td><b><?php echo $topic_name; ?></b></td>
        </tr>
        <tr>
          <td><b>Research Topic Status:</b></td>
          <td><b><?php echo topic_status($topic); ?></b></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-sm bg-navy" aria-hidden="true" data-toggle="modal" data-target="#commentFormModal" style="color: #ffff">Add Comment</button>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <button class="btn btn-sm bg-navy" aria-hidden="true" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="color: #ffff">Upload Document</button>
    <br /><br />
  </div>
  <div class="col-lg-7">
    <div class="card-header dark" style="font-size:16px;">
      My dissertation files
    </div>
    <table class="table table-bordered display table-responsive-sm table-hover">
      <thead>
        <tr><b>
            <th>File Name</th>
            <th>Created By</th>
            <th>Date Submitted</th>
          </b>
        </tr>
      </thead>
      <tbody>
        <?php
        $files = fetchtable('d_uploads', "created_by='$sid' || directed_to='$sid'", "upload_id", "asc", "1000");
        $count = mysqli_num_rows($files);
        while ($fd = mysqli_fetch_array($files)) {
          $filename = $fd['filename'];
          $date_submitted = $fd['created_date'];
          $path = $fd['upload_path'];
          $created_by = profileName($fd['created_by']);
          echo "<tr>
                            <td><a href='$path' target='_blank' style='color:blue;'>$filename</a></td>
                            <td>$created_by</td>
                            <td>$date_submitted</td>
                            </tr></a>";
        }
        if ($count == 0) {
          echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No files at the moment<b></em></td>
                                  </tr> ";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card-header dark" style="font-size:16px;">
      My Dissertation Comments/Remarks
    </div>
    <table class="table table-bordered display table-responsive-sm">
      <thead>
        <tr><b>
            <th>Comment Body</th>
            <th>Submitted By</th>
            <th>Submitted Date</th>
          </b>
        </tr>
      </thead>
      <tbody>
        <?php
        $remarks = fetchtable('d_comments', "created_by='$sid' || directed_to='$sid'", "comment_id", "desc", "1000");
        $total = mysqli_num_rows($remarks);
        while ($rm = mysqli_fetch_array($remarks)) {
          $comment = $rm['comment'];
          $date_submitted = $rm['created_date'];
          $created_by = profileName($rm['created_by']);
          echo "<tr style='color:navy;'>
                            <td>$comment</td>
                            <td>$created_by</td>
                            <td>$date_submitted</td>
                            </tr>";
        }
        if ($total == 0) {
          echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No pending Comments/Remarks at the moment<b></em></td>
                                  </tr> ";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Central Modal Large Info-->
<div class="modal fade" id="commentFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-notify" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
        <p class="heading lead">Dissertation Remarks/Comments Form</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <!-- form start -->
        <form method="POST" enctype="multipart/form-data" id="comForm">
          <div class="box-body">
            <div class="form-group">
              <div class="form-group">
                <input type="hidden" value="<?php echo $sid; ?>" id="sid" name="sid" />
                <input type="hidden" value="<?php echo $directed_to; ?>" id="directed_to" name="directed_to" />
              </div>
              <div class="comment-Msg"></div>
              <div class="form-group">
                <label for="Remarks">Comment/Remarks:</label>
                <textarea name="comment_" class="form-control" id="comment_" rows="5" required placeholder="Your Remarks Here..."> </textarea>
              </div>
              <div id="comment_feedback"></div>
        </form>
      </div>

      <!--Footer-->
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-sm btn-dms submit-Btn" value="Submit Comment" />
        <i class="far fa-gem ml-1"></i>

        <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
          thanks</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Large Info-->
