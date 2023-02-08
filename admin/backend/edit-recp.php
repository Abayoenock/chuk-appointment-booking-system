<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array());
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$department = mysqli_escape_string($conn, $_POST['department']);
$recpID = $_GET['id'];

if ($phoneNumber == "") {
    $valid['success'] = false;
    $valid['messages'] = "Please Enter phone number ! ";
} else {
    $sql = "SELECT * FROM `receptionist` WHERE (email='$email' OR phoneNumber='$phoneNumber') AND recpID!='$recpID'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $valid['success'] = false;
        $valid['messages'] = "A user with the that email or phone Number already exists";
    } else {

        $sql2 = "UPDATE `receptionist` SET `firstname`='$firstName',`lastname`='$lastName',`email`='$email',`phoneNumber`='$phoneNumber',`departmentID`='$department' WHERE recpID='$recpID'";
        if ($conn->query($sql2) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Receptionist  successfully updated  ";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while recording the data ";
        }
    }
}


echo json_encode($valid);
  // upload the file 
