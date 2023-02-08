<?php
include 'db_conn.php';
session_start();
$userID = $_SESSION['userSession'];
$valid = array('success' => false, 'messages' => array());

$code = mysqli_escape_string($conn, $_POST['code']);

$sql = "SELECT * FROM `patients`WHERE  patientID='$userID'   AND OTP='$code'";
$exe = $conn->query($sql);
if ($exe->num_rows == 0) {
    $valid['success'] = false;
    $valid['messages'] = " Provided wrong confirmation code , please check again ";
} else {
    $sql = "UPDATE `patients` SET `status` = '2' WHERE `patients`.`patientID` = '$userID'";
    $exe = $conn->query($sql);
    if ($exe) {
        $valid['success'] = true;
        $valid['messages'] = " Your phone number has been verified successfuly ";
    } else {
        $valid['success'] = false;
        $valid['messages'] = " An error occured while verifying phone number ";
    }
}


echo json_encode($valid);
