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
        $usernames = $row['firstname'] . " " . $row['lastname'];
        $departmentID = $row['departmentID'];
    }
}

$task = mysqli_escape_string($conn, $_POST['task']);
$number = mysqli_escape_string($conn, $_POST['number']);
$timeTableID = mysqli_escape_string($conn, $_POST['timeTableID']);

$sql = "UPDATE `timetable` SET `numberOfPatients` = '$number' WHERE `timetable`.`timeTableID` = '$timeTableID'";
$exe = $conn->query($sql);
if ($exe) {
    $success = true;
} else {

    $success = false;
}
echo json_encode(array("success" => $success));
