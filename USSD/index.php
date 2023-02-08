<?php
include '../backend/db_conn.php';
$sessionId   = $_POST["sessionId"];
$phoneNumber = $_POST["msisdn"];
$userinput   = urldecode($_POST["UserInput"]);
$serviceCode = $_POST["serviceCode"];
$networkCode = $_POST['networkCode'];
$response = "";
$delimiter = "*";
$phoneNumber = substr($phoneNumber, 2);
$userinput = substr($userinput, 1);
$result = explode($delimiter, $userinput);
$length = count($result);
//echo $phoneNumber;
if ($length > 0) {
    $last_element = $result[$length - 1];
    if (substr($last_element, -1) == "#") {
        $result[$length - 1] = substr($last_element, 0, -1);
    }
}
//echo json_encode($result);
if (count($result) == 3) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111) {
        $response  = "Welcome to chuk Appointment booking system \n";
        $response .= "1. book Appointment\n2.Check your appointment\n3.Register";
        $ContinueSession = 1;
    }
}
if (count($result) == 4) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 1) {
        $response  = "Enter your choice \n";
        $response .= "1. Use this number\n2.Enter phone Number ";
        $ContinueSession = 1;
    } else if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2) {
        $response  = "Enter your choice \n";
        $response .= "1. Use this number\n2.Enter phone Number ";
        $ContinueSession = 1;
    } else if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3) { // register new user 
        $response  = "Enter your first name \n";
        $ContinueSession = 1;
    } else {
        $response  = "Invalid option \n";
        $ContinueSession = 0;
    }
}
if (count($result) == 5) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 1 && $result[4] == 1) {
        $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            while ($row = $exe->fetch_array()) {
                $response  = "Welcome " . $row['firstname'] . " choose department\n";
            }
            //if the user is found select the departments available 

            $sql = "SELECT * FROM `department` order by dept_ID asc";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                $i = 1;
                while ($row = $exe->fetch_array()) {
                    $response  .= $i . ". " . $row['departmentName'] . "\n";
                    $i++;
                }
                $ContinueSession = 1;
            } else {
                //when there areno registered departments
                $response  .= "No deppartments found  \n";
                $ContinueSession = 0;
            }
        } else {
            // if the user is not found 
            $response  = "Your phone number was not found in our system \n";
            $response .= "Regiter through the web application";
            $ContinueSession = 0;
        }
    }

    // WHEN THE user checks for appointments 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2 && $result[4] == 1) {
        $response  = "Choose  \n";
        $response .= "1. Pending\n2.Approved\n3. Cancelled";
        $ContinueSession = 1;
    }
    // WHEN THE user checks for appointments 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2 && $result[4] == 2) {
        $response  = "Not yet functional \n";
        $ContinueSession = 0;
    }
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3) {
        $firstname = $result[4];
        $response  = "Enter Your last name  \n";
        $ContinueSession = 1;
    }
}

