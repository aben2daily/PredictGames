<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once ("../../config/Database.php");
    include_once ("../../models/Member.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict member object
    $member =new Member($db);

    //get member data from web
    $data = json_decode(file_get_contents("php://input"));

    $member->id         =$data->id;
    $member->league_id  =$data->league_id;
    $member->user_id    =$data->user_id;
    $member->joindt     =$data->joindt;
    $member->point      =$data->point;

    //create member
    if($member->updateMember()){
        echo json_encode(
            array('message ' => 'Member updated')
        );
    }else{
        echo json_encode(
            array('message ' => 'Member not updated')
        );
    }
?>