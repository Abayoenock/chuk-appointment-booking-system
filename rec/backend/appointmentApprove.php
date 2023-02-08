<?php
session_start();
include '../backend/db_conn.php';
if (!($_SESSION['recepSession'])) {
    header("Location: ./");
} else {
    $userID = $_SESSION['recepSession'];
    $sql = "SELECT * FROM receptionist WHERE recpID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
        $departmentID = $row['departmentID'];
    }
}
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$message = mysqli_escape_string($conn, $_POST['message']);
$task = mysqli_escape_string($conn, $_POST['task']);
$appointmentID = mysqli_escape_string($conn, $_POST['appointmentID']);
if ($task == 1) {
    $sql = "SELECT * FROM `appointments` WHERE appointmentID='$appointmentID'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $sql2 = "UPDATE `appointments` SET `appointmentStatus` = '1' WHERE `appointments`.`appointmentID` = '$appointmentID'";
        $exe2 = $conn->query($sql2);
        if ($exe2) {
            $time = time();
            $sql3 = "INSERT INTO `appointmentapproval`(`approvalID`, `appointmentID`, `message`, `appointmentApprove`, `receptionistID`, `smsSent`, `reminder`, `dateOfAction`) VALUES (null,'$appointmentID','$message','1','$userID','1','0','$time')";
            $exe3 = $conn->query($sql3);
            if ($exe3) {
                $success = true;
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
                    CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "$message", 'action' => 'send-sms'),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                    ),
                ));
                $response = curl_exec($curl);
                //echo $response;
                curl_close($curl);
            } else {
                $success = false;
            }
            echo json_encode(array("success" => $success, "phone" => $phoneNumber, "message" => $message));
        }
    }
}
if ($task == 0) {
    $sql = "SELECT * FROM `appointments` WHERE appointmentID='$appointmentID'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        $sql2 = "UPDATE `appointments` SET `appointmentStatus` = '1' WHERE `appointments`.`appointmentID` = '$appointmentID'";
        $exe2 = $conn->query($sql2);
        if ($exe2) {
            $time = time();
            $sql3 = "INSERT INTO `appointmentapproval`(`approvalID`, `appointmentID`, `message`, `appointmentApprove`, `receptionistID`, `smsSent`, `reminder`, `dateOfAction`) VALUES (null,'$appointmentID','$message','0','$userID','1','0','$time')";
            $exe3 = $conn->query($sql3);
            if ($exe3) {
                $success = true;
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
                    CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "$message", 'action' => 'send-sms'),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                    ),
                ));
                $response = curl_exec($curl);
                //echo $response;
                curl_close($curl);
            } else {
                $success = false;
            }
            echo json_encode(array("success" => $success, "phone" => $phoneNumber, "message" => $message));
        }
    }
}
if ($task == 2) {
    $time = time();
    $sql = "UPDATE `appointmentapproval` SET `appointmentApprove` = '0' WHERE `appointmentapproval`.`appointmentID` ='$appointmentID'";
    $exe = $conn->query($sql);
    if ($exe) {
        $success = true;
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
            CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "$message", 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
            ),
        ));
        $response = curl_exec($curl);
        //echo $response;
        curl_close($curl);
    } else {
        $success = false;
    }
    echo json_encode(array("success" => $success, "phone" => $phoneNumber, "message" => $message));
}
if ($task == 3) {
    $time = time();
    $sql = "UPDATE `appointmentapproval` SET `appointmentApprove` = '1' WHERE `appointmentapproval`.`appointmentID` ='$appointmentID'";
    $exe = $conn->query($sql);
    if ($exe) {
        $success = true;
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
            CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "$message", 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
            ),
        ));
        $response = curl_exec($curl);
        //echo $response;
        curl_close($curl);
    } else {
        $success = false;
    }
    echo json_encode(array("success" => $success, "phone" => $phoneNumber, "message" => $message));
}
