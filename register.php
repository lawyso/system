<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Course Registration</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  ?>
  <!--Main layout-->
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">


      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12">

          <!--Card content-->
          <div class="card-body">
            <div class="card-header">
              <?php

              $course_id = fetchrow('d_users_courses', "user='$id' AND status='1'", 'uid');
              $cid = encurl($course_id);

              $adm_date = fetchrow('d_users_courses', "user='$id' AND status='1'", 'admission_date');
              $newAdmDate = date('Y-M-d', strtotime($adm_date));
              $duration = fetchrow('d_users_courses', "user='$id' AND status='1'", 'course_duration');
              $completion_date = dateadd($adm_date, $duration, 0, 0);
              $newCompletionDate = date('Y-M-d', strtotime($completion_date));
              $days_to_go = timeago($date, $completion_date);

              $edit_timer = dateadd($adm_date, 0, 0, 30);
              $edit_end_time = date('M d,  Y  H:i:s', strtotime($edit_timer));

              if ($edit_timer >= $date) {
                $disabled = '';
              } else {
                $disabled = "disabled";
                $display = "none";
              }

              $courseExists = checkrowexists('d_users_courses', "user='$id' AND status='1'");
              if ($courseExists == 1) {
                echo "<p class=\"text-left text-success\" style=\"font-size:16px;font-weight:bold\">
                     <i>You already have an active registered course.</i>
                     &emsp;<a href=\"register?edit-course=$cid\" class=\"btn btn-sm\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">View/Edit Course Details</a><br>";
                echo "<p>The course runs from <span class=\"text-left text-danger\" style=\"font-size:16px;font-weight:bold\">$newAdmDate</span> to <span class=\"text-left text-danger\" style=\"font-size:16px;font-weight:bold\">$newCompletionDate</span>.</The></p><br>";
                echo "<p>During this period you can only edit the course details within the first 30 days after admission.</p><br>";
                echo "<p>Thereafter consult your administrator to do so.</p><br>";
                echo "<p>Course Review Time Remaining::</p>";
                echo "<p id=\"edit-end\" style=\"font-size: 30px\"></p>";
                ?>
                <script>
                  var end_date = '<?php echo $edit_end_time; ?>';
                  // Set the date we're counting down to
                  var countDownDate = new Date(end_date).getTime();

                  // Update the count down every 1 second
                  var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("edit-end").innerHTML = days + "d " + hours + "h " +
                      minutes + "m " + seconds + "s ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                      clearInterval(x);
                      document.getElementById("edit-end").innerHTML = "<span class='text-danger' style='font-size:14px;font-weight:bold'>COURSE REVIEW PERIOD EXPIRED !!!</span>";
                    }
                  }, 1000);
                </script>

              <?php
              } else {
                echo "<h5 class=\"text-left text-primary\"><i>No active course details found, Register to proceed.&emsp;<button class=\"btn btn-sm\" data-toggle=\"modal\" data-target=\"#centralModalLGInfoDemo\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Register Course</button></h5>";
              }


              if (isset($_GET['edit-course'])) {
                $esid = $_GET['edit-course'];
                $sid = decurl($esid);
                $sd = fetchonerow('d_users_courses', "uid='$sid'");
                $course = $sd['course'];
                $department = $sd['department'];
                $school = $sd['school'];
                $admission_date = date('Y-m-d',strtotime($sd['admission_date']));
                $course_duration = $sd['course_duration'];
                $action = "Edit Course";
                $edi = 1;
              } else {
                $sid = 0;
                $action = "Register Course";
              }


              ?>
            </div>
            <!-- modal-------------------------------------------start of modal window -->
            <!-- Central Modal Large Info-->
            <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-notify" role="document">
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
                          <input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                          <div class="form-group">
                            <label>Course</label>
                            <select class="form-control" id="course" <?php echo $disabled; ?>>
                              <option value="0">~Select~</option>
                              <?php
                              $cs = fetchtable('d_courses', "course_status=1", "course_name", "asc", "10000");
                              while ($c = mysqli_fetch_array($cs)) {
                                $uid = $c['uid'];
                                $course_name = $c['course_name'];
                                if ($uid == $course) {
                                  $cselected = 'SELECTED';
                                } else {
                                  $cselected = '';
                                }
                                echo "<option $cselected value=\"$uid\">$course_name</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="user_group">Department</label>
                            <select class="form-control" id="department" <?php echo $disabled; ?>>
                              <option value="0">~Select~</option>
                              <?php
                              $deps = fetchtable('d_departments', "department_status=1", "department_name", "asc", "10000");
                              while ($d = mysqli_fetch_array($deps)) {
                                $uid = $d['uid'];
                                $department_name = $d['department_name'];
                                if ($uid == $department) {
                                  $dselected = 'SELECTED';
                                } else {
                                  $dselected = '';
                                }
                                echo "<option $dselected value=\"$uid\">$department_name</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="user_group">School/Faculty</label>
                            <select class="form-control" id="school" <?php echo $disabled; ?>>
                              <option value="0">~Select~</option>
                              <?php
                              $sch = fetchtable('d_schools', "school_status=1", "school_name", "asc", "10000");
                              while ($sc = mysqli_fetch_array($sch)) {
                                $uid = $sc['uid'];
                                $school_name = $sc['school_name'];
                                if ($uid == $school) {
                                  $scselected = 'SELECTED';
                                } else {
                                  $scselected = '';
                                }
                                echo "<option $scselected value=\"$uid\">$school_name</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="primary_email">Date of Admission</label>
                            <input type="date" value="<?php echo $admission_date; ?>" class="form-control" id="admission_date" <?php echo $disabled; ?> />
                          </div>

                          <div id="course_feedback"></div>

                    </form>
                  </div>

                  <!--Footer-->
                  <div class="modal-footer">

                    <button type="submit" onclick="savecourse();" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff;display:<?php echo $display; ?>" <?php echo $disabled; ?>>Save</button>
                    <i class="far fa-gem ml-1" style="display:<?php echo $display; ?>"></i>

                    <a role="button" class="btn waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101);display:<?php echo $display; ?>">No,
                      thanks</a>
                  </div>
                </div>
                <!--/.Content-->
              </div>
            </div>
            <!-- Central Modal Large Info-->
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
  <?php include_once 'footer.php'; ?>
</body>

</html>
