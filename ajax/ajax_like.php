<?php

include_once("../classes/Like.class.php");

if (!empty($_POST)){
    session_start();
    $postid = $_POST['id'];

    $like = new like();
    $like->setPostId($postid);

    if (Like::userLike($postid)==0){
        $like->Like();
        $response = [
            "status" => "success",
            "type" => "liked"
        ];
    }
    else{
        $like->delLike();
        $response = [
            "status" => "success",
            "type" => "disliked"
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}