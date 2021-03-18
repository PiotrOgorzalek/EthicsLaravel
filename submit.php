<?php
session_start();
//getting data from ethics js on complete
$txt = file_get_contents('php://input');
$id = $_SESSION['userId'];
//decoding form to array
$txt2 = json_decode($txt);
//accesing  variables and assign it to php
$userName = $txt2->{'name'};
$schoolOrService = $txt2->{'schoolDepartment'};
$contactNo = $txt2->{'contactNumber'};
$projectTitle = $txt2->{'projectTitle'};
//testing need to find a way to choose staff !!!!
$supervisorStaff = 1;
$startDate = $txt2->{'startDate'};
$funding= $txt2->{'funding'};
$typeOfResearch= $txt2->{'researchType'};


//first char is user id 
//$id = $txt[0];
//getting rest of the string without user id
//$txt =substr($txt,1);
//get todays date
$date = date("Ymd");
//creating path to file
$path = ("applications/".$id."_".$date.".json");

//saving in folder with user id 
$myfile = fopen($path, "w") or die("Unable to open file!");
fwrite($myfile,$txt);
fclose($myfile);


require('connect.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$createUserData = "UPDATE users SET userName='$userName',schoolOrProfessionalService='$schoolOrService',contactNumber='$contactNo' where userId='$id'";
@mysqli_query($conn,$createUserData);
$createApplicationData= "INSERT INTO applications (applicationId,projectTitle,users_staffId,startDate,funding,typeOfResearch,applicationPath) 
                            values (null,'$projectTitle','$supervisorStaff','$startDate','$funding','$typeOfResearch','$path')";
@mysqli_query($conn,$createApplicationData);
//getting id from most recent entry
$applicationId = mysqli_insert_id($conn); 
$createUserAppData = "INSERT INTO user_application(id,applicationId,userId) VALUES (null,'$applicationId',$id)";
@mysqli_query($conn,$createUserAppData);

?>
