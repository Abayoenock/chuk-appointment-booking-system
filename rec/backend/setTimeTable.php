<?php
include '../backend/db_conn.php';
session_start();
if (!($_SESSION['recepSession'])) {
    header("Location: ./");
} else {
    $userID = $_SESSION['recepSession'];
    $sql = "SELECT * FROM receptionist WHERE recpID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $departmentID = $row['departmentID'];
    }
}
$valid = array('success' => false, 'messages' => array());
$date = $_GET['date'];
$doctor = mysqli_escape_string($conn, @$_POST['doctor']);
$number = mysqli_escape_string($conn, @$_POST['number']);
if ($doctor == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose doctor ";
} else {
    $time = time();
    $sql = "INSERT INTO `timetable`(`timeTableID`, `departmentID`, `doctorID`, `dateAvailable`, `numberOfPatients`, `timeTableStatus`, `setBy`, `TimeSet`) VALUES (null,'$departmentID','$doctor','$date','$number','1','$userID','$time')";
    $exe = $conn->query($sql);
    if ($exe) {
        $valid['success'] = true;
        $valid['messages'] = "A new record has been added to time table  ";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "An error occured please try again later ";
    }
}

echo json_encode($valid);
