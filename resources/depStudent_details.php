<div id="co_feedback"></div>
<!-- card -->
<div class="card">
  <div class="card-header">
    <?php
    $my_dept = fetchrow('d_users_primary', "uid='$myid'", "department");
    ?>
    <h5 class="mb-2 mb-sm-0 pt-1">
      <a href="#" target="_blank">Students</a>
      <span>/</span>
      <span>Details</span>&emsp;<button class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff"><?php echo department($my_dept); ?></button>
    </h5>
  </div>

  <!--Card content-->
  <div class="card-body box-body">
    <table id="std_tbl" class="table table-bordered table-striped display table-responsive-lg">
      <thead class="bg-white">
        <tr>
          <th>FirstName</th>
          <th>LastName</th>
          <th>Id No</th>
          <th>Gender</th>
          <th>Phone No</th>
          <th>Email Address</th>
          <th>Course</th>
          <th>Proposal Status</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <script>
      $(document).ready(function() {
        var dataTable = $('#std_tbl').DataTable({
          "processing": true,
          "serverSide": true,
          dom: 'Bfrtip',
          changeLength: true,
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          "ajax": {
            url: "resources/deptStudent_list.php",
            type: "post"
          },
          "order": [
            [0, 'asc']
          ],

        });
      });
    </script>
  </div>
</div>
