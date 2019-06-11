<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>DMS departmental proposals || Dashboard</title>
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
                      <p>Department proposals&emsp;<button class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff">Department proposals</button>
                    </div> 
        </div>
        
    <div class="col-md-3"></div><div id="prop_feedback" class="col-md-6"></div><div class="col-md-3"></div>
    <div class="row wow fadeIn">
          
        <div class="card-body">  
            <table id="dp_table" class="table table-bordered table-striped display" width=100%>
                <thead>
                  <tr style="background-color: rgb( 17, 122, 101);color: #ffff">
                      <th>Proposals Titles</th>
                      <th>Area of Study</th>
                      <th>Date Submitted</th>
                      <th>Date Modified</th>
                      <th>Status</th>                      
                      <th>Action</th>
                       
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot style="background-color: #F0F0F0">
                  <tr>
                   
                      <th>Proposals Titles</th>
                      <th>Area of Study</th>
                      <th>Date Submitted</th>
                      <th>Date Modified</th>
                      <th>Status</th>                      
                      <th>Action</th>
                  </tr>
                </tfoot>
            </table>
            <script>
              $(document).ready(function () {
                var dataTable = $('#dp_table').DataTable ({
                  "bprocessing": true,
                  "serverSide": true,
                  "ajax": {
                    url:"resources/supervisor_list.php",
                    type: "post"
                  }
                            
                    });
                });
            </script>           
              <br><br><br><br><br>
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
