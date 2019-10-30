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
  include_once 'includes/func.php';
  include_once 'includes/conn.inc';

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
              echo "<p class=\"fa fa-home text-left\"> <span class=\"dark\" style=\"font-size:16px;\"> Hello $user, Welcome to your Dashboard</span></p>";
              ?>
            </div>
            <div class="card-body">

              <?php
              if ($ugroup == 1) {
                include_once 'resources/admin-dashboard.php';
              } elseif ($ugroup == 2) {
                include_once 'resources/student-dashboard.php';
              } elseif ($ugroup == 3) {
                include_once 'resources/sup-dashboard.php';
              } elseif ($ugroup == 4) {
                include_once 'resources/hod-dashboard.php';
              } elseif ($ugroup == 5) {
                include_once 'resources/reg-dashboard.php';
              } elseif ($ugroup == 6) {
                include_once 'resources/dvc-dashboard.php';
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
