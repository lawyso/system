<div id="topic_feedback"></div>
<div class="card">
  <div class="card-header">
    <p>Rejected students' Research topics</p>
  </div>
  <div class="card-body box-body">
    <div class="col-lg-12">
      <table id="tp_table" class="table table-bordered table-striped display table-responsive-lg">
        <thead>
          <tr class="bg-white">
            <th>Student Name </th>
            <th>Research Topic</th>
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
        var dataTable = $('#tp_table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "resources/rejectedTopic_list.php",
            type: "post"
          },
          "columnDefs": [{

            "render": function(data, type, row) {
              let rowID = row[2];
              return `<button onclick=\"approve_topic('${ rowID }')\" title="Approve Research Topic" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>&nbsp;Approve</button><button onclick=\"del_topic('${ rowID }')\" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i>&emsp;DELETE</button>`
            },
            "targets": 2

          }],
          "order": [
            [1, 'asc']
          ],

        });
      });
    </script>
  </div>
</div>
