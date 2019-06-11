<?php
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>Dms || proposal</title>
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
                                                if(isset($_GET['defense']))
                                {
                                $esid = $_GET['proposal'];     $sid = decurl($esid);
                                $p = fetchonerow('d_proposals',"uid='$sid'");
                                $title = $p['title'];
                                $area_study = $p['area_study'];
                                $sup_1 = $p['supervisor_1'];
                                $sup_2 = $p['supervisor_2'];
                                $sup_3 = $p['supervisor_3'];
                                $proposal_upload = $p['proposal_upload'];
                                $date_modified = $p['date_modified'];
                                $added_date = $p['added_date'];
                                $sup1_name = fetchrow('d_supervisors',"uid='$sup_1'","s_name");
                                $sup2_name = fetchrow('d_supervisors',"uid='$sup_2'","s_name");
                                $sup3_name = fetchrow('d_supervisors',"uid='$sup_3'","s_name");

                                $sup1_title = fetchrow('d_supervisors',"uid='$sup_1'","title");
                                $sup2_title = fetchrow('d_supervisors',"uid='$sup_2'","title");
                                $sup3_title = fetchrow('d_supervisors',"uid='$sup_3'","title");
                                
                                $status = $p['status']; $status_name =fetchrow('d_proposal_statuses',"uid='$status'","name");  
                                
                                if ($proposal_upload ==null) {
                                    $action = "No Proposal Document Uploaded yet<button class=\"btn btn-sm btn-success\" aria-hidden=\"true\" data-toggle=\"modal\" data-target=\"#centralModalLGInfoDemo\" style=\"background-color: rgb( 17, 122, 101);color: #ffff\">Upload Proposal Document</button>";
                                }
                                else {
                                    $hourdiff = round((strtotime($fulldate) - strtotime($date_modified))/3600, 1);
                                if ($hourdiff >2) {
                                    $disabled = "disabled";
                                }
                                else {
                                    $disabled = '';
                                }
                                    $action = "$proposal_upload<button $disabled onclick=\"del_proposal('$sid')\" class=\"btn btn-sm btn-danger\" aria-hidden=\"true\">Delete</button>";
                                
                                }
                                
     }
      ?>       
         <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Proposal Title:</b></td>
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
                        <li><?php echo $sup1_title.' '. $sup1_name; ?><li>
                        <li><?php echo $sup2_title.' '. $sup2_name; ?><li>
                        <li><?php echo $sup3_title.' '. $sup3_name; ?><li>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Date Created:</b></td>
                        <td><?php echo $added_date; ?></td>
                      </tr>
                      <tr>
                        <td><b>Date Last Modified:</b></td>
                        <td><?php echo $date_modified; ?></td>
                      </tr>
                       <tr>
                        <td><b>Status</b></td>
                        <td><?php echo $status_name; ?></td>
                        </tr>
                       <tr>
                        <td><b>Proposal Document</b></td>
                        <td><?php echo $action; ?></td>
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
              <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-notify" role="document" >
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
                      
                          <input type="submit" name="save_proposal" value="Save" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff"/>
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
