<?php
session_start();
include './db_conn.php';
$userID = $_SESSION['userSession'];
$data = array();
$departmentID = $_GET['id'];
$sql = "SELECT DISTINCT dateAvailable FROM `timetable` WHERE departmentID='$departmentID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $time = $row['dateAvailable'];
    $sql2 = "SELECT * FROM timetable WHERE dateAvailable='$time'";
    $exe2 = $conn->query($sql2);
    $num = $exe2->num_rows;
    $sql2 = "SELECT * FROM `appointments`  AS ap  INNER JOIN  `appointmentapproval` as a on a.appointmentID-ap.appointmentID  WHERE ap.appointmentDate='$time' AND a.appointmentApprove='1'";
    $exe2 = $conn->query($sql2);
    $num2 = $exe2->num_rows;


    $dates = date("m/d/Y", $time);
    $data[] = array("date" => $dates, "title" => $num, "Aproved" => $num2);
}
echo json_encode($data);
