<div class="card">
  <div class="card-header">
    <p>Students in my Portfolio<a href="system_reports/supervisor_portfolio" target="_blank"><button class="btn btn-dms btn-sm">Generate Report</button></a></p>
  </div>
  <div class="card-body box-body">
    <div class="col-lg-12">
      <table id="student_table" class="table table-bordered table-hover display table-responsive-lg">
        <thead class="bg-white">
          <tr>
            <th>First Name </th>
            <th>Last Name</th>
            <th>Research Topic</th>
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
          var dataTable = $('#student_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
              url: "resources/student_list.php",
              type: "post"
            },
            "columnDefs": [{

              "render": function(data, type, row) {
                let rowID = row[4];
                return `<a href="student_details?student=${ rowID }"><i class="fa fa-eye"></i></a>`
              },
              "targets": 4

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
