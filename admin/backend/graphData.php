<?php
session_start();
include './db_conn.php';
if (!($_SESSION['adminSession'])) {
    header("Location: ./");
}
if (@$_GET['t'] == 'department') {
    $d = $_GET['year'];
    $xx = 12;
    if ($d == date('Y')) {
        $xx = date('m');
    }
    $i = 1;
    $j = 12;
    $chart_data = array();
    $start = strtotime("01-" . $i . "-" . $d);
    $d = (int)$d;
    $end = strtotime("01-01-" . ($d + 1));

    $sql = "SELECT * FROM department";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $sql2 = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' AND a.departmentID='" . $row['dept_ID'] . "' ";
        $exe2 = $conn->query($sql2);
        $value = $exe2->num_rows;
        $chart_data[] = array("label" => $row['departmentName'], "value" => $value);
    }



    echo json_encode($chart_data);
}
if (@$_GET['t'] == 'users') {

    $d = $_GET['year'];
    $xx = 12;
    if ($d == date('Y')) {
        $xx = date('m');
    }
    $i = 1;
    $j = 2;
    $chart_data = array();
    $k = 1;
    while ($k <= $xx) {
        $start = strtotime("01-" . $i . "-" . $d);
        $end = strtotime("01-" . $j . "-" . $d);
        if ($k == 12) {
            $d = (int)$d;
            $end = strtotime("01-01-" . ($d + 1));
        }
        $month = date("M", $start);
        $doctors = 0;
        $patients = 0;
        $receptionists = 0;
        $approved = 0;

        $sql = "SELECT * FROM `doctors` WHERE  dateAddded >='$start' AND dateAddded <= '$end' ";
        $exe = $conn->query($sql);
        $doctors = $exe->num_rows;
        $sql = "SELECT * FROM `patients` WHERE  dateOfRegistration >='$start' AND dateOfRegistration <= '$end' ";
        $exe = $conn->query($sql);
        $patients = $exe->num_rows;
        $sql = "SELECT * FROM `receptionist` WHERE  recpDateAdded >='$start' AND recpDateAdded <= '$end' ";
        $exe = $conn->query($sql);
        $receptionists = $exe->num_rows;

        $chart_data[] = array("doctors" => $doctors, "patients" => $patients, "receptionists" => $receptionists, "label" => $month);


        $i += 1;
        $j += 1;
        $k++;
    }
    echo json_encode($chart_data);
}
if (@$_GET['t'] == 'year') {
    $departmentID = $_GET['dep'];
    $d = $_GET['year'];
    $xx = 12;
    if ($d == date('Y')) {
        $xx = date('m');
    }
    $i = 1;
    $j = 2;
    $chart_data = array();
    $k = 1;
    while ($k <= $xx) {
        $start = strtotime("01-" . $i . "-" . $d);
        $end = strtotime("01-" . $j . "-" . $d);
        if ($k == 12) {
            $d = (int)$d;
            $end = strtotime("01-01-" . ($d + 1));
        }
        $month = date("M", $start);
        $declined = 0;
        $approved = 0;
        if ($departmentID == 0) {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' ";
        } else {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' AND a.departmentID='$departmentID'  ";
        }

        $exe = $conn->query($sql);
        $declined = $exe->num_rows;
        if ($departmentID == 0) {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1'  ";
        } else {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' AND a.departmentID='$departmentID' ";
        }

        $exe = $conn->query($sql);
        $approved = $exe->num_rows;

        $chart_data[] = array("declined" => $declined, "approved" => $approved, "label" => $month);


        $i += 1;
        $j += 1;
        $k++;
    }
    echo json_encode($chart_data);
} elseif (@$_GET['t'] == 'month') {

    $d = $_GET['year'];
    $m = $_GET['month'];
    $departmentID = $_GET['dep'];
    $xx = cal_days_in_month(CAL_GREGORIAN, $m, $d);;
    // if ($d == date('Y') && $m = date('m')) {
    //     $xx = date('d') + 1;
    // }
    $i = 1;
    $j = 2;
    $chart_data = array();
    $k = 1;
    while ($k <= $xx) {
        $start = strtotime($i . "-" . $m . "-" . $d);
        $end = strtotime($j . "-" . $m . "-" . $d);
        $month = date("d-M", $start);
        $declined = 0;
        $approved = 0;
        if ($departmentID == 0) {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' ";
        } else {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' AND a.departmentID='$departmentID' ";
        }

        $exe = $conn->query($sql);
        $declined = $exe->num_rows;
        if ($departmentID == 0) {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' ";
        } else {
            $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' AND a.departmentID='$departmentID'";
        }
        $exe = $conn->query($sql);
        $approved = $exe->num_rows;

        $chart_data[] = array("declined" => $declined, "approved" => $approved, "label" => $month);


        $i += 1;
        $j += 1;
        $k++;
    }
    echo json_encode($chart_data);
}
