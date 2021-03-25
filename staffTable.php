<?php

$received_data = json_decode(file_get_contents("php://input"));
$data = array();

if ($received_data->action == 'fetchall')
{
    $query = "select * from users";
    $statement = $conn2->prepare($query);
    $statement->execute();
     while ($row = $statement->fetch(PDO::FETCH_ASSOC))
     {
        $data[] = $row;
     }
     echo json_encode($data);
}

?>