<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>DMS Home || Dashboard</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body class="grey lighten-3">
        <?php
            include_once 'header.php';
            
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
                           echo "<h2 class=\"text-center text-warning\">Welcome to your Dashboard</h2><br/>";
                          ?>
                    </div> 
        </div>
        
      </div>
      <div class="row wow fadeIn">
          
              <div class="card-body">  
               
              <br><br><br><br><br><br><br><br><br><br><br><br><br>
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

                