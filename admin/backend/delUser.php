
<?php
include 'db_conn.php';
$id = @$_GET['id'];
$table = $_GET['table'];
$idName = $_GET['idName'];
$valid = array('success' => false, 'messages' => array());
$sql = "DELETE  FROM `$table` WHERE `$idName`='$id' ";
$exe = $conn->query($sql);
if ($exe) {
     $valid['success'] = true;
     $valid['messages'] = " User successfuly deleted";
} else {
     $valid['success'] = false;
     $valid['messages'] = "Failed please try again ";
}
echo json_encode($valid);

?>