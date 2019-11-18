<div class="card">
  <div class="card-header">
    <p>Registered Students And Respective Research Topics</p>
  </div>
  <div class="card-body box-body">
    <div class="col-lg-12">
      <table id="user_table" class="table table-bordered table-striped display table-responsive-lg">
        <thead>
          <tr class="bg-white">
            <th>First Name </th>
            <th>Last Name</th>
            <th>Research Topic</th>
            <th>Supervisor</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot style="background-color: #F0F0F0">

        </tfoot>
      </table>
    </div>
    <script>
      $(document).ready(function() {
        var dataTable = $('#user_table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "resources/regStudent_list.php",
            type: "post"
          },
          "columnDefs": [{

            "render": function(data, type, row) {
              let rowID = row[4];
              return `<a href="user_details?user=${ rowID }"><i class="fa fa-eye"></i></a>`
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
