<?php
include 'db_conn.php';
$valid = array('success' => false, 'messages' => array(), "phoneNumber" => "", "sendSms" => "");
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$DOB = mysqli_escape_string($conn, $_POST['DOB']);
$nid = mysqli_escape_string($conn, $_POST['nid']);
$gender = mysqli_escape_string($conn, $_POST['gender']);
$nationality = mysqli_escape_string($conn, $_POST['nationality']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$insurance = mysqli_escape_string($conn, $_POST['insurance']);
$password = mysqli_escape_string($conn, $_POST['password']);
$password_confirmation = mysqli_escape_string($conn, $_POST['password_confirmation']);
$sql = "SELECT * FROM `patients` WHERE  phoneNumber='$phoneNumber'";
$exe = $conn->query($sql);
if ($exe->num_rows > 0) {
    $valid['success'] = false;
    $valid['messages'] = "Account with that phone number already exists  ";
} else {

    if ($password == $password_confirmation) {
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
                    if ($gender == "") {
                        $valid['success'] = false;
                        $valid['messages'] = "Choose gender please ! ";
                    } else {
                        if (strlen($password) < 6) {
                            $valid['success'] = false;
                            $valid['messages'] = "Password must be at least 6 characters  ";
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
                            // to generate the user uniq code

                            function genCode($conn)
                            {
                                $code = "";
                                $possible = "123456789";
                                $i = 0;
                                $length = 3;
                                while ($i < $length) {
                                    $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                                    if (!strstr($code, $char)) {
                                        $code .= $char;
                                        $i++;
                                    }
                                }
                                $code = "CHUK" . $code;
                                $sql = "SELECT * FROM `patients` WHERE code='$code'";
                                $exe = $conn->query($sql);
                                if ($exe->num_rows > 0) {
                                    genCode($conn);
                                }
                                return $code;
                            }
                            $code =  genCode($conn);
                            $time = time();
                            $password = md5($password);

                            $sql = "INSERT INTO `patients`(`patientID`, `firstname`, `lastname`, `gender`, `DOB`, `phoneNumber`, `nationality`,`nid`,  `insurance`, `password`, `code`, `OTP`, `status`, `dateOfRegistration`) VALUES (null,'$firstName','$lastName','$gender','$DOB','$phoneNumber','$nationality','$nid','$insurance','$password','$code','$otp','1','$time')";
                            $exe = $conn->query($sql);
                            session_start();
                            $id = $conn->insert_id;
                            $_SESSION['userSession'] = $id;
                            if ($exe == true) {
                                $valid['success'] = true;
                                $valid['messages'] = "Account successfuly created ";
                            } else {
                                $valid['success'] = false;
                                $valid['messages'] = "An error occured while creating account please try again ";
                            }
                            $valid['phoneNumber'] = $phoneNumber;
                            $valid['sendSms'] = "Hello $firstName $lastName,thank you for creating account your OTP IS :  $otp";
                        }
                    }
                }
            }
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = " Your passwords do not match ";
    }
}


echo json_encode($valid);
