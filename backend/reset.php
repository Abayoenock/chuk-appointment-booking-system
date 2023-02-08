<?php
include 'db_conn.php';
session_start();
if (@$_GET['t'] == "") {
    $phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
    $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        while ($row = $exe->fetch_array()) {
            $userID = $row['patientID'];
            $usernames = $row['firstname'] . " " . $row['lastname'];
            $phoneNumber = $row['phoneNumber'];
            $_SESSION['userSession'] = $userID;
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
            $valid['messages'] = " A verificastion code has been sent to   $phoneNumber ";
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
                CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello $usernames, your password reset verification code is  :  $otp", 'action' => 'send-sms'),
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
    } else {
        $valid['success'] = false;
        $valid['messages'] = " Your phone number was not found in our records !  ";
    }

    echo json_encode($valid);
} else {
    $userID = $_SESSION['userSession'];
    $valid = array('success' => false, 'messages' => array());
    $password = mysqli_escape_string($conn, $_POST['password']);
    $password_confirmation = mysqli_escape_string($conn, $_POST['password_confirmation']);
    if ($password != $password_confirmation) {
        $valid['success'] = false;
        $valid['messages'] = " The entered passwords do not match ! ";
    } else {
        $password = md5($password);
        $sql = "UPDATE `patients` SET `password` = '$password' WHERE `patients`.`patientID` = '$userID'";
        $exe = $conn->query($sql);
        if ($exe) {
            $valid['success'] = true;
            $valid['messages'] = " Password sucessfuly updated  ";
        } else {
            $valid['success'] = false;
            $valid['messages'] = " An error occured while updating the password   ";
        }
    }
    echo json_encode($valid);
}
