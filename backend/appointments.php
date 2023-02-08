<?php
session_start();
include './db_conn.php';
$userID = $_SESSION['userSession'];
$data = array();
if ($_GET['t'] == 'pending') {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN department as d on a.departmentID=d.dept_ID INNER JOIN doctors as dc on a.doctorID=dc.doctorID  WHERE a.appointmentStatus='0' AND patientID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $data[] = $row;
    }
} else {
    $sql = "SELECT * FROM `appointments` as a INNER JOIN department as d on a.departmentID=d.dept_ID INNER JOIN doctors as dc on a.doctorID=dc.doctorID INNER JOIN appointmentapproval as apl on apl.appointmentID=a.appointmentID WHERE  patientID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $data[] = $row;
    }
}
echo json_encode($data);
