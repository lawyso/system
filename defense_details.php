<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Dms Details|| Defenses</title>
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
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <div class="card-body">
              <?php
              if (isset($_GET['defense'])) {
                $esid = $_GET['defense'];
                $sid = decurl($esid);
                $p = fetchonerow('d_defense', "uid='$sid'");
                $title = $p['project_title'];
                $user = $p['defender'];
                $area_study = fetchrow('d_proposals', "user='$user' AND status='2'", "area_study");
                $date_scheduled = $p['date_scheduled'];
                $user_title = fetchrow('d_users_primary', "uid='$user'", "title");
                $userTitle = fetchrow('d_title', "uid='$user_title'", "name");
                $supervisors[] = fetchrow('d_proposals', "user='$user'", "supervisor_1");
              }
              ?>
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td><b>Project/Defense Title:</b></td>
                    <td><?php echo $title;  ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Areas of Study/Research</b></td>
                    <td><?php echo $area_study; ?></td>
                  </tr>
                  <tr>
                    <td><b>Supervisors:</b></td>
                    <td>
                      <ol>
                        <?php
                        foreach ($supervisors as $sups) {
                          $sup_title = fetchrow('d_users_primary', "uid='$sups'", "title");
                          $supTitle = fetchrow('d_title', "uid='$sup_title'", "name");
                          $supName = profileName($sups);
                          echo "<li>$supTitle  $supName</li>";
                        }

                        ?>

                    </td>
                  </tr>
                  <tr>
                    <td><b>Date Scheduled:</b></td>
                    <td><?php echo $date_scheduled; ?></td>
                  </tr>
                  <tr>
                    <td><b>Defense Date:</b></td>
                    <td><?php echo $date_modified; ?></td>
                  </tr>

                  <tr>
                    <td><b>Defense By:</b></td>
                    <td><?php echo $userTitle . ' ' . profileName($user); ?></td>
                  </tr>


                </tbody>
              </table>
              <div id="pro_feedback"></div>

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->
        <!-- Central Modal Large Info-->
        <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-notify" role="document">
            <!--Content-->
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
                <p class="heading lead">Concept Paper/Proposal Upload</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">&times;</span>
                </button>
              </div>

              <!--Body-->
              <div class="modal-body">
                <!-- form start -->
                <form role="form" method="POST" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <div class="form-group">
                        <input type="hidden" value="<?php echo $sid; ?>" id="sid" />
                      </div>
                      <div class="form-group">
                        <label for="proposal upload">Proposal Upload</label>
                        <input type="file" name="file" class="form-control">
                      </div>

                </form>
              </div>

              <!--Footer-->
              <div class="modal-footer">

                <input type="submit" name="save_proposal" value="Save" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff" />
                <i class="far fa-gem ml-1"></i>

                <a role="button" class="btn waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
                  thanks</a>
              </div>
            </div>
            <!--/.Content-->
          </div>
        </div>
        <!-- Central Modal Large Info-->


      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <?php include_once 'footer.php'; ?>
</body>

</html>
