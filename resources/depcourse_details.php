<div id="co_feedback"></div>
<!-- card -->
<div class="card">
  <div class="card-header">
    <?php
    $my_dept = fetchrow('d_users_primary', "uid='$myid'", "department");
    ?>
    <h5 class="mb-2 mb-sm-0 pt-1">
      <a href="#" target="_blank">Course</a>
      <span>/</span>
      <span>Details</span>&emsp;<button class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff"><?php echo department($my_dept); ?></button>
    </h5>
  </div>

  <!--Card content-->
  <div class="card-body box-body">
    <table id="cd_tbl" class="table table-bordered table-striped display table-responsive-lg">
      <thead class="bg-white">
        <tr>
          <th>Course Name</th>
          <th>Tenure(yrs)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot>

      </tfoot>
    </table>
    <script>
      $(document).ready(function() {
        var dataTable = $('#cd_tbl').DataTable({
          "processing": true,
          "serverSide": true,
          dom: 'Bfrtip',
          changeLength: true,
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          "ajax": {
            url: "resources/deptcourse_list.php",
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
