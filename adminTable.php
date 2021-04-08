<?php
session_start();
require ('connect.php');
$received_data = json_decode(file_get_contents("php://input"));
$data = array();

if ($received_data->action == 'fetchall')
{
   //selecting only what needed
    $query = "select * from users_staff where admin=0";
    $statement = $conn2->prepare($query);
    $statement->execute();
     while ($row = $statement->fetch(PDO::FETCH_ASSOC))
     {
        //just to make table look pretty
        $row['Id'] = $row['staff_userId']; 
        //might need to add link here no idea how to do it at the moment
        $row['Options'] ="<button>Delete</button>";
        $data[] = $row  ;
     }
     echo json_encode($data);
}

?>