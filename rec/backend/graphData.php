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
        // $usernames = $row['firstname'] . " " . $row['lastname'];
        $departmentID = $row['departmentID'];
    }
}
if (@$_GET['t'] == 'year') {
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
            $end = strtotime("01-01-" . ($d + 1));
        }
        $month = date("M", $start);
        $declined = 0;
        $approved = 0;

        $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' AND a.departmentID='$departmentID'";
        $exe = $conn->query($sql);
        $declined = $exe->num_rows;
        $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' AND a.departmentID='$departmentID'";
        $exe = $conn->query($sql);
        $approved = $exe->num_rows;

        $chart_data[] = array("declined" => $declined, "approved" => $approved, "label" => $month);


        $i += 1;
        $j += 1;
        $k++;
    }
    echo json_encode($chart_data);
} else {

    $d = $_GET['year'];
    $m = $_GET['month'];
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

        $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='0' AND a.departmentID='$departmentID'";
        $exe = $conn->query($sql);
        $declined = $exe->num_rows;
        $sql = "SELECT * FROM `appointments` as a INNER JOIN appointmentapproval as ap on a.appointmentID=ap.appointmentID WHERE  a.appointmentDate>='$start' AND a.appointmentDate <= '$end' AND `appointmentApprove`='1' AND a.departmentID='$departmentID'";
        $exe = $conn->query($sql);
        $approved = $exe->num_rows;

        $chart_data[] = array("declined" => $declined, "approved" => $approved, "label" => $month);


        $i += 1;
        $j += 1;
        $k++;
    }
    echo json_encode($chart_data);
}
