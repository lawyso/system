<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Student Proposals</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
        <div class="col-md-12">
          <?php
          if (!isset($_GET['user'])) {

            ?>
            <div class="card-header">
              <p>My Proposals&emsp;<button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff">Submit concept paper/proposal</button>
            </div>
        </div>
        <br> <br>
        <div class="col-md-3"></div>
        <div id="prop_feedback" class="col-md-6"></div>
        <div class="col-md-3"></div>

        <div class="col-sm-12 col-md-12 col-xs-12">
          <table id="user_table" class="table table-bordered table-striped display table-responsive" width=100%>
            <thead>
              <tr style="background-color: rgb( 17, 122, 101);color: #ffff">
                <th>Proposal Title </th>
                <th>Area of research </th>
                <th>Status</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
                $qry = fetchtable('d_proposals', "uid>0 AND user='$myid'", "uid", "desc", "1000", '*');
                $total = mysqli_num_rows($qry);
                while ($p = mysqli_fetch_array($qry)) {
                  $proposal_id = $p['uid'];
                  $epid = encurl($proposal_id);
                  $user = $p['user'];
                  $title = $p['title'];
                  $area_study = $p['area_study'];
                  $date_modified = $p['date_modified'];
                  $added_date = $p['added_date'];
                  $status = $p['status'];
                  $state = fetchrow('d_proposal_statuses', "uid='$status'", "name");
                  $states = $state;

                  if ($status == 1) {
                    $state = "<span style=\"background-color=\"green\">$states</span>";
                  }
                  if ($status == 2) {
                    $state = "<span class=\"label label-success\">$states</span>";
                  }
                  if ($status == 3) {
                    $state = "<span class=\"label label-warning\">$states</span>";
                  }

                  $hourdiff = round((strtotime($fulldate) - strtotime($added_date)) / 3600, 1);
                  if ($hourdiff > 2) {
                    $disabled = "disabled";
                    $display = "none";
                  } else {
                    $disabled = '';
                  }

                  $view = "<p><a href=\"proposal_details?proposal=$epid\"><button class=\"btn btn-md btn-success\" aria-hidden=\"true\">View</button></a>&nbsp;<button $disabled onclick=\"delete_proposal('$proposal_id')\" class=\"btn btn-md btn-danger\" aria-hidden=\"true\" style=\"display:$display\">Delete</button></p>";
                  //$action = "<a href=\"details?loan=$elid\" class=\"fa fa-eye\" aria-hidden=\"true\"></a>";
                  echo "<tr>
                                        <td>$title</td>
                                        <td>$area_study</td>
                                        <td>$state</td>
                                        <td>$view</td></tr> ";
                }
                if ($total == 0) {
                  echo "<tr><td colspan=\"20\" color=\"blue-purple\"><em><b>No Concept paper/Proposal Found.<b></em></td>
                                                            </tr> ";
                }
                ?>
            </tbody>
            <tfoot style="background-color: #F0F0F0">
              <tr>

                <th>Proposal Title </th>
                <th>Area of research </th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <!-----------------------------------------------------Modal window ----------------!>

   <!-- Modal -->
  <?php


  if (isset($_GET['edit-proposal'])) {
    $esid = $_GET['edit-user'];
    $sid = decurl($esid);
    $sd = fetchonerow('d_proposals', "uid='$sid'");
    $title = $sd['title'];
    $area_study = $sd['area_study'];
    $sup_1 = $p['supervisor_1'];
    $sup_2 = $p['supervisor_2'];
    $sup_3 = $p['supervisor_3'];

    $action = "Edit Proposal/Concept Paper";
    $edi = 1;
    $my_department = fetchrow('d_users_primary', "uid='$myid'", "department");
    $my_faculty = fetchrow('d_users_primary', "uid='$myid'", "faculty");
  } else {
    $sid = 0;
    $my_department = fetchrow('d_users_primary', "uid='$myid'", "department");
    $my_faculty = fetchrow('d_users_primary', "uid='$myid'", "faculty");
    $action = "Submit Concept paper/proposal";
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
                  <label for="Title">Title</label><input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                  <textarea class="form-control" id="title"><?php echo $title; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="Area of Study">Area of Study</label>
                  <textarea class="form-control" id="area_study"><?php echo $area_study; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Supervisor 1</label>
                  <select id="supervisor_1" class="form-control">
                    <option value="0">~Select~</option>
                    <?php
                    $super = fetchtable('d_users_primary', "status=1 AND user_group=3 AND department=$my_department AND faculty=$my_faculty", "uid", "asc", "100000");
                    while ($g = mysqli_fetch_array($super)) {
                      $uid = $g['uid'];
                      $title = $g['title'];
                      $title_name = fetchrow('d_title', "uid='$title'", "name");
                      $f_name = $g['first_name'];
                      $l_name = $g['last_name'];
                      if ($uid == $sup_1) {
                        $gselected = 'SELECTED';
                      } else {
                        $gselected = '';
                      }
                      echo "<option $gselected value=\"$uid\">$title_name $f_name $l_name</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="Supervisor 2">Supervisor 2</label>
                  <select class="form-control" id="supervisor_2">
                    <option value="0">~Select~</option>
                    <?php
                    $super = fetchtable('d_users_primary', "status=1 AND user_group=3 AND department=$my_department AND faculty=$my_faculty", "uid", "asc", "100000");
                    while ($g = mysqli_fetch_array($super)) {
                      $uid = $g['uid'];
                      $title = $g['title'];
                      $f_name = $g['first_name'];
                      $l_name = $g['last_name'];
                      if ($uid == $sup_2) {
                        $gselected = 'SELECTED';
                      } else {
                        $gselected = '';
                      }
                      echo "<option $gselected value=\"$uid\">$title_name $f_name $l_name</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="Supervisor 3">Supervisor 3</label>
                  <select class="form-control" id="supervisor_3">
                    <option value="0">~Select~</option>
                    <?php
                    $super = fetchtable('d_users_primary', "status=1 AND user_group=3 AND department=$my_department AND faculty=$my_faculty", "uid", "asc", "100000");
                    while ($g = mysqli_fetch_array($super)) {
                      $uid = $g['uid'];
                      $title = $g['title'];
                      $f_name = $g['first_name'];
                      $l_name = $g['last_name'];
                      if ($uid == $sup_3) {
                        $gselected = 'SELECTED';
                      } else {
                        $gselected = '';
                      }
                      echo "<option $gselected value=\"$uid\">$title_name $f_name $l_name</option>";
                    }
                    ?>
                  </select>
                </div>

                <div id="proposal_feedback"></div>

          </form>
        </div>

        <!--Footer-->
        <div class="modal-footer">

          <button type="submit" onclick="save_proposal();" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff">Save</button>
          <i class="far fa-gem ml-1"></i>

          <a role="button" class="btn waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
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


  </div>
  <!--Grid column-->


  </div>
  </div>
  </main>
  <!--Main layout-->

  <?php include_once 'footer.php'; ?>
  <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
