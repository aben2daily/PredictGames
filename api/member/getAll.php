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

    //query member
    $result=$member->getAll();

    //check  row count
    $num=$result->rowCount();

    if ($num>0){
        $member=array();
        $member_arr['data'] =array();
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $member_item=array(
                'id'            =>  $id,
                'leaguename'    =>  $leaguename,
                'user_id'       =>  $user_id,
                'league_id'     =>  $league_id,
                'joindt'        =>  $joindt,
                'point'         =>  $point
            );
            array_push($member_arr['data'],$member_item);
        }
        
        //convert to json and output
        echo json_encode($member_arr);
    }else{
        echo json_encode(
            array('message' => 'No post found.')
        );
    }
?> 