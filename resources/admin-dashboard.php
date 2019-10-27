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
    <div class="small-box bg-green">
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
    <div class="small-box bg-blue">
      <div class="inner">
        <h4> <?php echo $total_courses; ?></h4>

        <p style="font-size: 18px">ACTIVE COURSES</p>

      </div>
      <div class="icon">
        <i class="fas fa-user-graduate"></i>
      </div>
      <a href="details?courses" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <h4> <?php echo $total_depatments; ?></h4>

        <p style="font-size: 18px">DEPARTMENTS</p>

      </div>
      <div class="icon">
        <i class="fas fa-book-reader"></i>
      </div>
      <a href="details?departments" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h4> <?php echo $total_schools; ?></h4>

        <p style="font-size: 18px">SCHOOLS/FACULTY</p>

      </div>
      <div class="icon">
        <i class="fas fa-school"></i>
      </div>
      <a href="details?faculties" class="small-box-footer">view <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-header bg-navy text-white">
        <p>System Users&emsp;</p>
      </div>
      <div class="card-body box-body">
        <table id="user_table" class="table table-bordered table-hover display table-responsive-lg">
          <thead class="bg-white">
            <tr>
              <th>First Name </th>
              <th>Last Name</th>
              <th>User Level</th>
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
<br />
