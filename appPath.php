<?php
session_start();

require('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedUser = $_SESSION['user'];

$sql = "select a.applicationPath from users u inner join user_application uApp on u.userId=uApp.userId inner join application a on uApp.applicationId=a.applicationId where u.userId='$loggedUser'";
$query = $conn->query($sql);

if($query->num_rows>0){
	$row=$query->fetch_array();
	$response = $row;
}

$conn->close();

header("Content-type: application/json");
echo json_encode($response);
die();
?>
