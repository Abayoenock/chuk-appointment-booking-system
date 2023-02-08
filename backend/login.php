<?php
include 'db_conn.php';
$valid = array('success' => false, 'messages' => array());
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$password = md5(mysqli_escape_string($conn, $_POST['password']));

$sql = "SELECT * FROM `patients` WHERE password='$password'  AND phoneNumber='$phoneNumber'";
$exe = $conn->query($sql);
if ($exe->num_rows == 0) {
    $valid['success'] = false;
    $valid['messages'] = " username or password wrong  ";
} else {

    while ($row = $exe->fetch_array()) {
        $id = $row['patientID'];
        $status = $row['status'];
    }

    if ($status == 0) {
        $valid['success'] = false;
        $valid['messages'] = " Account has been suspended by the admin";
    } elseif ($status == 1) {
        session_start();
        $_SESSION['userSession'] = $id;
        $valid['success'] = 'confirm';
        $valid['messages'] = " Confirm Your phone number ";
    } elseif ($status == 2) {
        session_start();
        $_SESSION['userSession'] = $id;

        $valid['success'] = true;
        $valid['messages'] = " Login successful ";
    }
}


echo json_encode($valid);
