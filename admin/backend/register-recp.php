<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$valid = array('success' => false, 'messages' => array(), "phoneNumber" => "", "sendSms" => "");
$firstName = mysqli_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_escape_string($conn, $_POST['lastName']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);
$department = mysqli_escape_string($conn, $_POST['department']);
$type = explode('.', $_FILES['user_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
$url = '../../img/profiles/' . $img1;
if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {

    if ($phoneNumber == "") {
        $valid['success'] = false;
        $valid['messages'] = "Please Enter phone number ! ";
    } else {
        $sql = "SELECT * FROM `receptionist` WHERE email='$email' OR phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            $valid['success'] = false;
            $valid['messages'] = "A user with the that email or phone Number already exists";
        } else {
            if (in_array($type, array('jpg', 'jpeg', 'png', 'PNG'))) {
                if (is_uploaded_file($_FILES['user_image']['tmp_name'])) {
                    if (move_uploaded_file($_FILES['user_image']['tmp_name'], $url)) {
                        $tim = time();
                        // to generate the OTP code
                        $password = "";
                        $possible = "123456789ABCDEFGHIJKLMNOPQRSTabcdefghijklmnopqrstuvwxyz!@#$^&*";
                        $i = 0;
                        $length = 6;
                        while ($i < $length) {
                            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                            if (!strstr($password, $char)) {
                                $password .= $char;
                                $i++;
                            }
                        }
                        $passwordHashed = md5($password);

                        $sql2 = "INSERT INTO `receptionist`(`recpID`, `firstname`, `lastname`, `profileImg`, `email`, `phoneNumber`, `departmentID`, `password`, `status`, `recpDateAdded`)  VALUES (null,'$firstName','$lastName','$img1','$email','$phoneNumber','$department','$passwordHashed','1','$tim')";
                        if ($conn->query($sql2) === TRUE) {
                            $valid['success'] = true;
                            $valid['messages'] = "Receptionist  successfully registered  ";
                            $valid['phoneNumber'] = $phoneNumber;
                            $valid['sendSms'] = "Hello $firstName, your account successfuly created your password IS :  $password";
                        } else {
                            $valid['success'] = false;
                            $valid['messages'] = "Error while recording the data ";
                        }
                    } else {
                        $valid['success'] = false;
                        $valid['messages'] = "Error while uploading";
                    }
                }
            } else {
                $valid['success'] = false;
                $valid['messages'] = "Invalid profile image ! ";
            }
        }
    }
}



echo json_encode($valid);
  // upload the file 
