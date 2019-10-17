<?php
session_start();
include_once '../includes/conn.inc';
include_once '../includes/func.php';

$uploadDir = '../faces/';
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);

// If form is submitted
if (isset($_POST['sid']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['title']) || isset($_POST['phone_no'])) {
    // Get the submitted form data

    $sid = $_POST['sid'];
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);

    // Check whether submitted data is not empty
    if (!empty($first_name) && !empty($last_name) && !empty($title) && !empty($phone_no)) {

        $phoneOk = validate_phone($phone_no);
        if ($phoneOk == 0) {
            $response['message'] = 'Phone needed in the format 2547...';
        } else {
            $phoneExists = checkrowexists('d_users_primary', "primary_phone='$phone_no' AND uid!=$sid");
            if ($phoneExists == 1) {
                $response['message'] = 'Phone Number already exists';
            } else {
                $uploadStatus = 1;
                // Upload file
                $uploadedFile = '';
                if (!empty($_FILES["profile_"]["name"])) {
                    // File path config
                    $fileName = basename($_FILES["profile_"]["name"]);
                    $targetFilePath = $uploadDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    // Allow certain file formats
                    $allowTypes = array('jpg', 'png', 'jpeg');
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to the server
                        if (move_uploaded_file($_FILES["profile_"]["tmp_name"], $targetFilePath)) {
                            $uploadedFile = $fileName;
                        } else {
                            $uploadStatus = 0;
                            $response['message'] = 'Sorry, there was an error uploading your profile image.';
                        }
                    } else {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, only JPG, JPEG, & PNG files are allowed to upload.';
                    }
                    if ($uploadStatus == 1) {
                        $updatestring = "title='$title',first_name='$first_name', last_name='$last_name', primary_phone='$phone_no',profile_upload='$uploadedFile'";
                        $update = updatedb('d_users_primary', $updatestring, "uid='$sid'");
                        if ($update == 1) {
                            $proceed = 1;
                            $response['status'] = 1;
                            $response['message'] = 'Bio Details updated Successfuly';
                        } else {
                            $response['status'] = 0;
                            $response['message'] = 'Unable to Update the bio data.Try again later';
                        }
                    }
                } else {
                    $updatestring = "title='$title',first_name='$first_name', last_name='$last_name', primary_phone='$phone_no'";
                    $update = updatedb('d_users_primary', $updatestring, "uid='$sid'");
                    if ($update == 1) {
                        $proceed = 1;
                        $response['status'] = 1;
                        $response['message'] = 'Bio Details updated Successfuly';
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Unable to Update the bio data.Try again later';
                    }
                }
            }
        }
    } else {
        $response['status'] = 0;
        $response['message'] = 'Please fill all the mandatory fields';
    }
}

// Return response
echo json_encode($response);
