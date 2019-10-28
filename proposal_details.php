<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dms || proposal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    $(document).ready(function(e) {
      // Submit form data via Ajax
      $("#fupForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'actions/prop_upload.php',
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
              }, 3000);

            } else {
              $('.statusMsg').html('<p class="alert alert-danger">' + response.message + '</p>');
            }
            $('#fupForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
          }
        });
      });
      // File type validation
      $("#proposal_").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))) {
          alert('Sorry, only PDF and DOC files are allowed to upload.');
          $("#proposal_").val('');
          return false;
        }
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
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">
              <?php
              if (isset($_GET['proposal'])) {
                $esid = $_GET['proposal'];
                $sid = decurl($esid);
                $p = fetchonerow('d_proposals', "uid='$sid'");
                $title = $p['title'];
                $area_study = $p['area_study'];
                $sup_1 = $p['supervisor_1'];
                $sup_2 = $p['supervisor_2'];
                $sup_3 = $p['supervisor_3'];
                $proposal_upload = $p['proposal_upload'];
                $proposal_doc = "<a target=\"_BLANK\" href='props/$proposal_upload' class=\"btn btn-md bg-info\">View Proposal Document</a>";
                $date_modified = $p['date_modified'];
                $added_date = $p['added_date'];
                $sup1_details = fetchonerow('d_users_primary', "uid='$sup_1'", "title,first_name,last_name");
                $s1_title = $sup1_details['title'];
                $title_name1 = fetchrow('d_title', "uid='$s1_title'", "name");
                $s1_fname = $sup1_details['first_name'];
                $s1_lname = $sup1_details['last_name'];

                $sup2_details = fetchonerow('d_users_primary', "uid='$sup_2'", "title,first_name,last_name");
                $s2_title = $sup2_details['title'];
                $title_name2 = fetchrow('d_title', "uid='$s2_title'", "name");
                $s2_fname = $sup2_details['first_name'];
                $s2_lname = $sup2_details['last_name'];

                $sup3_details = fetchonerow('d_users_primary', "uid='$sup_3'", "title,first_name,last_name");
                $s3_title = $sup3_details['title'];
                $title_name3 = fetchrow('d_title', "uid='$s3_title'", "name");
                $s3_fname = $sup3_details['first_name'];
                $s3_lname = $sup3_details['last_name'];

                $status = $p['status'];
                $status_name = fetchrow('d_proposal_statuses', "uid='$status'", "name");
                $comments = fetchrow('d_proposals', "uid='$sid'", "comments");
                if ($proposal_upload == null) {
                  $action = "No Proposal Document Uploaded yet<button class=\"btn btn-sm btn-success\" aria-hidden=\"true\" data-toggle=\"modal\" data-target=\"#centralModalLGInfoDemo\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Upload Proposal Document</button>";
                } else {
                  $hourdiff = round((strtotime($fulldate) - strtotime($date_modified)) / 3600, 1);
                  if ($hourdiff > 2) {
                    $disabled = "disabled";
                    $display = "none";
                  } else {
                    $disabled = '';
                  }
                  $action = "$proposal_doc<button $disabled onclick=\"del_proposal('$sid')\" class=\"btn btn-md btn-danger\" aria-hidden=\"true\" style=\"display:$display\">Delete</button>";
                }
              }
              ?>
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td><b>Proposal Title:</b></td>
                    <td><?php echo $title;  ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Areas of Study/Research</b></td>
                    <td><?php echo $area_study; ?></td>
                  </tr>
                  <tr>
                    <td><b>Supervisors:</b></td>
                    <td>
                      <ol>
                        <li><?php echo $title_name1 . ' ' . $s1_fname . ' ' . $s1_lname; ?></li>
                        <li><?php echo $title_name2 . ' ' . $s2_fname . ' ' . $s2_lname; ?></li>
                        <li><?php echo $title_name3 . ' ' . $s3_fname . ' ' . $s3_lname; ?></li>
                      </ol>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Date Created:</b></td>
                    <td><?php echo $added_date; ?></td>
                  </tr>
                  <tr>
                    <td><b>Date Last Modified:</b></td>
                    <td><?php echo $date_modified; ?></td>
                  </tr>
                  <tr>
                    <td><b>Comments:</b></td>
                    <td><?php echo "$comments"; ?></td>
                  </tr>
                  <tr>
                    <td><b>Status</b></td>
                    <td><?php echo $status_name; ?></td>
                  </tr>
                  <tr>
                    <td><b>Proposal Document</b></td>
                    <td><?php echo $action; ?></td>
                  </tr>


                </tbody>
              </table>
              <div id="pro_feedback"></div>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->
        <!-- Central Modal Large Info-->
        <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-notify" role="document">
            <!--Content-->
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
                <p class="heading lead">Concept Paper/Proposal Upload</p>

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
                      </div>
                      <div class="statusMsg"></div>
                      <div class="form-group">
                        <label for="proposal upload">Proposal Upload</label>
                        <input type="file" name="proposal_" class="form-control" id="proposal_" required>
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
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js"></script>
  <?php include_once 'footer.php'; ?>
</body>

</html>
