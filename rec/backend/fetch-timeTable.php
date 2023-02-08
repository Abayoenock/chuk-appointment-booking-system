<?php
session_start();
include './db_conn.php';
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
$data = array();

$sql = "SELECT DISTINCT dateAvailable FROM `timetable` WHERE departmentID='$departmentID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $time = $row['dateAvailable'];
    $sql2 = "SELECT * FROM timetable WHERE dateAvailable='$time'";
    $exe2 = $conn->query($sql2);
    $num = $exe2->num_rows;
    $sql2 = "SELECT * FROM `appointments`  AS ap  WHERE ap.appointmentStatus='0' AND appointmentDate='$time'";
    $exe2 = $conn->query($sql2);
    $num2 = $exe2->num_rows;


    $dates = date("m/d/Y", $time);
    $data[] = array("date" => $dates, "title" => $num, "pending" => $num2);
}
echo json_encode($data);
