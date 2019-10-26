<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Student Proposals</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
</head>

<body class="grey lighten-3">
  <?php
  include_once 'header.php';

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
              if (!isset($_GET['user'])) {

                ?>
                <p>My Proposals&emsp;<button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff">Submit concept paper/proposal</button>
            </div>
            <div class="card-body">

              <div class="col-md-3"></div>
              <div id="prop_feedback" class="col-md-6"></div>
              <div class="col-md-3"></div>

              <div class="col-lg-12">
                <table id="prop_tb" class="table table-bordered table-striped display table-responsive">
                  <thead>
                    <tr class="bg-white">
                      <th>Proposal / Concept Paper Title </th>
                      <th>Area / scope of study / research </th>
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

                        $view = "<p><a href=\"proposal_details?proposal=$epid\"><button class=\"btn btn-sm btn-success\" aria-hidden=\"true\">View</button></a>&nbsp;<button $disabled onclick=\"delete_proposal('$proposal_id')\" class=\"btn btn-sm btn-danger\" aria-hidden=\"true\" style=\"display:$display\">Delete</button></p>";
                        //$action = "<a href=\"details?loan=$elid\" class=\"fa fa-eye\" aria-hidden=\"true\"></a>";
                        echo "<tr>
                                        <td>$title</td>
                                        <td>$area_study</td>
                                        <td>$state</td>
                                        <td>$view</td></tr> ";
                      }

                      ?>
                  </tbody>
                  <tfoot style="background-color: #F0F0F0">

                  </tfoot>
                </table>
                <script>
                  $('document').ready(function() {
                    $('#prop_tb').DataTable({

                    });
                  });
                </script>
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
          $sup = $sd['supervisor_1'];


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
                        <label for="Title">Proposal/Concept Paper Title</label><input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                        <textarea class="form-control" id="title" <?php echo $disabled; ?>><?php echo $title; ?> </textarea>
                      </div>
                      <div class="form-group">
                        <label for="Area of Study">Proposal Area of Study</label>
                        <textarea class="form-control" id="area_study" <?php echo $disabled; ?>><?php echo $area_study; ?></textarea>
                      </div>
                      <div class="form-group">
                        <select id="supervisors" name="supervisors[]" multiple class="form-control" <?php echo $disabled; ?>>
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

                      <div id="proposal_feedback"></div>

                </form>
              </div>

              <!--Footer-->
              <div class="modal-footer">

                <button type="submit" onclick="save_proposal();" class="btn btn-sm btn-dms" style="display:<?php echo $display ?>">Save</button>
                <i class="far fa-gem ml-1" style="display:<?php echo $display ?>"></i>

                <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101);display:<?php echo $display ?>">No,
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
        <script>
          $(document).ready(function() {
            $('#supervisors').multiselect({
              nonSelectedText: 'Select Atleast Two Supervisors',
              width: 'resolve'

            });
            jQuery("#supervisors").on("change", function() {
              var selectedOptions = $('#supervisors option:selected');

              if ((selectedOptions.length >= 3) && (selectedOptions.length > 0)) {
                // Disable all other checkboxes.
                var nonSelectedOptions = $('#supervisors option').filter(function() {
                  return !$(this).is(':selected');
                });

                var dropdown = $('#supervisors').siblings('.multiselect-container');
                nonSelectedOptions.each(function() {
                  var input = $('input[value="' + $(this).val() + '"]');
                  input.prop('disabled', true);
                  input.parent('li').addClass('disabled');
                });
              } else if (selectedOptions.length <= 1) {
                var SelectedOptions = $('#supervisors option').filter(function() {
                  console.log("1 select")
                  return $(this).is(':selected');
                });
                var dropdown = $('#supervisors').siblings('.multiselect-container');
                SelectedOptions.each(function() {
                  var input = $('input[value="' + $(this).val() + '"]');
                  input.prop('disabled', true);
                  input.parent('li').addClass('disabled');
                });
              } else {
                // Enable all checkboxes.
                var dropdown = $('#supervisors').siblings('.multiselect-container');
                $('#supervisors option').each(function() {
                  var input = $('input[value="' + $(this).val() + '"]');
                  input.prop('disabled', false);
                  input.parent('li').addClass('disabled');
                });
              }
            });
            share
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
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
