<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Home || Dashboard</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';
  include_once 'includes/conn.inc';
  include_once 'includes/func.php';
  ?>
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

      <!--Grid row-->
      <div class="row wow">

        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <div class="card">
            <div class="card-header">
              <?php
              // check if you have any approved active proposal
              $proposalExists = checkrowexists('d_proposals', "user='$myid' AND status='2'");
              if ($proposalExists == 0) {
                $disabled = 'disabled';
              } else {
                $disabled = "";
              }

              ?>
              <p>Scheduled Defense&emsp;<button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff" <?php echo $disabled; ?>>Apply for Defense</button>
            </div>
            <div class="card-body box-body">
              <div class="col-lg-12">
                <table id="d_table" class="table table-bordered table-striped display table-responsive-lg">
                  <thead>
                    <tr class="bg-white">
                      <th>Project Title </th>
                      <th>Department</th>
                      <th>Faculty</th>
                      <th>Defense By</th>
                      <th>Defense Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot style="background-color: #F0F0F0">

                  </tfoot>
                </table>
              </div>
              <script>
                $(document).ready(function() {
                  var dataTable = $('#d_table').DataTable({
                    "bprocessing": true,
                    "serverSide": true,
                    "ajax": {
                      url: "resources/defense_list.php",
                      type: "post"
                    },
                    "columnDefs": [{

                        "render": function(data, type, row) {
                          let rowID = row[5];
                          return `<a href="#?defense=${ rowID }"><i class="fa fa-eye"></i></a>`
                        },
                        "targets": 5

                      }

                    ]

                  });
                });
              </script>
            </div>
            <!-----------------------------------------------------Modal window ----------------!>

                <!-- Central Modal Large Info-->
            <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-notify" role="document">
                <!--Content-->
                <div class="modal-content">
                  <!--Header-->
                  <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
                    <p class="heading lead">Apply for Defense</p>

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
                            <label for="Title">Project Title</label><input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                            <input type="text" class="form-control" value="<?php echo $project_title; ?>" id="project_title" />
                          </div>

                          <div class="form-group">
                            <label>Department</label>
                            <select id="department" class="form-control">
                              <option value="0">~Select~</option>
                              <?php
                              $dep = fetchtable('d_departments', "department_status=1", "department_name", "asc", "10000");
                              while ($d = mysqli_fetch_array($dep)) {
                                $uid = $d['uid'];
                                $department_name = $d['department_name'];
                                if ($uid == $department) {
                                  $dselected = 'SELECTED';
                                } else {
                                  $dselected = '';
                                }
                                echo "<option $gselected value=\"$uid\">$department_name</option>";
                              }
                              ?>
                            </select>
                          </div>

                          <label>Faculty/school</label>
                          <select id="school" class="form-control">
                            <option value="0">~Select~</option>
                            <?php
                            $sc = fetchtable('d_schools', "school_status=1", "school_name", "asc", "10000");
                            while ($s = mysqli_fetch_array($sc)) {
                              $uid = $s['uid'];
                              $school_name = $s['school_name'];
                              if ($uid == $school) {
                                $sselected = 'SELECTED';
                              } else {
                                $sselected = '';
                              }
                              echo "<option $sselected value=\"$uid\">$school_name</option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="date">Defense Date</label>
                          <input type="date" class="form-control" value="<?php echo $defense_date; ?>" id="defense_date" />
                        </div>

                        <div id="defense_feedback"></div>

                    </form>
                  </div>

                  <!--Footer-->
                  <div class="modal-footer">

                    <button type="submit" onclick="save_defense();" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff">Save</button>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

</body>

</html>
