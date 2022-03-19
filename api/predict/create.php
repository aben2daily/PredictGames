<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once ("../../config/Database.php");
    include_once ("../../models/Predict.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict member object
    $predict =new Predict($db);

    //get member data from web
    $data = json_decode(file_get_contents("php://input"));

    $predict->league_id     =$data->league_id;
    $predict->user_id       =$data->user_id;
    $predict->prediction    =$data->prediction;
    $predict->p_exact_score  =$data->p_exact_score;
  /*  $predict->l_exact_score  =$data->l_exact_score;
    $predict->l_match_result =$data->l_match_result;
    $predict->l_win_team     =$data->l_win_team; */

    //create member
    if($predict->create()){
        echo json_encode(
            array('message ' => 'Member created')
        );
    }else{
        echo json_encode(
            array('message ' => 'Member not created')
        );
    }
?>