if (count($result) == 6) {
    // check whether the input matches 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 1 && $result[4] == 1) {
        // departmentNumber
        $dep = $result[5] - 1;
        // select the department ID
        $sql = "SELECT * FROM `department` order by dept_ID asc Limit $dep,1 ";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            // when the department is found 
            while ($row = $exe->fetch_array()) {
                $departmentID = $row['dept_ID'];
                $departmentName = $row['departmentName'];
            }
            $time = strtotime("today");

            $sql = " SELECT DISTINCT dateAvailable  FROM `timetable` WHERE `dateAvailable`>$time AND departmentID='$departmentID' order by dateAvailable ASC ";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                $response = "Pick a date  \n";
                $i = 1;
                while ($row = $exe->fetch_array()) {
                    $date = $row['dateAvailable'];
                    $date = date("D d-M-Y", $date);
                    $response .= $i . ". " . $date . "\n";
                    $i++;
                }
                $ContinueSession = 1;
            } else {
                $response = "We are sorry , there are no set appointments in $departmentName department \n";
                $ContinueSession = 0;
            }
        } else {
            //when the user enters a number not associated to the department 
            $response  .= "Invalid responce  \n";
            $ContinueSession = 0;
        }
    }
    // user checking for pending appointments 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2 && $result[4] == 1 && $result[5] == 1) {
        $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            while ($row = $exe->fetch_array()) {
                $patientName = $row['firstname'];
                $patientID = $row['patientID'];
            }
            $time = strtotime("today");
            $sql = "SELECT * FROM `appointments` as a INNER JOIN department as d on a.departmentID=d.dept_ID INNER JOIN doctors as dc on a.doctorID=dc.doctorID  WHERE a.appointmentStatus='0' AND patientID='$patientID' AND a.appointmentDate>$time";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                $response  = "Hello $patientName , you have pending appointments on  \n";
                while ($row = $exe->fetch_array()) {
                    $date = $row['appointmentDate'];
                    $date = date("D d-M-Y", $date);
                    $response .= "$date \n";
                }
                $ContinueSession = 0;
            } else {
                $response  = "Hello $patientName , \n";
                $response .= "You have no pending Appointments ";
                $ContinueSession = 0;
            }
        } else {
            $response  = "Your phone number was not found in our system \n";
            $response .= "Regiter through the web application";
            $ContinueSession = 0;
        }
    }
    // user checking for approved appointments 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2 && $result[4] == 1 && $result[5] == 2) {
        $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            while ($row = $exe->fetch_array()) {
                $patientName = $row['firstname'];
                $patientID = $row['patientID'];
            }
            $time = strtotime("today");
            $sql = "SELECT * FROM `appointments` as a  INNER JOIN appointmentapproval as apl on apl.appointmentID=a.appointmentID WHERE  patientID='$patientID' AND a.appointmentDate>$time AND apl.appointmentApprove='1'";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                $response  = "Hello $patientName , your approved  appointments  \n";
                while ($row = $exe->fetch_array()) {
                    $date = $row['appointmentDate'];
                    $date = date("D d-M-Y", $date);
                    $response .= "$date \n";
                }
                $ContinueSession = 0;
            } else {
                $response  = "Hello $patientName , \n";
                $response .= "You have no approved  Appointments ";
                $ContinueSession = 0;
            }
        } else {
            $response  = "Your phone number was not found in our system \n";
            $response .= "Regiter through the web application";
            $ContinueSession = 0;
        }
    }
    // user checking for approved appointments 
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 2 && $result[4] == 1 && $result[5] == 3) {
        $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            while ($row = $exe->fetch_array()) {
                $patientName = $row['firstname'];
                $patientID = $row['patientID'];
            }
            $time = strtotime("today");
            $sql = "SELECT * FROM `appointments` as a  INNER JOIN appointmentapproval as apl on apl.appointmentID=a.appointmentID WHERE  patientID='$patientID' AND a.appointmentDate>$time AND apl.appointmentApprove='0'";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                $response  = "Hello $patientName , your cancelled   appointments  \n";
                while ($row = $exe->fetch_array()) {
                    $date = $row['appointmentDate'];
                    $date = date("D d-M-Y", $date);
                    $response .= "$date \n";
                }
                $ContinueSession = 0;
            } else {
                $response  = "Hello $patientName , \n";
                $response .= "You have no caancelled  Appointments ";
                $ContinueSession = 0;
            }
        } else {
            $response  = "Your phone number was not found in our system \n";
            $response .= "Regiter through the web application";
            $ContinueSession = 0;
        }
    }
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3) {
        $firstname = $result[4];
        $lastname = $result[5];
        $response  = "Enter Your National ID /Passport  \n";
        $ContinueSession = 1;
    }
}

