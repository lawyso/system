<?php
include_once 'session.php';
require_once 'includes/conn.inc';
require_once 'includes/func.php';
$ugroup = usergroup($_SESSION['dms_']);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dissertation Management System || Topics in Global Academia</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
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
        <div class="col-md-12 mb-4">
          <div class="card">
            <?php
            if (!isset($_GET['user'])) {
              ?>
              <div class="card-header">
                <p>Research Topics In The Global Academia World</p>
              </div>
              <div class="card-body box-body">
                <div class="col-lg-12">
                  <table id="research_table" class="table table-bordered table-striped display table-responsive-lg">
                    <thead>
                      <tr class="bg-white">
                        <th>Research Topic </th>
                        <th>Researcher</th>
                        <th>Institution</th>
                        <th>Supervisor</th>
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
                    var dataTable = $('#research_table').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "ajax": {
                        url: "resources/research_list.php",
                        type: "post"
                      },
                      "order": [
                        [0, 'asc']
                      ],

                    });
                  });
                </script>
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

</body>

</html>
