<!-- Central Modal Large Info-->
<div class="modal fade" id="centralModalLGInfoDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-notify" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="background-color: rgb( 17, 122, 101);color: #ffff">
        <p class="heading lead">Dissertation Documents Upload</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <!-- form start -->
        <form method="POST" enctype="multipart/form-data" id="fupForm">
          <div class="box-body">
            <div class="form-group">
              <div class="form-group">
                <input type="hidden" value="<?php echo $myid; ?>" id="sid" name="sid" />
                <input type="hidden" value="<?php echo $sid; ?>" id="directed_to" name="directed_to" />
              </div>
              <div class="statusMsg"></div>
              <div class="form-group">
                <label for="document upload">Document Upload</label>
                <input type="file" name="document_" class="form-control" id="document_" required>
              </div>
              <div id="prop_feedback"></div>
        </form>
      </div>

      <!--Footer-->
      <div class="modal-footer">
        <input type="submit" name="submit" class="btn btn-sm btn-dms submitBtn" value="Upload" />
        <i class="far fa-gem ml-1"></i>

        <a role="button" class="btn btn-sm waves-effect" data-dismiss="modal" style="color: rgb( 17, 122, 101)">No,
          thanks</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Large Info-->
