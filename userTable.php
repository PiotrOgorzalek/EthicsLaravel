<?php
session_start();
require ('connect.php');
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
$superId = $_SESSION['user'];
if ($received_data->action == 'fetchall')
{
   //selecting only what needed
    $query = "select projectTitle,startDate,typeOfResearch,approved from application 
    join user_application on user_application.applicationId = application.applicationId 
    join users on user_application.userId = users.userId where users.userId = '$superId'";
    $statement = $conn2->prepare($query);
    $statement->execute();
     while ($row = $statement->fetch(PDO::FETCH_ASSOC))
     {
        $data[] = $row;
     }
     echo json_encode($data);
}

?>