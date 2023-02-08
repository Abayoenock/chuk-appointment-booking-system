<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array());
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);


if ($phoneNumber == "") {
    $valid['success'] = false;
    $valid['messages'] = "Please Enter phone number ! ";
} else {
    $sql = "SELECT * FROM `admin` WHERE (email='$email' OR phonNumber='$phoneNumber') AND adminID!='$userID'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $valid['success'] = false;
        $valid['messages'] = "A user with the that email or phone Number already exists";
    } else {

        $sql2 = "UPDATE `admin` SET `firstname`='$firstName',`lastname`='$lastName',`email`='$email',`phonNumber`='$phoneNumber' WHERE adminID='$userID'";
        if ($conn->query($sql2) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Profile  successfully updated  ";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while recording the data ";
        }
    }
}


echo json_encode($valid);
  // upload the file 
