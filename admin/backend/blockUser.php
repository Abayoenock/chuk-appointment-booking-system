
<?php
include 'db_conn.php';
$id = @$_GET['id'];
$status = @$_GET['status'];
$table = $_GET['table'];
$idName = $_GET['idName'];
$fieldName = $_GET['fieldName'];

if ($table == 'patients') {
    $status == 2 ? $status = 0 : $status = 2;
} else {
    $status == 1 ? $status = 0 : $status = 1;
}
$valid = array('success' => false, 'messages' => array());
$sql = "UPDATE `$table` SET `$fieldName` = '$status'  WHERE `$idName`='$id'";
$exe = $conn->query($sql);
if ($exe) {
    $valid['success'] = true;
    if ($status == 0) {
        $valid['messages'] = " User blocked successfuly ";
    } else {
        $valid['messages'] = " User unblocked successfuly ";
    }
} else {
    $valid['success'] = false;
    $valid['messages'] = "Failed please try again ";
}
echo json_encode($valid);

?>