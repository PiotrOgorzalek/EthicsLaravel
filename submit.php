<?php
session_start();
//getting data from ethics js on complete
$txt = file_get_contents('php://input');
$id = $_SESSION['user'];
$txt2 = json_decode($txt);
$userName =$txt2->{'name'};
$schoolOrService = $txt2->{'schoolDepartment'};
$contactNo = $txt2->{'contactNumber'};
$projectTitle = $txt2->{'projectTitle'};
//testing

$startDate = $txt2->{'startDate'};
$funding= $txt2->{'funding'};
$typeOfResearch= $txt2->{'researchType'};
$duration =$txt2->{'projectDuration'};
$supervisorEmail = $txt2->{'supervisorEmail'};
//first char is user id
//$id = $txt[0];
//getting rest of the string without user id
//$txt =substr($txt,1);
//get todays date
$date = date("Ymd");
//creating path to file
$path = ("applications/".$id."_".$date.".json");
if (file_exists($path)){
//saving in folder with user id
    unlink($path);
    $myfile = fopen($path, "w") or die("Unable to open file!");
    fwrite($myfile,$txt);
    fclose($myfile);
    require('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$createApplicationData= "Update application set projectTitle='$projectTitle',startDate='$startDate',durationOfProject='$duration',funding='$funding',typeOfResearch='$typeOfResearch' where applicationPath='$path' ";
//getting the last input number
@mysqli_query($conn,$createApplicationData);
}
else{
    $myfile = fopen($path, "w") or die("Unable to open file!");
    fwrite($myfile,$txt);
    fclose($myfile);
require('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getUserIdFromEmail = "SELECT staff_userId from users_staff where email='$supervisorEmail'";
$supervisorId = @mysqli_query($conn,$getUserIdFromEmail);
$supervisorId = (int)$supervisorId;
//adding user name etc to users table
$createUserData = "UPDATE users SET userName='$userName',schoolOrProfessionalService='$schoolOrService',contactNumber='$contactNo' where userId='$id'";
@mysqli_query($conn,$createUserData);
//inserting data into application table
$createApplicationData= "INSERT INTO application (applicationId,projectTitle,users_staffId,startDate,durationOfProject,funding,typeOfResearch,applicationPath,approved)
                            values (null,'$projectTitle','$supervisorId','$startDate','$duration','$funding','$typeOfResearch','$path',null)";
//getting the last input number
@mysqli_query($conn,$createApplicationData);
$applicationId = mysqli_insert_id($conn);
$createUserAppData = "INSERT INTO user_application(id,applicationId,userId) VALUES (null,'$applicationId','$id')";
@mysqli_query($conn,$createUserAppData);
$conn->close();
}
?>

