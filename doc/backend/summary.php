<?php
session_start();
include '../backend/db_conn.php';

if (!($_SESSION['docSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['docSession'];

    $sql = "SELECT * FROM doctors WHERE doctorID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
        $departmentID = $row['departmentID'];
    }
}
$sql = "SELECT * FROM `doctors` WHERE departmentID='$departmentID'";
$exe = $conn->query($sql);
$doctors = $exe->num_rows;
$today = strtotime("today");
$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='0'  AND a.appointmentDate<'$today' AND a.departmentID='$departmentID' AND a.doctorID='$userID' ";
$exe = $conn->query($sql);
$processed_cancel = $exe->num_rows;
$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='1'  AND a.appointmentDate<'$today'  AND a.departmentID='$departmentID' AND a.doctorID='$userID' ";
$exe = $conn->query($sql);
$processed_confirmed = $exe->num_rows;
$tommorrow = strtotime("tomorrow");


$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='0'  AND a.appointmentDate>='$tommorrow'  AND a.departmentID='$departmentID' AND a.doctorID='$userID'";
$exe = $conn->query($sql);
$upcomming_cancel = $exe->num_rows;
$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='1'  AND a.appointmentDate>='$tommorrow'  AND a.departmentID='$departmentID' AND a.doctorID='$userID'";
$exe = $conn->query($sql);
$upcomming_confirmed = $exe->num_rows;
$sql = "SELECT * FROM `appointments`   WHERE   appointmentStatus='0'  AND  appointmentDate >='$tommorrow'  AND departmentID='$departmentID'AND doctorID='$userID'";
$exe = $conn->query($sql);
$upcomming_pending = $exe->num_rows;

$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='0'  AND a.appointmentDate='$today'  AND a.departmentID='$departmentID' AND a.doctorID='$userID'";
$exe = $conn->query($sql);
$today_cancel = $exe->num_rows;

$sql = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE   apl.appointmentApprove='1'   AND a.appointmentDate='$today'  AND a.departmentID='$departmentID' AND a.doctorID='$userID'";
$exe = $conn->query($sql);
$today_confirmed = $exe->num_rows;

echo json_encode(array("doctors" => $doctors, "processed_cancel" => $processed_cancel, "processed_confirmed" => $processed_confirmed, "upcomming_cancel" => $upcomming_cancel, "upcomming_confirmed" => $upcomming_confirmed, "today_cancel" => $today_cancel, "today_confirmed" => $today_confirmed, "upcomming_pending" => $upcomming_pending));
