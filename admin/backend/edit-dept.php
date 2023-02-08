<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array());
$departmentName = mysqli_escape_string($conn, $_POST['departmentName']);
$description = mysqli_escape_string($conn, $_POST['description']);
$departmentID = $_GET['id'];
$sql = "SELECT * FROM `department` WHERE departmentName='$departmentName' AND dept_ID !='$departmentID'";
$exe = $conn->query($sql);
if ($exe->num_rows > 0) {
    $valid['success'] = false;
    $valid['messages'] = "A department with that name  already exists";
} else {


    $sql2 = "UPDATE `department` SET `departmentName`='$departmentName',`departmentDescription`='$description' WHERE  dept_ID='$departmentID'";
    if ($conn->query($sql2) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "department successfully updated  ";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while recording the data ";
    }
}

echo json_encode($valid);
  // upload the file 
