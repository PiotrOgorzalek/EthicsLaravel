<?php
session_start();

require ('connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);

$superName = $_POST['superName']; //Sets value of superName to the value inserted from the form
$superEmail = $_POST['superEmail']; //Sets value of superEmail to the value inserted from the form
$superPass = $_POST['superPass']; //Sets value of superPass to the value inserted from the form

if($superName==''){
	$out['error'] = true;
	$out['message'] = "Name is required"; // If username is left blank this will return a message to the page
}
else if($superEmail==''){
	$out['error'] = true;
	$out['message'] = "Email is required"; // If email is left blank this will return a message to the page
}
else if($superPass==''){
	$out['error'] = true;
	$out['message'] = "Password is required"; // If password is left blank this will return a message to the page
} else {
	//check if email in the database
	$sqlCheck = "SELECT email FROM users_staff WHERE email='$superEmail'";
	//run the query against database return 1 if found or 0 if not
	$emailCheck = @mysqli_query($conn, $sqlCheck);
	//if true return message that email already existss
	if (mysqli_num_rows($emailCheck)) {
		$out['error'] = true;
		$out['message'] = "Email already exists in database";
	}
	//everything fine so run query and say to user that login is succesfull all queries need some security
	else {
		$sql = "INSERT INTO users_staff(name,email,password,admin) VALUES ('$superName','$superEmail','$superPass',0)";
	
		if ($conn->query($sql) === TRUE) {
			
			$sql = "select * from users_staff where email='$superEmail' and password='$superPass"; //Necessary to log the user in directly after creating an account
			$query = $conn->query($sql);
			$out['message'] = "Supervisor Created";
			
		}
	}
}




$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();


?>
