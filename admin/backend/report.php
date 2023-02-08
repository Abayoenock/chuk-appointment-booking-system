<?php
session_start();
include './db_conn.php';
if (!($_SESSION['adminSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['adminSession'];

    $sql = "SELECT * FROM admin WHERE adminID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
    }
}
$data = array();
$day = @$_GET['date'];
$day = strtotime($day);
if (@$_GET['t'] == 'pending') {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID  WHERE a.appointmentStatus='0'  AND a.appointmentDate='$day' AND a.doctorID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $appointmentID = $row['appointmentID'];
        $patientNames = $row['firstname'] . " " . $row['lastname'];
        $gender = $row['gender'];
        $phoneNumber = $row['phoneNumber'];
        $bod = $row['DOB'];
        $appointmentDate = $row['appointmentDate'];
        $dateCreated = $row['dateCreated'];
        $doctorID = $row['doctorID'];
        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated,  "doctorNames" => $doctorNames, "appointmentID" => $appointmentID);
    }
} else if (@$_GET['t'] == 'processed') {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID INNER JOIN appointmentapproval as appp on a.appointmentID=appp.appointmentID WHERE a.appointmentStatus='1'   AND appp.appointmentApprove='1' AND a.appointmentDate='$day' ";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $appointmentID = $row['appointmentID'];
        $patientNames = $row['firstname'] . " " . $row['lastname'];
        $gender = $row['gender'];
        $phoneNumber = $row['phoneNumber'];
        $bod = $row['DOB'];
        $appointmentDate = $row['appointmentDate'];
        $dateCreated = $row['dateCreated'];
        $doctorID = $row['doctorID'];
        $appointmentapproval = $row['appointmentApprove'];
        $approvalDate = $row['dateOfAction'];


        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated, "doctorNames" => $doctorNames, "appointmentID" => $appointmentID, "approvalDate" => $approvalDate);
    }
} else {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID INNER JOIN appointmentapproval as appp on a.appointmentID=appp.appointmentID WHERE a.appointmentStatus='1'  AND appp.appointmentApprove='0' AND a.appointmentDate='$day' ";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $appointmentID = $row['appointmentID'];
        $patientNames = $row['firstname'] . " " . $row['lastname'];
        $gender = $row['gender'];
        $phoneNumber = $row['phoneNumber'];
        $bod = $row['DOB'];
        $appointmentDate = $row['appointmentDate'];
        $dateCreated = $row['dateCreated'];
        $doctorID = $row['doctorID'];
        $appointmentapproval = $row['appointmentApprove'];
        $approvalDate = $row['dateOfAction'];
        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated,  "doctorNames" => $doctorNames, "appointmentID" => $appointmentID, "approvalDate" => $approvalDate);
    }
}
echo json_encode($data);
