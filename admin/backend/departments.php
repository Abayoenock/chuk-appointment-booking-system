<?php
include '../../backend/db_conn.php';
$output = array();

$sql = "SELECT * FROM department";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $output[] = $row;
}


echo json_encode($output);
