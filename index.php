<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dissertation Management System || Users Dashboard</title>
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
  include_once 'includes/func.php';
  include_once 'includes/conn.inc';

  ?>
  <!--Main layout-->
  <main class="pt-5 mx-lg-3">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-header">
              <?php
              echo "<p class=\"fa fa-home text-left\"> <span class=\"dark\" style=\"font-size:16px;\"> Hello $user, Welcome to your Dashboard</span></p>";
              ?>
            </div>
            <div class="card-body">

              <?php
              if ($ugroup == 1) {
                include_once 'resources/admin-dashboard.php';
              } elseif ($ugroup == 2) {
                include_once 'resources/student_homepage.php';
              } elseif ($ugroup == 3) {
                include_once 'resources/supervisor_homepage.php';
              } elseif ($ugroup == 4) {
                include_once 'resources/uni_adminPanel.php';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->

  <?php include_once 'footer.php'; ?>
  <script src="js/main.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
</body>
<!-- Central Modal Large Info-->
<div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-notify" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
        <p class="heading lead">Dissertation Documents Upload</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <!-- form start -->
        <form method="POST" enctype="multipart/form-data" id="fupForm">
          <div class="box-body">
            <div class="form-group">
              <div class="form-group">
                <input type="hidden" value="<?php echo $sid; ?>" id="sid" name="sid" />
                <input type="hidden" value="0" id="directed_to" name="directed_to" />
              </div>
              <div class="statusMsg"></div>
              <div class="form-group">
                <label for="document upload">Document Upload</label>
                <input type="file" name="document_" class="form-control" id="document_" required>
              </div>
              <div id="prop_feedback"></div>
        </form>
      </div>

      <!--Footer-->
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-sm btn-dms submitBtn" value="Upload" />
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
