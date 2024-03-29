<?php
require_once 'includes/conn.inc';
require_once 'includes/func.php';
$user = profile($_SESSION['dms_']);
$ugroup = usergroup($_SESSION['dms_']);
$id = session_details($_SESSION['dms_']);
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
<link href="css/layout.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-dms scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index">
          <strong>DMS</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto" style="font-weight:300">
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
            } elseif (strpos($page, 'registeredStudents') !== false) {
              $home_reg = 'active';
            } elseif (strpos($page, 'global_academia') !== false) {
              $home_gac = 'active';
            } elseif (strpos($page, 'home') !== false) {
              $home_hom = 'active';
            } elseif (strpos($page, 'update_bio') !== false) {
              $home_bio = 'active';
            } elseif (strpos($page, 'assigned_students') !== false) {
              $home_asgn = 'active';
            } elseif (strpos($page, 'pendingApprovals') !== false) {
              $home_app = 'active';
            } elseif (strpos($page, 'global_academia') !== false) {
              $home_gac = 'active';
            } elseif (strpos($page, 'home') !== false) {
              $home_hom = 'active';
            } elseif (strpos($page, 'rejectedTopics') !== false) {
              $home_top = 'active';
            } elseif (strpos($page, 'settings') !== false) {
              $home_users = 'active';
            } elseif (strpos($page, 'profile') !== false) {
              $home_profile = 'active';
            } elseif (strpos($page, 'change_pass') !== false) {
              $home_pass = 'active';
            } elseif (strpos($page, 'reports') !== false) {
              $home_rep = 'active';
            } else { }

            if ($ugroup == 2) {
              ?>
              <li class="nav-item <?php echo $home_current; ?>">
                <a class="nav-link waves-effect" href="index">Home</a>
              </li>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">Bio-Data</a>
              </li>
              <li class="nav-item <?php echo $home_reg; ?>">
                <a class="nav-link waves-effect" href="register">Topic-Registration</a>
              </li>
              <li class="nav-item <?php echo $home_gac; ?>">
                <a class="nav-link waves-effect" href="global_academia">Global Academia</a>
              </li>
            <?php
            } elseif ($ugroup == 3) {
              ?>
              <li class="nav-item <?php echo $home_current; ?>">
                <a class="nav-link waves-effect" href="index">Home</a>
              </li>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">Bio-Data</a>
              </li>
              <li class="nav-item <?php echo $home_asgn; ?>">
                <a class="nav-link waves-effect" href="details?assigned_students">Students Report</a>
              </li>
              <li class="nav-item <?php echo $home_gac; ?>">
                <a class="nav-link waves-effect" href="global_academia">Global Academia</a>
              </li>
            <?php
            } elseif ($ugroup == 4) {
              ?>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">Bio-Data</a>
              </li>
              <li class="nav-item <?php echo $home_reg; ?>">
                <a class="nav-link waves-effect" href="details?registeredStudents">Registered Students</a>
              </li>
              <li class="nav-item <?php echo $home_app; ?>">
                <a class="nav-link waves-effect" href="details?pendingApprovals">Pending Approvals</a>
              </li>
              <li class="nav-item <?php echo $home_top; ?>">
                <a class="nav-link waves-effect" href="details?rejectedTopics">Rejected Topics</a>
              </li>
              <li class="nav-item <?php echo $home_pd; ?>">
                <a class="nav-link waves-effect" href="details?department_pendingDefenses">Assign Supervisors</a>
              </li>
              <li class="nav-item <?php echo $home_rep; ?>">
                <a class="nav-link waves-effect" href="details?reports">System Reports</a>
              </li>
              <li class="nav-item <?php echo $home_gac; ?>">
                <a class="nav-link waves-effect" href="global_academia">Global Academia</a>
              </li>
            <?php
            } elseif ($ugroup == 1) {
              ?>
              <li class="nav-item <?php echo $home_current; ?>">
                <a class="nav-link waves-effect" href="index">Home</a>
              </li>
              <li class="nav-item <?php echo $home_bio; ?>">
                <a class="nav-link waves-effect" href="update_bio">Bio-Data</a>
              </li>
              <li class="nav-item <?php echo $home_users; ?>">
                <a class="nav-link waves-effect" href="settings">Manage Users</a>
              </li>
              <li class="nav-item <?php echo $home_rep; ?>">
                <a class="nav-link waves-effect" href="details?reports">Reports</a>
              </li>
              <li class="nav-item <?php echo $home_gac; ?>">
                <a class="nav-link waves-effect" href="global_academia">Global Academia</a>
              </li>
            <?php
            }
            ?>

            <li class="dropdown nav-item pull-right" style="float:right">
              <button class="dropbtn nav-link">Account Settings
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
                <a href="profile" class="list-group-item  waves-effect"><i class="fas fa-user mr-3"></i> My Profile </a>
                <a href="change_pass" class="list-group-item  waves-effect"><i class="fas fa-lock mr-3"></i> Change-Password </a>
                <a href="login?logout" class="list-group-item  waves-effect"><i class="fas fa-sign-out-alt mr-3"></i> Signout </a>
              </div>
            </li>

          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed  bg-white">

      <a class="logo-wrapper waves-effect">
        <?php
        $passport = fetchrow('d_users_primary', "uid='$myid'", "profile_upload");
        if ($passport == null) {
          $passport_image = "images/avatar.png";
        } else {
          $passport_image = "faces/$passport";
        }
        echo '<img src="' . $passport_image . '" class="user_image" title="' . $groupName . '"/>';

        ?>
      </a>
      <span>
        <center style="color:#4a235a ;font-weight:bold;font-size:18px"><?php echo 'Hey, ' . $user; ?></center>
      </span>

      <div class="list-group list-group-flush">
        <a href="index" class="list-group-item active waves-effect" style="background-color: rgb( 17, 122, 101);color: #ffff">
          <i class="fas fa-home mr-3"></i>Dashboard
        </a>
        <a href="profile" class="list-group-item  waves-effect <?php echo $home_profile; ?>" style="color:black;">
          <i class="fas fa-user mr-3"></i>Profile</a>
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
