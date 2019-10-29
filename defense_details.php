<div class="card">
  <div class="card-header">

    <h5 class="mb-2 mb-sm-0 pt-1">
      <a href="#" target="_blank">Defense </a>
      <span>/</span>
      <span>Details</span>&emsp;<button class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff">Defense Details</button>
    </h5>
  </div>

  <!--Card content-->
  <div class="card-body">
    <?php
    if (isset($_GET['defense'])) {
      $esid = $_GET['defense'];
      $sid = decurl($esid);
      $p = fetchonerow('d_defense', "uid='$sid'");
      $title = $p['project_title'];
      $user = $p['defender'];
      $status = $p['defense_status'];
      $area_study = fetchrow('d_proposals', "user='$user' AND status='2'", "area_study");
      $date_scheduled = $p['date_scheduled'];
      $proposed_date = $p['defense_date'];
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
          <td><b>Proposed Defense Date:</b></td>
          <td><?php echo $proposed_date; ?></td>
        </tr>
        <tr>
          <td><b>Scheduled Defense Date:</b></td>
          <td><?php echo $date_scheduled; ?></td>
        </tr>


        <tr>
          <td><b>Defense By:</b></td>
          <td><?php echo $userTitle . ' ' . profileName($user); ?></td>
        </tr>
        <tr>
          <td></td>
          <td><?php

              if ($ugroup == 4 && $status == 1) {
                ?>
              <button onclick="approve_defense('<?php echo $esid;  ?>');" class="btn btn-sm btn-success">APPROVE/SCHEDULE DEFENSE</button>
              &nbsp;<button onclick="reject_defense('<?php echo $esid;  ?>');" class="btn btn-sm btn-danger">REJECT APPLICATIONS</button>

            <?php
            }
            if ($ugroup == 4 && $status == 2) {
              ?>
              &nbsp;<button onclick="close_defense('<?php echo $esid;  ?>');" class="btn btn-sm bg-navy">CLOSE DEFENSE</button>
            <?php
            }
            ?>
          </td>
        </tr>

      </tbody>
    </table>
    <div id="defenseAction_feedback"></div>

  </div>
</div>
