 <!-- card -->
 <div class="card">
   <div class="card-header">

     <h5 class="mb-2 mb-sm-0 pt-1">
       <a href="#" target="_blank">Courses</a>
       <span>/</span>
       <span>Details</span>&emsp;<button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff">Add New Course</button>
     </h5>
   </div>

   <!--Card content-->
   <div class="card-body box-body">
     <table id="c_tbl" class="table table-bordered table-striped display table-responsive">
       <thead class="bg-white">
         <tr>
           <th>Course Name</th>
           <th>Department</th>
           <th>School</th>
           <th>Tenure(yrs)</th>
           <th>Status</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>

       </tbody>
       <tfoot>

       </tfoot>
     </table>
     <script>
       $(document).ready(function() {
         var dataTable = $('#c_tbl').DataTable({
           "processing": true,
           "serverSide": true,
           "ajax": {
             url: "resources/course_list.php",
             type: "post"
           },
           "columnDefs": [{

             "render": function(data, type, row) {
               let rowID = row[5];
               return `<a href="details?courses&edit-course=${ rowID }"><i class="fa fa-edit" title="Edit"></i></a> &nbsp;<a href="user_details?user=${ rowID }"><i class="fa fa-times text-red" title="Delete"></i></a>`
             },
             "targets": 5

           }],
           "order": [
             [5, 'asc']
           ],

         });
       });
     </script>
   </div>
 </div>
 <!-----------------------------------------------------Modal window ----------------!>

   <!-- Modal -->
 <?php
  $nostatus = 'SELECTED';
  $active = '';
  $inactive = '';
  if (isset($_GET['edit-course'])) {
    $esid = $_GET['edit-course'];
    $sid = decurl($esid);
    $sd = fetchonerow('d_courses', "uid='$sid'");
    $course_name = $sd['course_name'];
    $department_tag = $sd['department_tag'];
    $school_tag = $sd['school_tag'];
    $course_period = $sd['course_duration'];
    $status = $sd['status'];
    if ($status == 1) {
      $active = 'SELECTED';
    } elseif ($status == 0) {
      $inactive = 'SELECTED';
    } else {
      $nostatus = 'SELECTED';
    }
    $action = "Edit Course";
    $edi = 1;
  } else {
    $sid = 0;
    $action = "Add New Course";
  }

  ?>
 <!--/.Card-->
 <!-- Central Modal Large Info-->
 <div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md modal-notify" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
         <p class="heading lead"><?php echo $action; ?></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <!-- form start -->
         <form role="form" method="POST" onsubmit="return false;">
           <div class="box-body">
             <div class="form-group">
               <div class="form-group">
                 <label for=">Course Name">Course Name</label>
                 <input type="text" class="form-control" value="<?php echo $course_name; ?>" id="course_name" />
                 <input type="hidden" value="<?php echo $sid; ?>" id="sid" />
               </div>
               <div class="form-group">
                 <label for="user_group">Department</label>
                 <select class="form-control" id="department">
                   <option value="0">~Select~</option>
                   <?php
                    $dept = fetchtable('d_departments', "status=1", "department_name", "asc", "100000");
                    while ($d = mysqli_fetch_array($dept)) {
                      $uid = $d['uid'];
                      $dep_name = $d['department_name'];
                      if ($uid == $department_tag) {
                        $dselected = 'SELECTED';
                      } else {
                        $dselected = '';
                      }
                      echo "<option $dselected value=\"$uid\">$dep_name</option>";
                    }
                    ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="department">School/Faculty</label>
                 <select class="form-control" id="school">
                   <option value="0">~Select~</option>
                   <?php
                    $sch = fetchtable('d_schools', "status=1", "school_name", "asc", "10000");
                    while ($sc = mysqli_fetch_array($sch)) {
                      $uid = $sc['uid'];
                      $school_name = $sc['school_name'];
                      if ($uid == $school_tag) {
                        $scselected = 'SELECTED';
                      } else {
                        $scselected = '';
                      }
                      echo "<option $scselected value=\"$uid\">$school_name</option>";
                    }
                    ?>
                 </select>
               </div>
               <div class="form-group">
                 <label for="Course Durations">Course Durations</label>
                 <select class="form-control" id="course_duration">
                   <option value="0">~Select~</option>
                   <?php
                    $cduration = fetchtable('course_durations', "status=1", "uid", "asc", "10000");
                    while ($cd = mysqli_fetch_array($cduration)) {
                      $uid = $cd['uid'];
                      $duration_name = $cd['duration_name'];
                      if ($uid == $course_period) {
                        $cdselected = 'SELECTED';
                      } else {
                        $cdselected = '';
                      }
                      echo "<option $cdselected value=\"$uid\">$duration_name</option>";
                    }
                    ?>
                 </select>
               </div>
               <div class="form-group">
                 <label>Status</label>
                 <select id="course_status" class="form-control">
                   <option <?php echo $nostatus; ?> value="">~Select~</option>
                   <option <?php echo $active; ?> value="1">Active</option>
                   <option <?php echo $inactive; ?> value="0">Inactive</option>
                 </select>
               </div>

               <div id="cs_feedback"></div>

         </form>
       </div>

       <!--Footer-->
       <div class="modal-footer">

         <button type="submit" onclick="save_course();" class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff">Save</button>
         <i class="far fa-gem ml-1"></i>

         <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
           thanks</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Large Info-->
 <script>
   $('document').ready(function() {
     var edit = '<?php echo $edi; ?>';
     if (edit == '1') {
       $('#centralModalLGInfoDemo').modal('toggle');
     }
   });
 </script>
