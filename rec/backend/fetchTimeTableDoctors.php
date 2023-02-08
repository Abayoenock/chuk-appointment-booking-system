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
$date = $_GET['day'];
$sql = "SELECT * FROM `timetable` as t INNER JOIN doctors as d on t.doctorID=d.doctorID WHERE t.dateAvailable='$date' AND t.departmentID='$departmentID'";
$out = array();
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $doctor = $row['title'] . " ." . $row['firstname'] . " " . $row['lastname'];
    $timeTableId = $row['timeTableID'];
    $numberSet = $row['numberOfPatients'];
    $out[] = array("doctorNames" => $doctor, "numberSet" => $numberSet, "timeTableId" => $timeTableId);
}
echo json_encode($out);
