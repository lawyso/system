<?php
require_once 'includes/conn.inc';
require_once 'includes/func.php';
$user = profile($_SESSION['dms_']);
$ugroup = usergroup($_SESSION['dms_']);
$id = session_details($_SESSION['dms_']);
?>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style>

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
.user_image {
  border-radius: 50%;
  min-height: 120px;
  width: 120px;
  padding-top: 2px;
}
.navbar {
  font-size: 15px;
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
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
              }  elseif (strpos($page, 'departmental-proposals') !== false) {
                  $home_dp = 'active';
              } 
              else {
                  
              }
              
            if ($ugroup == 2) {
              ?>
            <li class="nav-item <?php echo $home_current; ?>">
              <a class="nav-link waves-effect" href="index">Home</a>
            </li>
            <li class="nav-item <?php echo $home_bio; ?>">
              <a class="nav-link waves-effect" href="update_bio">UPDATE BIODATA</a>
            </li>             
            <li class="nav-item <?php echo $home_reg; ?>">
              <a class="nav-link waves-effect" href="register">REGISTRATION</a>
            </li>
            <li class="nav-item <?php echo $home_pro; ?>">
              <a class="nav-link waves-effect" href="proposals">PROPOSALS</a>
            </li>
            <li class="nav-item <?php echo $home_def; ?>">
              <a class="nav-link waves-effect" href="defense">DEFENSE</a>
            </li>
            <li class="nav-item <?php echo $home_sup; ?>">
              <a class="nav-link waves-effect" href="supervisors">SUPERVISORS</a>
            </li>
            <li class="nav-item <?php echo $home_gac; ?>">
              <a class="nav-link waves-effect" href="global_academia">GLOBAL ACADEMIA</a>
            </li>
            <?php
            }
            elseif ($ugroup == 3) {
              ?>
            <li class="nav-item <?php echo $home_bio; ?>">
              <a class="nav-link waves-effect" href="update_bio">UPDATE BIODATA</a>
            </li>
            <li class="nav-item <?php echo $home_asgn; ?>">
              <a class="nav-link waves-effect" href="assigned_students">STUDENTS/PROPOSALS</a>
            </li>
            <li class="nav-item <?php echo $home_reg; ?>">
              <a class="nav-link waves-effect" href="update_bio">DORMANT STUDENTS</a>
            </li>
            <li class="nav-item <?php echo $home_reg; ?>">
              <a class="nav-link waves-effect" href="update_bio">NOTIFICATIONS</a>
            </li>
            <?php
            }
            elseif ($ugroup == 4) {
              ?>
            <li class="nav-item <?php echo $home_bio; ?>">
              <a class="nav-link waves-effect" href="update_bio">UPDATE BIODATA</a>
            </li>
            <li class="nav-item <?php echo $home_dp; ?>">
              <a class="nav-link waves-effect" href="departmental-proposals">PROPOSALS</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link waves-effect" href="departl_defense">DEFENSE</a>
            </li>
            <?php
            }
            elseif ($ugroup == 5) {
              ?>
            <li class="nav-item <?php echo $home_bio; ?>">
              <a class="nav-link waves-effect" href="update_bio">UPDATE BIODATA</a>
            </li>
            <?php
            }
            elseif ($ugroup == 6) {
              ?>
            <li class="nav-item <?php echo $home_bio; ?>">
              <a class="nav-link waves-effect" href="update_bio">UPDATE BIODATA</a>
            </li>
            <?php
            }
            ?>
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
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect">
        <img src="img/avatar5.png" class="user_image" alt="">
      </a>
      <span><center style="color:#4a235a ;font-weight:bold;font-size:18px"><?php echo 'Hi ' . $user; ?></center></span>

      <div class="list-group list-group-flush">
        <a href="index" class="list-group-item active waves-effect" style="background-color: rgb( 17, 122, 101);color: #ffff">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="profile" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-user mr-3"></i>Profile</a>
        <a href="change_pass" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-lock mr-3"></i>Change Password</a>
          <?php 
            if ($ugroup == 1) {
              ?>
        <a href="settings" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-sitemap mr-3"></i>User Management</a>
          <?php
            }
            ?>
        
        <a href="login?logout" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-sign-out-alt mr-3"></i>Signout</a>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->