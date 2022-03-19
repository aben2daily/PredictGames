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

    //query league
    $result=$league->getAll();

    //check  row count
    $num=$result->rowCount();

    if ($num>0){
        $league=array();
        $league_arr['data'] =array();
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $league_item=array(
                'id'           =>  $id,
                'league_name'  =>  $league_name,
                'createdby'    =>  $createdby,
                'createddt'    =>  $createddt,
                'location'     =>  $location
            );
            array_push($league_arr['data'],$league_item);
        }
        
        //convert to json and output
        echo json_encode($league_arr);
    }else{
        echo json_encode(
            array('message' => 'No post found.')
        );
    }
?> 