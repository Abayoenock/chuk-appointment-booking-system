<?php
include '../backend/db_conn.php';
$valid = array('success' => false, 'messages' => array());
$email = mysqli_escape_string($conn, $_POST['email']);
$password = md5(mysqli_escape_string($conn, $_POST['password']));
$sql = "SELECT * FROM `doctors` WHERE `password`='$password'  AND `email`='$email'";
$exe = $conn->query($sql);
if ($exe->num_rows == 0) {
    $valid['success'] = false;
    $valid['messages'] = " username or password wrong  ";
} else {
    while ($row = $exe->fetch_array()) {
        $id = $row['doctorID'];
        $status = $row['status'];
    }
    if ($status == 0) {
        $valid['success'] = false;
        $valid['messages'] = "Account has been suspended by the admin";
    } else {
        session_start();
        $_SESSION['docSession'] = $id;
        $valid['success'] = true;
        $valid['messages'] = " Login successful ";
    }
}


echo json_encode($valid);
