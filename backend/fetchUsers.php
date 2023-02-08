
<?php
session_start();
include 'db_conn.php';
$id = $_SESSION['userSession'];

$sql = "SELECT * FROM `users` WHERE id!='$id'AND id>1 ";
$exe = $conn->query($sql);
$output = array();
while ($row = $exe->fetch_array()) {
    $output[] = $row;
}
echo json_encode($output);

?>