if (count($result) == 7) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 1 && $result[4] == 1) {
        // departmentNumber
        $dep = $result[5] - 1;
        // select the department ID
        $sql = "SELECT * FROM `department` order by dept_ID asc Limit $dep,1 ";
        $exe = $conn->query($sql);
        if ($exe->num_rows > 0) {
            // when the department is found 
            while ($row = $exe->fetch_array()) {
                $departmentID = $row['dept_ID'];
                $departmentName = $row['departmentName'];
            }
            $timeList = $result[6] - 1;
            $time = strtotime("today");
            $sql = " SELECT DISTINCT dateAvailable  FROM `timetable` WHERE `dateAvailable`>$time AND departmentID='$departmentID' order by dateAvailable ASC limit $timeList,1 ";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                while ($row = $exe->fetch_array()) {
                    $dateAvailable = $row['dateAvailable'];
                }
                $response = "Choose doctor \n";
                $sql = "SELECT * FROM `timetable` AS t INNER JOIN doctors as d on t.doctorID=d.doctorID  WHERE t.dateAvailable='$dateAvailable' AND t.departmentID='$departmentID' order by d.doctorID asc ";
                $exe = $conn->query($sql);
                $i = 1;
                while ($row = $exe->fetch_array()) {
                    $response .= $i . " ." . $row['title'] . " ." . $row['firstname'] . "\n";
                    $i++;
                }
                $ContinueSession = 1;
            } else {
                $response = "We are sorry , there are no set appointments in $departmentName department \n";
                $ContinueSession = 0;
            }
        } else {
            $response = "Invalid responce  \n";
            $ContinueSession = 0;
        }
    } else {
        $response = "Invalid responce  \n";
        $ContinueSession = 0;
    }
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3) {
        $firstname = $result[4];
        $lastname = $result[5];
        $nid = $result[6];
        $response  = "Enter Your birth date format [ Y-mm-dd ] \n";
        $ContinueSession = 1;
    }
}

