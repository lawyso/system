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
  <!--Main layout-->
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
              $department = fetchrow('d_users_primary', "uid='$myid'", "department");
              $department_name = fetchrow('d_departments', "uid='$department'", "department_name");
              ?>
              <p><button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff">Supervisors In Your Department:</button> Department of <?php echo $department_name ?></p>
            </div>
            <div class="card-body box-body">
              <div class="col-lg-12">
                <table id="sp_table" class="table table-bordered table-striped display table-responsive">
                  <thead>
                    <tr class="bg-white">
                      <th>Title</th>
                      <th>FirstName</th>
                      <th>LastName</th>
                      <th>Faculty</th>
                      <th>Department</th>
                      <th>Phone</th>
                      <th>Email</th>
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
                  var dataTable = $('#sp_table').DataTable({
                    "bprocessing": true,
                    "serverSide": true,
                    "ajax": {
                      url: "resources/supervisor_list.php",
                      type: "post"
                    }

                  });
                });
              </script>

            </div>
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
