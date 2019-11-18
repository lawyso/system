<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$response = array(
  'status' => 0,
  'message' => 'Comment submission failed, please try again.'
);
// If form is submitted
if (isset($_POST['sid']) || isset($_POST['comment_']) || isset($_POST['directed_to'])) {
  // Get the submitted form data

  $comment_by = mysqli_real_escape_string($con, $_POST['sid']);
  $comment = mysqli_real_escape_string($con, $_POST['comment_']);
  $directed_to = mysqli_real_escape_string($con, $_POST['directed_to']);

  // Check whether submitted data is not empty
  if ((!empty($comment_by)) && (input_length($comment, 10)) && (!empty($directed_to))) {

    $fds = array('comment', 'created_date', 'created_by', 'directed_to');
    $vals = array("$comment", "$fulldate", "$comment_by", "$directed_to");
    $create = addtodb('d_comments', $fds, $vals);

    if ($create == 1) {
      $response['status'] = 1;
      $response['message'] = 'Your comment has been saved and submitted successfully';
    } else {
      $response['status'] = 0;
      $response['message'] = 'Comment could not be saved at the moment,try again later.';
    }
  } else {
    $response['status'] = 0;
    $response['message'] = 'Please fill the mandatory fields then submit the form again';
  }
}

// Return response
echo json_encode($response);
