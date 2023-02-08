<?php
include '../../backend/db_conn.php';
session_start();
$userID = $_SESSION['adminSession'];
$table = $_GET['t'];
$fname = $_GET['fname'];
$img = $_GET['img'];
$id = $_GET['id'];
$fid = $_GET['fid'];
$valid = array('success' => false, 'messages' => array());
$type = explode('.', $_FILES['user_image']['name']);
$type = $type[count($type) - 1];
$img1 = uniqid(rand()) . '.' . $type;
if ($table == "department") {
    $url = '../../img/department/' . $img1;
} else {
    $url = '../../img/profiles/' . $img1;
}

if ($type == '') {
    $valid['success'] = false;
    $valid['messages'] = "Please choose  an image ! ";
} else {


    if (in_array($type, array('jpg', 'jpeg', 'png', 'PNG'))) {
        if (is_uploaded_file($_FILES['user_image']['tmp_name'])) {
            if (move_uploaded_file($_FILES['user_image']['tmp_name'], $url)) {

                if ($table == "department") {
                    if (file_exists("../../img/department/$img")) {
                        unlink("../../img/department/$img");
                    }
                } else {

                    if (file_exists("../../img/profiles/$img")) {
                        unlink("../../img/profiles/$img");
                    }
                }




                $sql2 = "UPDATE `$table` SET `$fname` = '$img1' WHERE `$table`.`$fid` = $id";
                if ($conn->query($sql2) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "Profile Image sucessfuly updated  ";
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




echo json_encode($valid);
  // upload the file 
