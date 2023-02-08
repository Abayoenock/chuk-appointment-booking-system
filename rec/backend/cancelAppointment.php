<?php
include 'db_conn.php';
session_start();
$userID = $_SESSION['userSession'];
$sql = "SELECT * FROM patients WHERE patientID='$userID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $usernames = $row['firstname'] . " " . $row['lastname'];
    $phoneNumber = $row['phoneNumber'];
}
$valid = array('success' => false, 'messages' => array());

$id = $_GET['id'];
$sql = "SELECT * FROM appointments AS a INNER JOIN department as d on a.departmentID=d.dept_ID WHERE a.appointmentID='$id' ";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $appointmentDate = date("D d-m-Y", $row['appointmentDate']);
    $departmentName = $row['departmentName'];
}

$sql = "UPDATE `appointments` SET `appointmentStatus` = '1' WHERE `appointments`.`appointmentID` = '$id'";
$exe = $conn->query($sql);
if ($exe) {
    $valid['success'] = true;
    $valid['messages'] = " Your appointment was cancelled sucessfully ";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mista.io/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'SMS 250', 'unicode' => '0', 'sms' => "Hello $usernames, you have successfuly cancelled your appointment that you had on $appointmentDate in $departmentName  department ", 'action' => 'send-sms'),
        CURLOPT_HTTPHEADER => array(
            'x-api-key: a02c7aaa-48a7-974d-901d-d6476d221271-152d9ab3'
        ),
    ));
    $response = curl_exec($curl);
    //echo $response;
    curl_close($curl);
} else {

    $valid['success'] = false;
    $valid['messages'] = " An error occured    ";
}


echo json_encode($valid);
