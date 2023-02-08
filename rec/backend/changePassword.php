<?php
include 'db_conn.php';
session_start();
$id = $_SESSION['recepSession'];
$valid = array('success' => false, 'messages' => array());
$current = md5(mysqli_escape_string($conn, $_GET['o']));
$new = md5(mysqli_escape_string($conn, $_GET['n']));
$confirm = md5(mysqli_escape_string($conn, $_GET['c']));


$sql = "SELECT * FROM `receptionist` WHERE password='$current'  AND recpID='$id'";
$exe = $conn->query($sql);
if ($exe->num_rows == 0) {
    $valid['success'] = false;
    $valid['messages'] = " Incorrect current password ";
} else {
    if ($new === $confirm) {

        $sql = "UPDATE `receptionist` SET `password`='$new' WHERE recpID='$id'";
        if ($conn->query($sql) == true) {
            $valid['success'] = true;
            $valid['messages'] = " password successfuly updated ";
        } else {
            $valid['success'] = false;
            $valid['messages'] = " Failed please try again  !";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "The entered new passwords don't match ";
    }
}
echo json_encode($valid);
