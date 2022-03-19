<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once ("../../config/Database.php");
    include_once ("../../models/League.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict league object
    $league =new League($db);

    //get league data from web
    $data = json_decode(file_get_contents("php://input"));

    $league->id           =$data->id;
    $league->league_name  =$data->league_name;
    $league->createdby    =$data->createdby;
    $league->createddt    =$data->createddt;
    $league->location     =$data->location;

    //create league
    if($league->update()){
        echo json_encode(
            array('message ' => 'league updated')
        );
    }else{
        echo json_encode(
            array('message ' => 'league not updated')
        );
    }
?>