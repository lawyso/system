<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dissertation Management System || Topic Registration</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  ?>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="col-lg-12">

                <?php

                $topic_id = fetchrow('d_topics', "created_by='$id' AND status='0'", 'topic_id');
                $tid = encurl($topic_id);
                $topicExists = checkrowexists('d_topics', "created_by='$myid' AND status in (0,1,3)");
                if ($topicExists == 1) {
                  $topic_status = fetchrow('d_topics', "created_by='$id' AND status in (0,1,3)", "status");

                  if ($topic_status == 0) {
                    $disabled = '';
                    echo "<p class=\"text-left text-success\" style=\"font-size:16px;font-weight:bold\">
                     <i>You already have registered Research Topic pending approval.</i>
                     &emsp;<a href=\"register?edit-topic=$tid\" class=\"btn btn-sm\" style=\"background-color: rgb( 17, 122, 101);color: #ffff;display:$display; \">Edit Topic Details</a><br>";
                    echo "<p style=\"color:red;\"><blink>You will not be able to edit the topic details once it is approved.</blink></p><br>";
                  } else {
                    $disabled = "disabled";
                    $display = "none";
                    echo "<p class=\"text-left text-success\" style=\"font-size:16px;font-weight:bold\">
                     <i>You already have an active registered Research Topic.</i>
                     &emsp;<a href=\"register?edit-topic=$tid\" class=\"btn btn-sm\" style=\"background-color: rgb( 17, 122, 101);color: #ffff;display:$display; \">Edit Topic Details</a><br>";
                    echo "<p style=\"color:red;\">Details:<br>";
                  }
                } else {
                  echo "<h5 class=\"text-left text-primary\"><i>No active Topic details found, Register a topic to proceed.&emsp;<button class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#centralModalLGInfoDemo\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Register Research Topic</button></h5>";
                }

                if (isset($_GET['edit-topic'])) {
                  $esid = $_GET['edit-topic'];
                  $sid = decurl($esid);
                  $sd = fetchonerow('d_topics', "topic_id='$sid'");
                  $topic_name = $sd['topic_name'];
                  $created_by = $sd['created_by'];
                  $created_date = date('Y-m-d', strtotime($sd['created_date']));
                  $action = "Edit Research Title";
                  $edi = 1;
                } else {
                  $esid = 0;
                  $action = "Register Research Title";
                }
                ?>
              </div>

            </div>

          </div>
          <!--/.Card-->
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
    </div>
  </main>
  <script>
    $('document').ready(function() {
      var edit = '<?php echo $edi; ?>';
      if (edit == '1') {
        $('#centralModalLGInfoDemo').modal('toggle');
      }
    });
  </script>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
  <?php include_once 'footer.php'; ?>
</body>
<!-- modal-------------------------------------------start of modal window -->
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
          <div class="form-group">
            <input type="hidden" value="<?php echo $esid; ?>" id="sid" />
            <div id="register_feedback"></div>
            <div class="form-group">
              <label for="research title">Research/Topic Tittle<i style="color:red">*</i></label>
              <textarea class="form-control" name="topic_title" id="topic_title" required placeholder="Research topic here..."><?php echo  $topic_name; ?></textarea>
            </div>
          </div>
        </form>
      </div>
      <!--Footer-->
      <div class="modal-footer">
        <input type="submit" name="submit" onclick="savetopic();" class="btn btn-sm btn-dms" value="Register" />
        <i class="far fa-gem ml-1" style="display:<?php echo $display; ?>"></i>
        <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101);display:<?php echo $display; ?>">No,
          thanks</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Large Info-->

</html>
