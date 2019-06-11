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
                                                if(isset($_GET['proposal']))
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
                                $sup1_details = fetchonerow('d_users_primary',"uid='$sup_1'","title,first_name,last_name");
                                  $s1_title = $sup1_details['title'];
                                  $title_name1 = fetchrow('d_title',"uid='$s1_title'","name");
                                  $s1_fname = $sup1_details['first_name'];
                                  $s1_lname = $sup1_details['last_name'];
                                  
                                $sup2_details = fetchonerow('d_users_primary',"uid='$sup_2'","title,first_name,last_name");
                                  $s2_title = $sup2_details['title'];
                                  $title_name2 = fetchrow('d_title',"uid='$s2_title'","name");
                                  $s2_fname = $sup2_details['first_name'];
                                  $s2_lname = $sup2_details['last_name'];

                                $sup3_details = fetchonerow('d_users_primary',"uid='$sup_3'","title,first_name,last_name");
                                  $s3_title = $sup3_details['title'];
                                  $title_name3 = fetchrow('d_title',"uid='$s3_title'","name");
                                  $s3_fname = $sup3_details['first_name'];
                                  $s3_lname = $sup3_details['last_name'];
                                
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
                        <li><?php echo $title_name1.' '. $s1_fname.' '.$s1_lname ; ?></li>
                        <li><?php echo $title_name2.' '. $s2_fname.' '.$s2_lname ; ?></li>
                        <li><?php echo $title_name3.' '. $s3_fname.' '.$s3_lname ; ?></li>
                        </ol>
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
                <form method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                    <div class="form-group">
                      <input type="hidden" value="<?php echo $sid; ?>" id="sid" name="sid" />
                    </div>
                    <div class="form-group">
                      <label for="proposal upload">Proposal Upload</label>
                      <input type="file" name="proposal_" class="form-control" id="proposal_">
                    </div> 
                    <div id="prop_feedback"></div>
                </form>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer">
                      
                          <button type="submit" name="save_proposal" class="btn " style="background-color: rgb( 17, 122, 101);color: #ffff">Upload</button>
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
<?php

if(isset($_POST['save_proposal']))
    {
        $cid = $_POST['sid'];        
        
        $proposal_name = $_FILES['proposal_']['name'];
        $proposal_temp = $_FILES['proposal_']['tmp_name'];
        $proposal_size = $_FILES['proposal_']['size'];

        $allowed_formats = array('pdf','zip','rar','docx','doc');

        $upload_location = 'props/';
        
        
        ////////////___________Validate
        
        if($proposal_size > 100)
            {
              $formatOk = file_type($proposal_name,$allowed_formats); 
              $fileOk = 1; 
              if($formatOk == 0)
              {
                 
                  echo "<script>alert('Proposal File format is invalid:Only PDF,ZIP & RAR files allowed')</script>";
                  
              }
            }
        else
            {           
                $refresh = 1;     
                echo "<script>alert('Proposal Document is Required')</script>";
                
                $fileOk = 0;
               
            }
        
        ///////////____________Save
        
        $validate = $fileOk+$formatOk;
      // echo $validate;
        if($validate == 2)
        {
            ////________Proceed
            if($cid > 0)
                {
                    /////________Update
                    if($formatOk == 1)
                         {
                            ////update with upload
                            $upload = upload_file($proposal_name,$proposal_temp,$upload_location);
                            if($upload == '0')
                                 {
                                     
                                  echo "<script>alert('Error uploading file')</script>";
                                
                                 }
                              else
                                 {
                                  ///////__________-Update  with proposal
                                     $update = updatedb('d_proposals',"proposal_upload='$upload',date_modified='$fulldate'","uid='$cid'");
                          
                                    if($update == 1)
                                            {
                                                
                                            echo "<script>alert('Proposal Document Added Successfully')</script>";
                                            
                                            }
                                        else
                                            {
                                                
                                                echo "<script>alert('Unable to Add Proposal Document')</script>";
                                            exit();
                                            }
                                 }
                            
                         }
                    else
                         {
                           ///some update statement will go here
                         }
                }
        }
    }       
   
?>
