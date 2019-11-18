<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

// Get the submitted form data
$topic_id = mysqli_real_escape_string($con, decurl($_POST['sid']));
$topic_title = mysqli_real_escape_string($con, $_POST['topic_title']);

// Check whether submitted data is not empty
$topic_titleOk = input_length($topic_title, 10);
if ($topic_titleOk == 0) {
  die(errormes('Please fill the mandatory fields then submit the form again'));
  exit();
}
// check if the topic title already exist and published in global academia
$topicExists = checkrowexists('d_topics', "topic_name LIKE '%$topic_title%' AND status ='3'");
if ($topicExists == 1) {
  echo errormes('Research Topic Already Exists in the global Academia Library. Try another research topic');
} else {

  //check if the topic already been registered for research
  $topicRegistered = checkrowexists('d_topics', "topic_name LIKE '%$topic_title%' AND status in (0,1) AND topic_id !='$topic_id'");
  if ($topicRegistered == 1) {
    echo errormes('Whoops!!! Research Topic Already Registered for Research by other parties.');
  } else {

    // check if the topic had already been submitted and rejected by the same user
    $topicRejected = checkrowexists('d_topics', "topic_name LIKE '%$topic_title%' AND status='2' AND created_by='$myid'");
    if ($topicRejected == 1) {
      echo errormes('Whoops!!! This Research Topic had Already been rejected before.');
    } else {
      if ($topic_id > 0) {
        // update the research topic before approval
        $update = updatedb('d_topics', "topic_name='$topic_title'", "topic_id='$topic_id'");

        if ($update == 1) {
          echo sucmes('Research Topic Updated Successfully');
          $refresh = 1;
        } else {
          echo errormes('Unable To update The Research Topic');
        }
      } else {
        // Create new Research topic entry
        $fds = array('topic_name', 'created_date', 'created_by');
        $vals = array("$topic_title", "$fulldate", "$myid");
        $create = addtodb('d_topics', $fds, $vals);

        if ($create == 1) {
          $refresh = 1;
          echo sucmes('Your comment has been saved and submitted successfully');
        } else {
          echo errormes('Comment could not be saved at the moment,try later.');
        }
      }
    }
  }
}
?>
<script>
  var proceed = '<?php echo $refresh; ?>';
  if (proceed == '1') {
    setTimeout(function() {
      window.location = 'register';
    }, 3000);

  }
</script>
