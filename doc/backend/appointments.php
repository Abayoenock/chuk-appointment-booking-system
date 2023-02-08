<?php
session_start();
include './db_conn.php';
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
$data = array();
$day = @$_GET['day'];
//$day = strtotime($day);
if (@$_GET['t'] == 'pending') {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID  WHERE a.appointmentStatus='0' AND a.departmentID='$departmentID' AND a.appointmentDate='$day' AND a.doctorID='$userID' ";
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
        $file = $row['patientFile'];
        $sql3 = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE  a.doctorID='$doctorID' AND apl.appointmentApprove='1'  AND a.appointmentDate='$day' AND a.doctorID='$userID'";
        $exe3 = $conn->query($sql3);
        $totalPatients = $exe3->num_rows;

        $sql3 = "SELECT * FROM `timetable`   WHERE  doctorID='$doctorID' AND  dateAvailable='$day' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $setPatients = $row3['numberOfPatients'];
        }
        $totalPatients = $setPatients - $totalPatients;
        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated, "totalPatients" => $totalPatients, "doctorNames" => $doctorNames, "appointmentID" => $appointmentID, "pfile" => $file);
    }
} else if (@$_GET['t'] == 'processed') {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID INNER JOIN appointmentapproval as appp on a.appointmentID=appp.appointmentID WHERE a.appointmentStatus='1' AND a.departmentID='$departmentID' AND a.appointmentDate='$day' AND appp.appointmentApprove='1' AND a.doctorID='$userID'";
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
        $file = $row['patientFile'];
        $sql3 = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE  a.doctorID='$doctorID' AND apl.appointmentApprove='1'  AND a.appointmentDate='$day'";
        $exe3 = $conn->query($sql3);
        $totalPatients = $exe3->num_rows;
        $sql3 = "SELECT * FROM `timetable`   WHERE  doctorID='$doctorID' AND  dateAvailable='$day'";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $setPatients = $row3['numberOfPatients'];
        }
        $totalPatients = $setPatients - $totalPatients;
        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated, "totalPatients" => $totalPatients, "doctorNames" => $doctorNames, "appointmentID" => $appointmentID, "approvalDate" => $approvalDate, "pfile" => $file);
    }
} else {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN patients as p on a.patientID=p.patientID INNER JOIN appointmentapproval as appp on a.appointmentID=appp.appointmentID WHERE a.appointmentStatus='1' AND a.departmentID='$departmentID' AND a.appointmentDate='$day'AND appp.appointmentApprove='0' AND a.doctorID='$userID' ";
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
        $file = $row['patientFile'];
        $sql3 = "SELECT * FROM `appointments` as a INNER JOIN  appointmentapproval as apl on apl.appointmentID=a.appointmentID   WHERE  a.doctorID='$doctorID' AND apl.appointmentApprove='0'  AND a.appointmentDate='$day'";
        $exe3 = $conn->query($sql3);
        $totalPatients = $exe3->num_rows;
        $sql3 = "SELECT * FROM `timetable`   WHERE  doctorID='$doctorID' AND  dateAvailable='$day'";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $setPatients = $row3['numberOfPatients'];
        }
        $totalPatients = $setPatients - $totalPatients;
        $sql3 = "SELECT * FROM `doctors` WHERE  doctorID='$doctorID' ";
        $exe3 = $conn->query($sql3);
        while ($row3 = $exe3->fetch_array()) {
            $doctorNames = $row3['title'] . ". " . $row3['firstname'] . " " . $row3['lastname'];
        }
        $data[] = array("patientNames" => $patientNames, "gender" => $gender, "phoneNumber" => $phoneNumber, "bod" => $bod, "appointmentDate" => $appointmentDate, "dateCreated" => $dateCreated, "totalPatients" => $totalPatients, "doctorNames" => $doctorNames, "appointmentID" => $appointmentID, "approvalDate" => $approvalDate, "pfile" => $file);
    }
}
echo json_encode($data);
