<?php
include '../../backend/db_conn.php';
$output = array();
if (@$_GET['t'] == 'doctors') {
    $sql = "SELECT * FROM doctors as d INNER JOIN department AS dep on d.departmentID=dep.dept_ID";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $output[] = $row;
    }
}
if (@$_GET['t'] == 'recp') {
    $sql = "SELECT * FROM `receptionist` as r INNER JOIN department AS dep on r.departmentID=dep.dept_ID";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $output[] = $row;
    }
}
if (@$_GET['t'] == 'patients') {
    $sql = "SELECT * FROM `patients` ";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $output[] = $row;
    }
}
echo json_encode($output);
