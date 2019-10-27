<div id="dept_feedback"></div>
<!-- card -->
<div class="card">
  <div class="card-header">

    <h5 class="mb-2 mb-sm-0 pt-1">
      <a href="#" target="_blank">Departments</a>
      <span>/</span>
      <span>Details</span>&emsp;<button class="btn btn-sm" data-toggle="modal" data-target="#centralModalLGInfoDemo" style="background-color: rgb( 17, 122, 101);color: #ffff">Add New Department</button>
    </h5>
  </div>

  <!--Card content-->
  <div class="card-body box-body">
    <table id="d_tbl" class="table table-bordered table-striped display table-responsive-lg">
      <thead class="bg-white">
        <tr>
          <th>Department Name</th>
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
        var dataTable = $('#d_tbl').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "resources/department_list.php",
            type: "post"
          },
          "columnDefs": [{

            "render": function(data, type, row) {
              let rowID = row[2];
              return `<a href="details?departments&edit-department=${ rowID }" title="Edit"><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>&emsp;Edit</button></a><button onclick=\"del_dept('${ rowID }')\" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i>&emsp;DELETE</button>`
            },
            "targets": 2

          }],
          "order": [
            [0, 'asc']
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
if (isset($_GET['edit-department'])) {
  $esid = $_GET['edit-department'];
  $sid = decurl($esid);
  $sd = fetchonerow('d_departments', "uid='$sid'");
  $department_name = $sd['department_name'];
  $status = $sd['status'];
  if ($status == 1) {
    $active = 'SELECTED';
  } elseif ($status == 2) {
    $inactive = 'SELECTED';
  } else {
    $nostatus = 'SELECTED';
  }
  $action = "Edit Department";
  $edi = 1;
} else {
  $sid = 0;
  $action = "Add New Department";
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
                <label for=">Department Name<">Department Name</label>
                <input type="text" class="form-control" value="<?php echo $department_name; ?>" id="department_name" auto-complete="off" />
                <input type="hidden" value="<?php echo $sid; ?>" id="sid" />
              </div>
              <div class="form-group">
                <label>Status</label>
                <select id="dept_status" class="form-control">
                  <option <?php echo $nostatus; ?> value="0">~Select~</option>
                  <option <?php echo $active; ?> value="1">Active</option>
                  <option <?php echo $inactive; ?> value="2">Inactive</option>
                </select>
              </div>

              <div id="dp_feedback"></div>

        </form>
      </div>

      <!--Footer-->
      <div class="modal-footer">

        <button type="submit" onclick="save_dept();" class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff">Save</button>
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
