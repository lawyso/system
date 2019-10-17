<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DMS Mailbox || inbox</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <style>
    .no-padding {
      padding: 0 !important;
    }

    .box-title {
      display: inline-block;
      font-size: 18px;
      margin: 0;
      line-height: 1;
    }

    .pull-right {
      float: right;
    }

    .box-header>.box-tools {
      position: absolute;
      right: 10px;
      top: 5px;
    }

    .has-feedback {
      position: relative;
    }

    .box-body {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 3px;
      border-bottom-left-radius: 3px;
      padding: 10px;
    }

    .box-header.with-border {
      border-bottom: 1px solid #f4f4f4;
    }

    .box-header {
      color: #444;
      display: block;
      padding: 10px;
      position: relative;
    }

    .input-sm {
      height: 30px;
      padding: 5px 10px;
      font-size: 12px;
      line-height: 1.5;
      border-radius: 3px;
    }

    .form-control-feedback {
      position: absolute;
      top: 0;
      right: 0;
      z-index: 2;
      display: block;
      width: 34px;
      height: 34px;
      line-height: 34px;
      text-align: center;
      pointer-events: none;
    }

    .btn-default {
      background-color: #f4f4f4;
      color: #444;
      border-color: #ddd;
    }

    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab span:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab span.active {
      background-color: thistle;
      color: rgb(13, 27, 112);
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

    .tabcontent {
      animation: fadeEffect 1s;
      /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }
  </style>

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
              <h5 class="mb-2 mb-sm-0 pt-1">
                <a href="#">Mailbox</a>
                <span>/</span>
                <span>Inbox</span>
              </h5>
            </div>
            <!-- Heading -->
            <!--Card content-->
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <span href="#" class="btn btn-md btn-dms btn-block margin-bottom tablinks" onclick="openCity(event, 'compose')">Compose</span>

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h5 class="box-title">Folders</h5>
                    </div>
                    <div class="box-body no-padding">
                      <div class="list-group list-group-flush tab">
                        <span class="list-group-item list-group-item-action waves-effect tablinks" onclick="openCity(event, 'inbox')" id="defaultOpen">
                          <i class="fas fa-inbox mr-3"></i>Inbox</span>
                        <span href="#" class="list-group-item list-group-item-action waves-effect tablinks" onclick="openCity(event, 'sent')">
                          <i class=" fas fa-envelope mr-3"></i>Sent</span>
                        <span href="#" class="list-group-item list-group-item-action waves-effect tablinks" onclick="openCity(event, 'drafts')">
                          <i class="fas fa-file mr-3"></i>Drafts</span>
                        <span href="#" class="list-group-item list-group-item-action waves-effect tablinks" onclick="openCity(event, 'junk')">
                          <i class="fas fa-filter mr-3"></i>Junk</span>
                        <span href="#" class="list-group-item list-group-item-action waves-effect tablinks" onclick="openCity(event, 'trash')">
                          <i class="fa fa-trash mr-3"></i>Trash</span>

                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <div class="col-md-8">
                  <!-- Tab content -->
                  <div id="inbox" class="tabcontent">
                    <?php
                    include_once('mail/inbox.php');
                    ?>
                  </div>

                  <div id="sent" class="tabcontent">
                    <?php
                    include_once('mail/sent.php');
                    ?>
                  </div>

                  <div id="drafts" class="tabcontent">
                    <?php
                    include_once('mail/drafts.php');
                    ?>
                  </div>

                  <div id="junk" class="tabcontent">
                    <?php
                    include_once('mail/junk.php');
                    ?>
                  </div>
                  <div id="trash" class="tabcontent">
                    <?php
                    include_once('mail/trash.php');
                    ?>
                  </div>
                  <div id="compose" class="tabcontent">
                    <?php
                    include_once('mail/compose.php');
                    ?>
                  </div>
                  <!-- /. box -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <script src="js/main.js" type="text/javascript"></script>
  <?php include_once 'footer.php'; ?>
</body>
<script>
  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>
<script>
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>


</html>
