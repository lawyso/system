<div id="co_feedback"></div>
<!-- card -->
<div class="card">
  <div class="card-header">
    <?php
    $my_dept = fetchrow('d_users_primary', "uid='$myid'", "department");
    ?>
    <h5 class="mb-2 mb-sm-0 pt-1">
      <a href="#" target="_blank">Pending Defense Approvals</a>
      <span>/</span>
      <span>Lists</span>&emsp;<button class="btn btn-sm" style="background-color: rgb( 17, 122, 101);color: #ffff"><?php echo department($my_dept); ?></button>
    </h5>
  </div>
  <!--Card content-->
  <div class="card-body box-body">
    <table id="d_table" class="table table-bordered table-striped display table-responsive-lg">
      <thead>
        <tr class="bg-white">
          <th>D/No</th>
          <th>Project Title </th>
          <th>Defense By</th>
          <th>Proposed Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot style="background-color: #F0F0F0">

      </tfoot>
    </table>
    <script>
      $(document).ready(function() {
        var dataTable = $('#d_table').DataTable({
          "bprocessing": true,
          "serverSide": true,
          "ajax": {
            url: "resources/defense_list.php",
            type: "post"
          },
          "columnDefs": [{

              "render": function(data, type, row) {
                let rowID = row[4];
                return `<a href="details?defense=${ rowID }" title="View Details"><i class="fa fa-eye"></i></a>`
              },
              "targets": 4

            }

          ],
          "order": [
            [0, 'asc']
          ],

        });
      });
    </script>
  </div>
</div>
