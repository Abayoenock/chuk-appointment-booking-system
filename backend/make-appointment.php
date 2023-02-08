<?php
include 'db_conn.php';
session_start();
$userID = $_SESSION['userSession'];
$valid = array('success' => false, 'messages' => array(), "phoneNumber" => "", "sendSms" => "");
$date = $_GET['date'];
$departmentID = $_GET['deptID'];
$doctor = mysqli_escape_string($conn, @$_POST['doctor']);
$type = explode('.', $_FILES['file']['name']);
$type = $type[count($type) - 1];
$file = uniqid(rand()) . '.' . $type;
$url = '../img/docs/' . $file;
$sql = "SELECT * FROM patients WHERE patientID='$userID'";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $usernames = $row['firstname'] . " " . $row['lastname'];
    $phoneNumber = $row['phoneNumber'];
}
$sql = "SELECT * FROM `department` WHERE dept_ID='$departmentID' ";
$exe = $conn->query($sql);
while ($row = $exe->fetch_array()) {
    $departmentName = $row['departmentName'];
}

$day = date("D d-m-Y", $date);
if ($doctor == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose doctor ";
} else {

    if ($type == '') {
        $sql = "SELECT * FROM `appointments` WHERE departmentID='$departmentID' AND patientID='$userID' AND  appointmentStatus='0' AND appointmentDate='$date'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            $valid['success'] = false;
            $valid['messages'] = "You already made an appointment on this date";
        } else {
            $time = time();

            $sql = "INSERT INTO `appointments`(`appointmentID`, `patientID`, `departmentID`, `doctorID`, `patientFile`, `appointmentDate`, `appointmentStatus`, `dateCreated`) VALUES (NULL,'$userID','$departmentID','$doctor',null,'$date','0','$time')";
            $exe = $conn->query($sql);

            if ($exe) {
                $valid['success'] = true;
                $valid['messages'] = " Your appointment has been sent, waiting for confirmation ";

                $valid['phoneNumber'] = $phoneNumber;
                $valid['sendSms'] = "Hello $usernames, your appointment in $departmentName department  on $day was received , waiting for confirmation ";
            } else {
                $valid['success'] = false;
                $valid['messages'] = "  Failed to make an appointment please try again  ";
            }
        }
    } else {

        if (in_array($type, array('jpg', 'jpeg', 'png', 'PNG'))) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
                    $sql = "SELECT * FROM `appointments` WHERE departmentID='$departmentID' AND patientID='$userID' AND  appointmentStatus='0' AND appointmentDate='$date'";
                    $exe = $conn->query($sql);
                    if ($exe->num_rows > 0) {
                        $valid['success'] = false;
                        $valid['messages'] = "You already made an appointment on this date";
                    } else {
                        $time = time();

                        $sql = "INSERT INTO `appointments`(`appointmentID`, `patientID`, `departmentID`, `doctorID`, `patientFile`, `appointmentDate`, `appointmentStatus`, `dateCreated`) VALUES (NULL,'$userID','$departmentID','$doctor','$file','$date','0','$time')";
                        $exe = $conn->query($sql);

                        if ($exe) {
                            $valid['success'] = true;
                            $valid['messages'] = " Your appointment has been sent, waiting for confirmation ";
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
                                CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello $usernames, your appointment in $departmentName department  on $day was received , waiting for confirmation ", 'action' => 'send-sms'),
                                CURLOPT_HTTPHEADER => array(
                                    'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                                ),
                            ));
                            $response = curl_exec($curl);
                            //echo $response;
                            curl_close($curl);
                        } else {
                            $valid['success'] = false;
                            $valid['messages'] = "  Failed to make an appointment please try again  ";
                        }
                    }
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }
            }
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Invalid image type , must be PNG, JPEG ,JPG ! ";
        }
    }
}



echo json_encode($valid);
