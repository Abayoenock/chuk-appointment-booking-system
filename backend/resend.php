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
// to generate the OTP code
$otp = "";
$possible = "123456789";
$i = 0;
$length = 4;
while ($i < $length) {
    $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
    if (!strstr($otp, $char)) {
        $otp .= $char;
        $i++;
    }
}

$sql = "UPDATE `patients` SET `OTP` = '$otp' WHERE `patients`.`patientID` = '$userID'";
$exe = $conn->query($sql);
if ($exe) {
    $valid['success'] = true;
    $valid['messages'] = " A new code has been sent to   $phoneNumber ";
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
        CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello $usernames, your OTP IS :  $otp", 'action' => 'send-sms'),
        CURLOPT_HTTPHEADER => array(
            'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
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
