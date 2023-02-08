<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array());
$departmentName = mysqli_escape_string($conn, $_POST['departmentName']);
$description = mysqli_escape_string($conn, $_POST['description']);
$type = explode('.', $_FILES['user_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../img/department/' . $img1;
if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {
    $sql = "SELECT * FROM `department` WHERE departmentName='$departmentName'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $valid['success'] = false;
        $valid['messages'] = "A department with that name  already exists";
    } else {
        if (in_array($type, array('jpg', 'jpeg', 'png', 'PNG'))) {
            if (is_uploaded_file($_FILES['user_image']['tmp_name'])) {
                if (move_uploaded_file($_FILES['user_image']['tmp_name'], $url)) {
                    $tim = time();

                    $sql2 = "INSERT INTO `department`(`dept_ID`, `departmentName`, `departmentImage`, `departmentDescription`, `adminID`, `DdateCreated`) VALUES (null,'$departmentName','$img1','$description','$userID','$tim]')";
                    if ($conn->query($sql2) === TRUE) {
                        $valid['success'] = true;
                        $valid['messages'] = "department successfully registered  ";
                    } else {
                        $valid['success'] = false;
                        $valid['messages'] = "Error while recording the data ";
                    }
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }
            }
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Invalid profile image ! ";
        }
    }
}




echo json_encode($valid);
  // upload the file 