if (count($result) == 8) {

    $sql = "SELECT * FROM patients WHERE phoneNumber='$phoneNumber'";
    $exe = $conn->query($sql);
    if ($exe->num_rows > 0) {
        while ($row = $exe->fetch_array()) {
            $patientName = $row['firstname'];
            $patientID = $row['patientID'];
        }
        if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 1 && $result[4] == 1) {
            // departmentNumber
            $dep = $result[5] - 1;
            // select the department ID
            $sql = "SELECT * FROM `department` order by dept_ID asc Limit $dep,1 ";
            $exe = $conn->query($sql);
            if ($exe->num_rows > 0) {
                // when the department is found 
                while ($row = $exe->fetch_array()) {
                    $departmentID = $row['dept_ID'];
                    $departmentName = $row['departmentName'];
                }
                $timeList = $result[6] - 1;
                $time = strtotime("today");
                $sql = " SELECT DISTINCT dateAvailable  FROM `timetable` WHERE `dateAvailable`>$time AND departmentID='$departmentID' order by dateAvailable ASC limit $timeList,1 ";
                $exe = $conn->query($sql);
                if ($exe->num_rows > 0) {
                    while ($row = $exe->fetch_array()) {
                        $dateAvailable = $row['dateAvailable'];
                    }
                    // select the selected doctor 
                    $doctorList = $result[7] - 1;
                    $sql = "SELECT * FROM `timetable` AS t INNER JOIN doctors as d on t.doctorID=d.doctorID  WHERE t.dateAvailable='$dateAvailable' AND t.departmentID='$departmentID' order by d.doctorID asc limit $doctorList,1";
                    $exe = $conn->query($sql);
                    while ($row = $exe->fetch_array()) {
                        $doctorID = $row['doctorID'];
                    }
                    // then book the appointment 

                    $time = time();
                    $sql = "SELECT * FROM appointments WHERE patientID='$patientID' AND appointmentDate='$dateAvailable' AND departmentID='$departmentID'";
                    $exe = $conn->query($sql);
                    if ($exe->num_rows > 0) {
                        $response = "You ready have an appointment on that day \n";
                        $ContinueSession = 0;
                    } else {
                        $sql = "INSERT INTO `appointments`(`appointmentID`, `patientID`, `departmentID`, `doctorID`, `patientFile`, `appointmentDate`, `appointmentStatus`, `dateCreated`) VALUES (null,'$patientID','$departmentID','$doctorID',null,'$dateAvailable','0','$time')";
                        $exe = $conn->query($sql);

                        $day = date("D d-m-Y", $dateAvailable);

                        if ($exe) {
                            $response = "Thank you $patientName, your appointment has sent waiting for confirmation   \n";
                            $ContinueSession = 0;
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
                                CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello  $patientName , your appointment in $departmentName department  on $day was received , waiting for confirmation ", 'action' => 'send-sms'),
                                CURLOPT_HTTPHEADER => array(
                                    'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                                ),
                            ));
                            $response2 = curl_exec($curl);
                            //echo $response;
                            curl_close($curl);
                        } else {
                            $response = "Appointment booking failed please try again later  \n";
                            $ContinueSession = 0;
                        }
                    }
                } else {
                    $response = "We are sorry , there are no set appointments in $departmentName department \n";
                    $ContinueSession = 0;
                }
            } else {
                $response = "Invalid responce  \n";
                $ContinueSession = 0;
            }
        } else {
            $response = "Invalid responce  \n";
            $ContinueSession = 0;
        }
    } else {
        $response  = "Your phone number was not found in our system \n";
        $response .= "Regiter through the web application";
        $ContinueSession = 0;
    }
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3) {
        $firstname = $result[4];
        $lastname = $result[5];
        $nid = $result[6];
        $bod = $result[7];
        $response  = "Choose Gender  \n";
        $response .= "1. Male\n2.Female\n";
        $ContinueSession = 1;
    }
}
if (count($result) == 9) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3 && ($result[8] == 1 || $result[8] == 2)) {
        $firstname = $result[4];
        $lastname = $result[5];
        $nid = $result[6];
        $bod = $result[7];
        $gender = $result[8] == 1 ? "Male" : "Female";
        $response  = "Enter your Insurance \n";
        $ContinueSession = 1;
    } else {
        $response = "Invalid Gender  responce  \n";
        $ContinueSession = 0;
    }
}
if (count($result) == 10) {
    if ($result[0] == 662 && $result[1] == 800 && $result[2] == 111 && $result[3] == 3 && ($result[8] == 1 || $result[8] == 2)) {
        $firstname = $result[4];
        $lastname = $result[5];
        $nid = $result[6];
        $bod = $result[7];
        $gender = $result[8] == 1 ? "Male" : "Female";
        $insurance = $result[9];

        // to generate the password code
        $password = "";
        $possible = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghjklmnopqrstuv123456789";
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

        $sql = "SELECT * FROM patients WHERE  phoneNumber='$phoneNumber'";
        $exe = $conn->query($sql);
        if ($exe->num_rows <= 0) {
            $time = time();
            $sql = "INSERT INTO `patients`(`patientID`, `firstname`, `lastname`, `gender`, `DOB`, `phoneNumber`, `nationality`,`nid`,  `insurance`, `password`, `code`, `OTP`, `status`, `dateOfRegistration`) VALUES (null,'$firstname','$lastname','$gender','$bod','$phoneNumber','','$nid','$insurance','$passwordHashed','','','2','$time')";
            $exe = $conn->query($sql);
            if ($exe) {
                $response = "Thank you $firstname $lastname , your account was successfuly created   \n";
                $ContinueSession = 0;

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
                    CURLOPT_POSTFIELDS => array('to' => "+25" . $phoneNumber, 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "Hello $firstname $lastname,thank you for creating an account, you can now start using the booking system via this USSD or  if you want to use our web app your password is :  $password", 'action' => 'send-sms'),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
                    ),
                ));
                $response2 = curl_exec($curl);
                //echo $response;
                curl_close($curl);
            } else {
                $response = "hello  $firstname $lastname , your account was not created , we are sorry for the inconviniency    \n";
                $ContinueSession = 0;
            }
        } else {
            $response = "Oppps User with this phone number  already exist ! \n";
            $ContinueSession = 0;
        }
    } else {
        $response = "Invalid Gender  responce  \n";
        $ContinueSession = 0;
    }
}

$resp = array("sessionId" => $sessionId, "message" => $response, "ContinueSession" => $ContinueSession);

echo json_encode($resp);
