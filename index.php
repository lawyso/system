<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Home || Dashboard</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <style>
    .small-box {
      border-radius: 2px;
      position: relative;
      display: block;
      margin-bottom: 20px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1)
    }

    .small-box>.inner {
      padding: 10px
    }

    .small-box>.small-box-footer {
      position: relative;
      text-align: center;
      padding: 3px 0;
      color: #fff;
      color: rgba(255, 255, 255, 0.8);
      display: block;
      z-index: 10;
      background: rgba(0, 0, 0, 0.1);
      text-decoration: none
    }

    .small-box>.small-box-footer:hover {
      color: #fff;
      background: rgba(0, 0, 0, 0.15)
    }

    .small-box h3 {
      font-size: 38px;
      font-weight: bold;
      margin: 0 0 10px 0;
      white-space: nowrap;
      padding: 0
    }

    .small-box p {
      font-size: 15px
    }

    .small-box p>small {
      display: block;
      color: #f9f9f9;
      font-size: 13px;
      margin-top: 5px
    }

    .small-box h3,
    .small-box p {
      z-index: 5
    }

    .small-box .icon {
      -webkit-transition: all .3s linear;
      -o-transition: all .3s linear;
      transition: all .3s linear;
      position: absolute;
      top: -10px;
      right: 10px;
      z-index: 0;
      font-size: 90px;
      color: rgba(0, 0, 0, 0.15)
    }

    .small-box:hover {
      text-decoration: none;
      color: #f9f9f9
    }

    .small-box:hover .icon {
      font-size: 95px
    }

    @media (max-width:767px) {
      .small-box {
        text-align: center
      }

      .small-box .icon {
        display: none
      }

      .small-box p {
        font-size: 12px
      }
    }

    .bg-purple {
      background-color: #605ca8 !important
    }

    .bg-maroon {
      background-color: #d81b60 !important
    }

    .bg-gray-active {
      color: #000;
      background-color: #b5bbc8 !important
    }

    .bg-black-active {
      background-color: #000 !important
    }

    .bg-navy {
      background-color: #001f3f !important
    }

    .bg-teal {
      background-color: #39cccc !important
    }

    .bg-olive {
      background-color: #3d9970 !important
    }

    .bg-lime {
      background-color: #01ff70 !important
    }

    .bg-orange {
      background-color: #ff851b !important
    }

    .bg-fuchsia {
      background-color: #f012be !important
    }
  </style>
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
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12">

          <div class="card-header">
            <?php
            echo "<p class=\"fa fa-home fa-2x text-left\"> <span class=\"text-success\" style=\"font-size:16px;\"> Hello $user, Welcome to your Dashboard</span></p>";
            ?>
          </div>
          <!--Grid row-->
          <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-12 mb-4">

              <!--Card-->
              <div class="card">

                <!--Card content-->
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
      </div>

    </div>

  </main>
  <!--Main layout-->

  <?php include_once 'footer.php'; ?>
  <script src="js/main.js" type="text/javascript"></script>
</body>

</html>
