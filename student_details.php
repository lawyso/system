<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Student || Details</title>
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

      <!-- Heading -->
      <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Student</a>
            <span>/</span>
            <span>Details</span>
          </h4>


        </div>

      </div>
      <!-- Heading -->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">
              <?php
              if (isset($_GET['student'])) {
                $esid = $_GET['student'];
                $sid = decurl($esid);
                $sd = fetchonerow('d_users_primary', "uid='$sid'");
                $first_name = $sd['first_name'];
                $last_name = $sd['last_name'];
                $primary_email = $sd['primary_email'];
                $primary_phone = $sd['primary_phone'];
                $national_id = $sd['national_id'];
                $user_name = $sd['user_name'];

                $department = $sd['department'];
                $department_name = fetchrow('d_departments', "uid='$department'", "department_name");
                $school = $sd['faculty'];
                $school_name = fetchrow('d_schools', "uid='$school'", "school_name");
                $title = $sd['title'];
                $title_name = fetchrow('d_title', "uid='$title'", "name");
                $added_date = $sd['added_date'];
                $user_group = $sd['user_group'];
                $group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
                $gender = $sd['gender'];
                $gender_name = gender($gender);

                $course = fetchrow('d_users_courses', "user='$sid' AND status=1", "course");
                $admission_date = fetchrow('d_users_courses', "user='$sid' AND status=1", "admission_date");
                $course_duration = fetchrow('d_users_courses', "user='$sid' AND status=1", "course_duration");
                $course_name = fetchrow('d_courses', "uid='$course'", "course_name");

                $proposal_upload = fetchrow('d_proposals', "user='$sid' AND status !=3", "proposal_upload");
                $proposal_status = fetchrow('d_proposals', "user='$sid' AND status !=3", "status");
                $approved_proposal = fetchrow('d_proposals', "user='$sid' AND status !=3", "title");
                $comments = fetchrow('d_proposals', "user='$sid' AND status !=3", "comments");
                $prop_id = fetchrow('d_proposals', "user='$sid' AND status !=3", "uid");

                $proposal_download = "<a target=\"_BLANK\" href=\"props/$proposal_upload\"> <button class=\"btn btn-sm btn-default\">View and Download</button></a>";

                $approved_area_study = fetchrow('d_proposals', "user='$sid' AND status !=3", "area_study");

                if ($proposal_upload == null) {
                  $status_name = "<button class=\"btn btn-sm btn-danger\">Inactive</button> No proposal submitted yet.";
                } elseif ($proposal_upload != null && $proposal_status == 1) {
                  $status_name = "<button class=\"btn btn-sm btn-warning\">Pending Approval</button> Proposal Pending Approval";
                } elseif ($proposal_upload != null && $proposal_status == 2) {
                  $status_name = "<button class=\"btn btn-sm btn-success\">Approved</button> Proposal Approved";
                } elseif ($proposal_upload != null && $proposal_status == 3) {
                  $status_name = "<button class=\"btn btn-sm btn-danger\">Rejected</button>Proposal Rejected";
                } elseif ($proposal_upload != null && $proposal_status == 4) {
                  $status_name = "<button class=\"btn btn-sm btn-info\">Closed</button> Proposal Closed for defense";
                }
              }
              ?>
              <table class="table table-user-information table-responsive">
                <tbody>
                  <tr>
                    <td><b>Full Name:</b></td>
                    <td><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Gender:</b></td>
                    <td><?php echo $gender_name; ?></td>
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
                    <td><b>Department:</b></td>
                    <td><?php echo $department_name; ?></td>
                  </tr>
                  <tr>
                    <td><b>School/Faculty:</b></td>
                    <td><?php echo $school_name; ?></td>
                  </tr>
                  <tr>
                    <td><b>Admission Date:</b></td>
                    <td><?php echo $admission_date; ?></td>
                  </tr>
                  <tr>
                    <td><b>Course:</b></td>
                    <td><?php echo $course_name; ?>
                    </td>

                  </tr>
                  <tr>
                    <td><b>Course Duration:</b></td>
                    <td><?php echo $course_duration; ?> year<small>(s)</small>
                    </td>

                  </tr>
                  <tr>
                    <td><b>Proposal Title:</b></td>
                    <td><?php echo $approved_proposal; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Area of Study:</b></td>
                    <td><?php echo $approved_area_study; ?>
                    </td>

                  </tr>
                  <tr>
                    <td><b>Proposal Document:</b></td>
                    <td><?php echo $proposal_download; ?>
                    </td>

                  </tr>
                  <tr>
                    <td><b>Status:</b></td>
                    <td><?php echo "$status_name"; ?></td>
                  </tr>
                  <tr>
                    <td><b>Comments:</b></td>
                    <td><?php echo "$comments"; ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td id="prop_feedback"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><?php

                        if ($proposal_status == 1) {
                          ?>
                        <button onclick="approve_proposal('<?php echo $prop_id;  ?>');" class="btn btn-info">APPROVE PROPOSAL</button>
                        &nbsp;<button disabled onclick="('<?php echo $prop_id;  ?>');" class="btn btn-success">UPLOAD NEW DOCUMENT</button>
                        </a>&nbsp;<button onclick="reject_proposal('<?php echo $prop_id;  ?>');" class="btn btn-warning">REJECT PROPOSAL</button>
                        </a>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->



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
