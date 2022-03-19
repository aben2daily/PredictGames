<?php

    //header Access
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once ("../../config/Database.php");
    include_once ("../../models/League.php");

    // instantiate db   connect
    $database = new Database();
    $db=$database->connect();
     
    // instantiate predict league object
    $league =new League($db);

    $league->id = isset($_GET['id']) ? $_GET['id'] : die();
    $league->getLeague(); 

    $league_arr = array(
        'id'            => $league->id,
        'league_name'   => $league->league_name,
        'createdby'     => $league->createdby,
        'createddt'     => $league->createddt,
        'location'      => $league->location
    );
    // make Json
    print_r(json_encode($league_arr))
    
?> 