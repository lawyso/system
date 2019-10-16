<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Supervisor || Assigned Students</title>
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
              <button class="btn btn-dms btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo">Assigned Students My Portfolio</button>
            </div>
            <div class="card-body">
              <div class="col-lg-12">
                <table id="st_table" class="table table-bordered table-striped table-responsive display" width="100%">
                  <thead>
                    <tr style="background-color: rgb( 17, 122, 101);color: #ffff">
                      <th>FirstName</th>
                      <th>LastName</th>
                      <th>Course of Study</th>
                      <th>Phone No</th>
                      <th>Email</th>
                      <th>Proposal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot style="background-color: #F0F0F0">
                    <tr>
                      <th>FirstName</th>
                      <th>LastName</th>
                      <th>Course of Study</th>
                      <th>Phone No</th>
                      <th>Email</th>
                      <th>Proposal</th>
                      <th>Action</th>

                    </tr>
                  </tfoot>
                </table>
              </div>
              <script>
                $(document).ready(function() {
                  var dataTable = $('#st_table').DataTable({
                    "bprocessing": true,
                    "serverSide": true,
                    "ajax": {
                      url: "resources/student_list.php",
                      type: "post"
                    },
                    "columnDefs": [{

                      "render": function(data, type, row) {
                        let rowID = row[6];
                        return `<a href="student_details?student=${ rowID }"><i class="fa fa-eye"></i></a>`
                      },
                      "targets": 6

                    }],
                    "order": [
                      [5, 'asc']
                    ],
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
