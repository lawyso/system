<?php
require_once 'includes/conn.inc';
require_once 'includes/func.php';
$user = profile($_SESSION['dms_']);
$ugroup = usergroup($_SESSION['dms_']);
$id = session_details($_SESSION['dms_']);
$user = profile($_SESSION['dms_']);
$user = profile($_SESSION['dms_']);
$user_email = user_mail($_SESSION['dms_']);
$groupName = usergroup_name($_SESSION['dms_']);

?>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" href="images/dms_logo.jpg" alt="Dissertation Management System" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style>
  .dropdown {
    float: left;
    overflow: ;
  }

  .dropdown .dropbtn {
    font-size: 14px;
    border: none;
    outline: none;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
    min-width: 180px;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    float: none;
    color: black;
    padding: 5px 5px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .dropdown-content a {
    float: none;
    color: black;
    padding: 5px 8px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .navbar a:hover {
    background-color: thistle
  }
</style>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index">
          <strong style="color: rgb( 17, 122, 101)">DMS</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto" style="font-weight:400">
            <?php

            $uri = $_SERVER['REQUEST_URI'];

            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $p = explode('/', $url);
            $page = end($p);

            if (strpos($page, 'index') !== false) {
              $home_current = 'active';
            } elseif (strpos($page, 'register') !== false) {
              $home_reg = 'active';
            } elseif (strpos($page, 'proposals') !== false) {
              $home_pro = 'active';
            } elseif (strpos($page, 'defense') !== false) {
              $home_def = 'active';
            } elseif (strpos($page, 'supervisors') !== false) {
              $home_sup = 'active';
            } elseif (strpos($page, 'global_academia') !== false) {
              $home_gac = 'active';
            } elseif (strpos($page, 'home') !== false) {
              $home_hom = 'active';
            } elseif (strpos($page, 'update_bio') !== false) {
              $home_bio = 'active';
            } elseif (strpos($page, 'assigned_students') !== false) {
              $home_asgn = 'active';
            } elseif (strpos($page, 'supervisors') !== false) {
              $home_sup = 'active';
            } elseif (strpos($page, 'global_academia') !== false) {
              $home_gac = 'active';
            } elseif (strpos($page, 'home') !== false) {
              $home_hom = 'active';
            } elseif (strpos($page, 'dormant_students') !== false) {
              $home_ds = 'active';
            } elseif (strpos($page, 'settings') !== false) {
              $home_users = 'active';
            } elseif (strpos($page, 'profile') !== false) {
              $home_profile = 'active';
            } elseif (strpos($page, 'mail_box') !== false) {
              $home_mail = 'active';
            } elseif (strpos($page, 'change_pass') !== false) {
              $home_pass = 'active';
            } else { }

            if ($ugroup == 2) {
              ?>
              <li class="nav-item <?php echo $home_current; ?>">
                <a class="nav-link waves-effect" href="index">HOME</a>
              </li>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
              <li class="nav-item <?php echo $home_reg; ?>">
                <a class="nav-link waves-effect" href="register">COURSE-REGISTRATION</a>
              </li>
              <?php
                $registrationOk = checkrowexists('d_users_courses', "user='$myid' AND status='1'");
                if ($registrationOk == 1) {
                  ?>
                <li class="nav-item <?php echo $home_pro; ?>">
                  <a class="nav-link waves-effect" href="proposals">PROPOSALS</a>
                </li>
              <?php
                }
                $proposalOk = checkrowexists('d_proposals', "user='$myid' AND status='2'");
                if ($proposalOk == 1) {
                  ?>
                <li class="nav-item <?php echo $home_def; ?>">
                  <a class="nav-link waves-effect" href="defense">DEFENSE</a>
                </li>
              <?php
                }
                ?>
              <li class="nav-item <?php echo $home_sup; ?>">
                <a class="nav-link waves-effect" href="supervisors">SUPERVISORS</a>
              </li>
              <li class="nav-item <?php echo $home_gac; ?>">
                <a class="nav-link waves-effect" href="global_academia">GLOBAL ACADEMIA</a>
              </li>
            <?php
            } elseif ($ugroup == 3) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
              <li class="nav-item <?php echo $home_asgn; ?>">
                <a class="nav-link waves-effect" href="assigned_students">STUDENTS/PROPOSALS</a>
              </li>
              <li class="nav-item <?php echo $home_ds; ?>">
                <a class="nav-link waves-effect" href="dormant_students">DORMANT STUDENTS</a>
              </li>
              <li class="nav-item <?php echo $home_reg; ?>">
                <a class="nav-link waves-effect" href="update_bio">NOTIFICATIONS</a>
              </li>
            <?php
            } elseif ($ugroup == 4) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
              <li class="nav-item <?php echo $home_dp; ?>">
                <a class="nav-link waves-effect" href="departmental-proposals">PROPOSALS</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link waves-effect" href="departl_defense">DEFENSE</a>
              </li>
            <?php
            } elseif ($ugroup == 5) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
            <?php
            } elseif ($ugroup == 6) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
            <?php
            } elseif ($ugroup == 1) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">BIODATA</a>
              </li>
              <li class="nav-item <?php echo $home_users; ?>">
                <a class="nav-link waves-effect" href="settings">MANAGE USERS</a>
              </li>
            <?php
            }
            ?>

            <li class="dropdown nav-item">
              <button class="dropbtn nav-link">ACCOUNT SETTINGS
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
                <a href="profile" class="list-group-item  waves-effect"><i class="fas fa-user mr-3"></i> My Profile </a>
                <a href="change_pass" class="list-group-item  waves-effect"><i class="fas fa-lock mr-3"></i> Change-Password </a>
                <a href="login?logout" class="list-group-item  waves-effect"><i class="fas fa-sign-out-alt mr-3"></i> Signout </a>
              </div>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">SUPERVISORS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">DEPARMENT HEADS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">ACADEMIC REGISTRA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">DVC GRADUATE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">PROPOSALS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="#" target="_blank">GLOBAL ACADEMIA</a>
            </li>
            --->
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed ">

      <a class="logo-wrapper waves-effect">
        <?php
        $passport = fetchrow('d_users_primary', "uid='$myid'", "profile_upload");
        if ($passport == null) {
          $passport_image = "img/avatar5.png";
        } else {
          $passport_image = "faces/$passport";
        }
        echo '<img src="' . $passport_image . '" class="user_image" title="' . $groupName . '"/>';

        ?>

      </a>
      <span>
        <center style="color:#4a235a ;font-weight:bold;font-size:18px"><?php echo 'Hi ' . $user; ?></center>
      </span>

      <div class="list-group list-group-flush">
        <a href="index" class="list-group-item active waves-effect" style="background-color: rgb( 17, 122, 101);color: #ffff">
          <i class="fas fa-home mr-3"></i>Dashboard
        </a>
        <a href="profile" class="list-group-item  waves-effect <?php echo $home_profile; ?>" style="color:black;">
          <i class="fas fa-user mr-3"></i>Profile</a>
        <a href="mail_box" class="list-group-item waves-effect <?php echo $home_mail; ?>" style="color:black;">
          <i class="fas fa-envelope mr-3"></i>Mailbox</a>
        <a href="change_pass" class="list-group-item waves-effect <?php echo $home_pass; ?>" style="color:black;">
          <i class="fas fa-lock mr-3"></i>Change Password</a>
        <?php
        if ($ugroup == 1) {
          ?>
          <a href="settings" class="list-group-item waves-effect <?php echo $home_users; ?>" style="color:black;">
            <i class="fas fa-sitemap mr-3"></i>Users Management</a>
        <?php
        }
        ?>

        <a href="login?logout" class="list-group-item waves-effect" style="color:black;">
          <i class="fas fa-sign-out-alt mr-3"></i>Signout</a>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->
