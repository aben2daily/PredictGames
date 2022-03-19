<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once ("../../config/Database.php");
    include_once ("../../models/Member.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict member object
    $member =new Member($db);

    $member->id = isset($_GET['id']) ? $_GET['id'] : die();
    $member->getMember(); 

    $member_arr = array(
        'id'                => $member->id,
        'user_id'           => $member->user_id,
        'joindt'            => $member->joindt,
        'league_id'         => $member->league_id,
        'point'             => $member->point,
        'leaguename'        => $member->leaguename
    );
    // make Json
    print_r(json_encode($member_arr))
    
?> 