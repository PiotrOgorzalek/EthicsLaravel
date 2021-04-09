<?php
session_start();

require('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$approveStatus = $_GET['approve'];

$viewingID = $_GET['viewingID'];

//update the value of an applications approved status dependent upon the button pressed by the supervisor
$createUserData = "UPDATE application app INNER JOIN user_application uApp ON app.applicationId=uApp.applicationId INNER JOIN users u ON uApp.userId=u.userId SET app.approved='$approveStatus' where u.userId='$viewingID'";
@mysqli_query($conn,$createUserData);

$conn->close();

header("Location: staffPage.php");
exit();
?>
