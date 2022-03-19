<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once ("../../config/Database.php");
    include_once ("../../models/Predict.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict predict object
    $predict =new Predict($db);

    //get predict data from web
    $data = json_decode(file_get_contents("php://input"));

    $predict->id             =$data->id;
    $predict->l_exact_score  =$data->l_exact_score;
    $predict->l_match_result  =$data->l_match_result;
    $predict->l_win_team      =$data->l_win_team;

    //create predict
    if($predict->update()){
        echo json_encode(
            array('message ' => 'predict updated')
        );
    }else{
        echo json_encode(
            array('message ' => 'predict not updated')
        );
    }
?>