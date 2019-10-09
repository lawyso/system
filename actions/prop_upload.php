<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$uploadDir = '../props/';
$response = array(
  'status' => 0,
  'message' => 'Form submission failed, please try again.'
);

// If form is submitted
if (isset($_POST['sid']) || isset($_POST['proposal_'])) {
  // Get the submitted form data

  $proposal_id = $_POST['sid'];

  // Check whether submitted data is not empty
  if (!empty($proposal_id)) {

    $uploadStatus = 1;

    // Upload file
    $uploadedFile = '';
    if (!empty($_FILES["proposal_"]["name"])) {

      // File path config
      $fileName = basename($_FILES["proposal_"]["name"]);
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      // Allow certain file formats
      $allowTypes = array('pdf', 'doc', 'docx');
      if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["proposal_"]["tmp_name"], $targetFilePath)) {
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
        $update = updatedb('d_proposals', "proposal_upload='$uploadedFile',date_modified='$fulldate'", "uid='$proposal_id'");

        if ($update == 1) {

          $proceed = 1;
          $response['status'] = 1;
          $response['message'] = 'Proposal Document Uploaded successfully';
        }
      }
    }
  } else {
    $response['message'] = 'Please fill all the mandatory fields';
  }
}

// Return response
echo json_encode($response);