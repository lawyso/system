<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$uploadDir = '../props/';
$rel_dir = 'props/';
$response = array(
  'status' => 0,
  'message' => 'Form submission failed, please try again.'
);
// If form is submitted
if (isset($_POST['sid']) || isset($_POST['document_']) || isset($_POST['directed_to'])) {
  // Get the submitted form data

  $upload_by = mysqli_real_escape_string($con, $_POST['sid']);
  $directed_to = mysqli_real_escape_string($con, $_POST['directed_to']);

  // Check whether submitted data is not empty
  if ((!empty($upload_by)) && (!empty($directed_to))) {

    $uploadStatus = 1;

    // Upload file
    $uploadedFile = '';
    if (!empty($_FILES["document_"]["name"])) {

      // File path config
      $fileName = basename($_FILES["document_"]["name"]);
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
      $rel_path = $rel_dir . $fileName;
      // Allow certain file formats
      $allowTypes = array('pdf', 'doc', 'docx');
      if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["document_"]["tmp_name"], $targetFilePath)) {
          $uploadedFile = $fileName;
        } else {
          $uploadStatus = 0;
          $response['message'] = 'Sorry, there was an error uploading your file.';
        }
      } else {
        $uploadStatus = 0;
        $response['message'] = 'Sorry, only PDF & DOC files are allowed to upload.';
      }

      if ($uploadStatus == 1) {
        $fds = array('filename', 'created_date', 'created_by', 'directed_to', 'upload_path');
        $vals = array("$uploadedFile", "$fulldate", "$upload_by", "$directed_to", "$rel_path");
        $create = addtodb('d_uploads', $fds, $vals);

        if ($create == 1) {

          $proceed = 1;
          $response['status'] = 1;
          $response['message'] = 'Document Uploaded successfully';
        }
      }
    }
  } else {
    $response['message'] = 'Please fill all the mandatory fields';
  }
}

// Return response
echo json_encode($response);
