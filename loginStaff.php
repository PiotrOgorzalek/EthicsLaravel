<?php
session_start();
//connectiong to dataabase
require ('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);

$email = $_POST['email'];
$password = $_POST['password'];

if($email==''){
	$out['error'] = true;
	$out['message'] = "Email is required"; // If username is left blank this will return a message to the page
}
else if($password==''){
	$out['error'] = true;
	$out['message'] = "Password is required"; // If password is left blank this will return a message to the page
}
else{
	$sql = "SELECT * From users_staff where email='$email' and password='$password'";
	$query = $conn->query($sql);

	if($query->num_rows>0){
		$row=$query->fetch_array();
		if($row['admin']==true)
		{
			//IMPORTANT AS USING THAT VUE WILL OPEN RELEVANT PAGE
			$out['message'] = "Admin Login";
      $_SESSION['user']=$row['staff_userId'];
      $_SESSION['userType']='Admin';
		}
		else
		{
		  $out['message'] = "Login Successful"; // If the user is successfully logged in this will return a message to the page
		  $_SESSION['user']=$row['staff_userId'];
      $_SESSION['userType']='Supervisor';
		} // Set session variable of user to the user id of a user on a successful login
	}
	else{
		$out['error'] = true;
		$out['message'] = "Login Failed. User not Found"; // If the user cannot be found this will return a message to the page
	}
}

$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();
?>
