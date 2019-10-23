<?php
$total_users = countotal('d_users_primary', "uid>0 AND status in (1,2,3,4)");
$total_courses = countotal('d_courses', "uid>0 AND status='1'");
$total_depatments = countotal('d_departments', "uid>0 AND status='1'");
$total_schools = countotal('d_schools', "uid>0 AND status='1'");
$total_deleted_proposal = countotal('d_proposals', "user='$myid' AND status='5'");
$total_approved_defense = countotal('d_defense', "user='$myid' AND status='1'");
$total_approved_defense = countotal('d_defense', "user='$myid' AND status='3'");
?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h4> <?php echo $total_users; ?></h4>

        <p style="font-size: 18px">USERS</p>

      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="settings" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <p> <?php echo $total_courses; ?></p>

        <p style="font-size: 18px">ACTIVE COURSES</p>

      </div>
      <div class="icon">
        <i class="fas fa-user-graduate"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-olive">
      <div class="inner">
        <p> <?php echo $total_depatments; ?></p>

        <p style="font-size: 18px">DEPARTMENTS</p>

      </div>
      <div class="icon">
        <i class="fas fa-book-reader"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <p> <?php echo $total_schools; ?></p>

        <p style="font-size: 18px">SCHOOLS/FACULTY</p>

      </div>
      <div class="icon">
        <i class="fas fa-school"></i>
      </div>
      <a href="#" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="card-header bg-primary">
        <p>User List&emsp;</p>
      </div>
      <div class="card-body">
        <table id="user_table" class="table table-bordered table-striped display table-responsive">
          <thead style="background-color: #F0F0F0">
            <tr>
              <th>First Name </th>
              <th>Last Name</th>
              <th>Mobile Number</th>
              <th>Id Number</th>
              <th>Email Address</th>
              <th>Username</th>
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
            var dataTable = $('#user_table').DataTable({
              "processing": true,
              "serverSide": true,
              "pageLength": 5,
              "ajax": {
                url: "resources/user_list.php",
                type: "post"
              },
              "columnDefs": [{

                "render": function(data, type, row) {
                  let rowID = row[6];
                  return `<a href="user_details?user=${ rowID }"><i class="fa fa-eye"></i></a>`
                },
                "targets": 6

              }],
              "order": [
                [0, 'asc']
              ],

            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-header bg-purple">
        <p>DEPARTMENTS</p>
      </div>
      <div class="card-body">
        <table id="dep_tbl" class="table table-bordered table-striped display table-responsive">
          <thead style="background-color: #F0F0F0">
            <tr>
              <th>#</th>
              <th>DEPARTMENT</th>
              <th>STATUS</th>
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
            var dataTable = $('#dep_tbl').DataTable({
              "processing": true,
              "serverSide": true,
              "pageLength": 4,
              "ajax": {
                url: "resources/department_list.php",
                type: "post"
              },
              "columnDefs": [{

                "render": function(data, type, row) {
                  let rowID = row[3];
                  return `<a href="user_details?user=${ rowID }"><i class="fa fa-eye"></i></a>`
                },
                "targets": 3

              }],
              "order": [
                [0, 'asc']
              ],

            });
          });
        </script>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="card">
      <div class="card-header bg-fuchsia">
        <p>SCHOOLS /FACULTIES</p>
      </div>
      <div class="card-body">
        <table id="sch_tbl" class="table table-bordered table-striped display table-responsive">
          <thead style="background-color: #F0F0F0">
            <tr>
              <th>#</th>
              <th>SCHOOL/FACULTY</th>
              <th>STATUS</th>
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
            var dataTable = $('#sch_tbl').DataTable({
              "processing": true,
              "serverSide": true,
              "pageLength": 5,
              "ajax": {
                url: "resources/school_list.php",
                type: "post"
              },
              "columnDefs": [{

                "render": function(data, type, row) {
                  let rowID = row[3];
                  return `<a href="user_details?user=${ rowID }"><i class="fa fa-eye"></i></a>`
                },
                "targets": 3

              }],
              "order": [
                [0, 'asc']
              ],

            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
