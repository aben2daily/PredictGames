<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once ("../../config/Database.php");
    include_once ("../../models/League.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict member object
    $league =new league($db);

    //get member data from web
    $data = json_decode(file_get_contents("php://input"));

    $league->league_name    =$data->league_name;
    $league->createdby      =$data->createdby;
    $league->createddt      =$data->createddt;
    $league->location       =$data->location;

    //create member
    if($league->create()){
        echo json_encode(
            array('message ' => 'Member created')
        );
    }else{
        echo json_encode(
            array('message ' => 'Member not created')
        );
    }
?>