<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dissertation Management System || Student Details</title>
  <link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
    $(document).ready(function(e) {
      // Submit form data via Ajax
      $("#fupForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'actions/document_upload.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#fupForm').css("opacity", ".5");
          },
          success: function(response) { //console.log(response);
            $('.statusMsg').html('');
            if (response.status == 1) {
              $('#fupForm')[0].reset();
              $('.statusMsg').html('<p class="alert alert-success">' + response.message + '</p>');
              setTimeout(function() {
                reload();
              }, 2000);

            } else {
              $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
            }
            $('#fupForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
          }
        });
      });
      // File type validation
      $("#document_").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
          bootbox.alert({
            size: "medium",
            title: "<i style='color:red'>Upload Error</i>",
            message: "Sorry, only PDF and DOC files are allowed to be uploaded.",
            callback: function() {
              /* your callback code */
            }
          });
          $("#document_").val('');
          return false;

        }
      });
    });
  </script>
  <script>
    $(document).ready(function(e) {
      // Submit form data via Ajax
      $("#comForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'actions/comments.php',
          data: new FormData(this),
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $('.submit-Btn').attr("disabled", "disabled");
            $('#comForm').css("opacity", ".5");
          },
          success: function(response) { //console.log(response);
            $('.comment-Msg').html('');
            if (response.status == 1) {
              $('#comForm')[0].reset();
              $('.comment-Msg').html('<p class="alert alert-success">' + response.message + '</p>');
              setTimeout(function() {
                reload();
              }, 2000);

            } else {
              $('.comment-Msg').html('<p class="alert alert-danger">' + response.message + '</p>');
            }
            $('#comForm').css("opacity", "");
            $(".submit-Btn").removeAttr("disabled");
          }
        });
      });

    });
  </script>
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  include_once 'includes/conn.inc';
  include_once 'includes/func.php';

  ?>
  <!--Main layout-->
  <main class="pt-5 mx-lg-2">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">

            <?php
            if (isset($_GET['student'])) {
              $esid = $_GET['student'];
              $sid = decurl($esid);
              $sd = fetchonerow('d_users_primary', "uid='$sid'");
              $first_name = $sd['first_name'];
              $last_name = $sd['last_name'];
              $primary_email = $sd['primary_email'];
              $primary_phone = $sd['primary_phone'];
              $topic_id = $sd['topic_id'];
              $topic_name = fetchrow('d_topics', "topic_id='$topic_id'", "topic_name");
              $title = $sd['title'];
              $title_name = fetchrow('d_title', "uid='$title'", "name");
              $user_group = $sd['user_group'];
              $group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
            }
            ?>
            <div class="card-header">
              <a href="#" target="_blank"><?php echo $first_name . ' ' . $last_name; ?>'s Profile </a>(<i><?php echo $group_name; ?></i>)
            </div>
            <div class="card-body box-body">
              <div class="row">
                <div class="col-lg-5">
                  <table class="table table-user-information table-responsive table-striped">
                    <tbody>
                      <tr>
                        <td><b>Full Name:</b></td>
                        <td><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?>
                        </td>
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
                        <td><b>Research Title:</b></td>
                        <td><?php echo $topic_name; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-sm bg-navy" aria-hidden="true" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="color: #ffff">Upload Document</button>
                  <button class="btn btn-sm bg-navy" aria-hidden="true" data-toggle="modal" data-target="#commentFormModal" style="color: #ffff">Add Comment</button>

                </div>
                <div class="col-lg-7">
                  <div class="card-header bg-teal">
                    My Dissertation (<i>Student/Supervisor</i>) Files
                  </div>
                  <table class="table table-bordered table-striped display table-responsive-sm">
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
                      $files = fetchtable('d_uploads', "created_by='$myid' AND directed_to='$sid' || created_by='$sid'", "upload_id", "asc", "1000");
                      $total = mysqli_num_rows($files);
                      while ($fd = mysqli_fetch_array($files)) {
                        $filename = $fd['filename'];
                        $date_submitted = $fd['created_date'];
                        $created_by = profileName($fd['created_by']);
                        $path = $fd['upload_path'];
                        echo "<tr style='color:blue;'>
                            <td><a href='$path' target='_blank' style='color:blue;'>$filename</a></td>
                            <td>$created_by</td>
                            <td>$date_submitted</td>
                            </tr>";
                      }
                      if ($total == 0) {
                        echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No file found at the moment<b></em></td>
                                  </tr> ";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card-header bg-orange">
                    My Dissertation Comments/Remarks
                  </div>
                  <table class="table table-bordered table-striped display table-responsive-sm">
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
                      $remarks = fetchtable('d_comments', "created_by='$myid' AND directed_to='$sid' || created_by='$sid'", "comment_id", "desc", "1000");
                      $count = mysqli_num_rows($remarks);
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
                      if ($count == 0) {
                        echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No pending Comments/Remarks at the moment<b></em></td>
                                  </tr> ";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include_once 'resources/upload_modal.php';
    ?>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
  <?php include_once 'footer.php'; ?>
</body>
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
                <input type="hidden" value="<?php echo $myid; ?>" id="sid" name="sid" />
                <input type="hidden" value="<?php echo  $sid; ?>" id="directed_to" name="directed_to" />
              </div>
              <div class="comment-Msg"></div>
              <div class="form-group">
                <label for="Remarks">Comment/Remarks:</label>
                <textarea name="comment_" class="form-control" id="comment_" rows="4" required placeholder="Your Remarks Here..."> </textarea>
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


</html>
