<?php
include 'db_conn.php';
session_start();
$userID = $_SESSION['userSession'];
$valid = array('success' => false, 'messages' => array());
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$DOB = mysqli_escape_string($conn, $_POST['DOB']);
$nid = mysqli_escape_string($conn, $_POST['nid']);
$gender = mysqli_escape_string($conn, $_POST['gender']);
$nationality = mysqli_escape_string($conn, $_POST['nationality']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$insurance = mysqli_escape_string($conn, $_POST['insurance']);
$sql = "SELECT * FROM `patients` WHERE  phoneNumber='$phoneNumber' AND patientID!='$userID'";
$phoneOld = $_GET['p'];
$exe = $conn->query($sql);
if ($exe->num_rows > 0) {
    $valid['success'] = false;
    $valid['messages'] = "Account with that phone number already exists  ";
} else {

    if (preg_match("/^[a-zA-Z ]*$/", $phoneNumber)) {
        $valid['success'] = false;
        $valid['messages'] = "Phone number must not contain charachers and white spaces ";
    } else {
        $pn = substr($phoneNumber, 0, 3);
        if (!($pn == '078' || $pn == '072' || $pn == '073' || $pn == '079')) {
            $valid['success'] = false;
            $valid['messages'] = "Invalid first phone number , a valid phone number must start with [078,079,073 or 072 ] and must be 10 in total ";
        } else {
            if (strlen($phoneNumber) > 10 || strlen($phoneNumber) < 10) {
                $valid['success'] = false;
                $valid['messages'] = "Invalid  phone number , must be ten numbers  ";
            } else {
                if ($gender == 0) {
                    $valid['success'] = false;
                    $valid['messages'] = "Choose gender please ! ";
                } else {


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

                    $time = time();
                    if ($phoneNumber != $phoneOld) {
                        $status = 1;
                    } else {
                        $status = 2;
                    }


                    $sql = "UPDATE `patients` SET `firstname`='$firstName',`lastname`='$lastName',`gender`='$gender',`DOB`='$DOB',`phoneNumber`='$phoneNumber',`nationality`='$nationality',`nid`='$nid',`insurance`='$insurance',`OTP`='$otp',`status`='$status' WHERE patientID='$userID' ";
                    $exe = $conn->query($sql);
                    if ($exe == true) {
                        $valid['success'] = true;
                        $valid['messages'] = false;

                        if ($phoneNumber != $phoneOld) {
                            $valid['success'] = true;
                            $valid['messages'] = true;
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
                                CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello $firstName, you have changed your accouunt  phone number  your OTP IS :  $otp", 'action' => 'send-sms'),
                                CURLOPT_HTTPHEADER => array(
                                    'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                                ),
                            ));
                            $response = curl_exec($curl);
                            //echo $response;
                            curl_close($curl);
                        }
                    } else {
                        $valid['success'] = false;
                        $valid['messages'] = "An error occured while creating account please try again ";
                    }
                }
            }
        }
    }
}




echo json_encode($valid);
