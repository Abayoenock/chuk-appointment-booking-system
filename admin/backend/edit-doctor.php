<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array());
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$email = mysqli_escape_string($conn, $_POST['email']);
$title = mysqli_escape_string($conn, $_POST['title']);
$specialization = mysqli_escape_string($conn, $_POST['specialization']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$department = mysqli_escape_string($conn, $_POST['department']);
$doctorID = $_GET['id'];
if ($phoneNumber == "") {
    $valid['success'] = false;
    $valid['messages'] = "Please Enter phone number ! ";
} else {
    $sql = "SELECT * FROM `doctors` WHERE (email='$email' OR phoneNumber='$phoneNumber') AND doctorID!='$doctorID'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $valid['success'] = false;
        $valid['messages'] = "A user with the that email or phone Number already exists";
    } else {


        $sql2 = "UPDATE `doctors` SET `firstname`='$firstName',`lastname`='$lastName',`specialization`='$specialization',`title`='$title',`departmentID`='$department',`email`='$email',`phoneNumber`='$phoneNumber' WHERE doctorID='$doctorID'";
        if ($conn->query($sql2) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Doctor successfully updated ";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while recording the data ";
        }
    }
}

echo json_encode($valid);
  // upload the file 
