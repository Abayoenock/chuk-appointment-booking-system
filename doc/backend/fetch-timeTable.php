<?php
session_start();
include '../backend/db_conn.php';
if (!($_SESSION['docSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['docSession'];
    $doctorID = $userID;
    $sql = "SELECT * FROM doctors WHERE doctorID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
        $departmentID = $row['departmentID'];
    }
}
$data = array();

$sql = "SELECT DISTINCT dateAvailable FROM `timetable` WHERE departmentID='$departmentID' AND doctorID='$userID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $time = $row['dateAvailable'];
    $sql2 = "SELECT * FROM timetable WHERE dateAvailable='$time' AND doctorID='$doctorID'";
    $exe2 = $conn->query($sql2);
    $num = $exe2->num_rows;
    $sql2 = "SELECT * FROM `appointments`  AS ap INNER JOIN appointmentapproval as app on ap.appointmentID=app.appointmentID  WHERE ap.appointmentStatus='1'     AND appointmentDate='$time' AND doctorID='$doctorID' AND app.appointmentApprove='1'";
    $exe2 = $conn->query($sql2);
    $num2 = $exe2->num_rows;


    $dates = date("m/d/Y", $time);
    $data[] = array("date" => $dates, "title" => $num, "pending" => $num2);
}
echo json_encode($data);
