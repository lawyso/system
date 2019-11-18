<?php
$sid = $myid;
$sd = fetchonerow('d_users_primary', "uid='$sid'");
$first_name = $sd['first_name'];
$last_name = $sd['last_name'];
$title = $sd['title'];
$topic = $sd['topic_id'];
$topic_name = fetchrow('d_topics', "topic_id='$title'", "topic_name");
$title_name = fetchrow('d_title', "uid='$title'", "name");
$reg_no = $sd['Reg_No'];
$user_group = $sd['user_group'];
$group_name = fetchrow('d_user_groups', "uid='$user_group'", "group_name");
$totalStudents = countotal('d_users_primary', "supervisor_id='$myid'");
?>
<div class="row">
  <div class="col-lg-12">
    <div class="card-header bg-warning">
      <?php echo $group_name; ?>'s Profile
    </div>
    <table class="table table-user-information table-striped table-bordered" style="font-weight:bold">
      <tbody>
        <tr>
          <td><b>Name:</b></td>
          <td><b><?php echo $title_name . ' ' . $first_name . ' ' . $last_name;  ?></b>
          </td>
        </tr>
        <tr>
          <td><b>Staff Id Number:</b></td>
          <td><b><?php echo $reg_no; ?></b></td>
        </tr>
        <tr>
          <td><b>Students Assigned:</b></td>
          <td><b><?php echo $totalStudents; ?></b></td>
        </tr>
      </tbody>
    </table>
    <br />
    <div class="card-header bg-info">
      My Students
    </div>
    <br />
    <table id="student_table" class="table table-bordered table-hover display table-responsive-lg">
      <thead class="bg-white">
        <tr>
          <th>First Name </th>
          <th>Last Name</th>
          <th>Research Topic</th>
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
        var dataTable = $('#student_table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "resources/student_list.php",
            type: "post"
          },
          "columnDefs": [{

            "render": function(data, type, row) {
              let rowID = row[3];
              return `<a href="student_details?student=${ rowID }"><i class="fa fa-eye"></i></a>`
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
