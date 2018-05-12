<?php

include_once("includes/session.inc.php");
include_once ('classes/Post.class.php');
$userID = $_SESSION['targetUserID'];
$postid = $_GET['imageID'];
$post = new Post();
//vraag post op
$thisPost = $post->getUserPost($postid);//array Array ( [id] => 93 [filelocation] => files/55-1525791905.jpg [imageuserid] => 55 [besch] => landscape 1 [user] => 1@test.com [timestamp] => 2018-05-08 17:05:05 )
//print_r($thisPost);exit;
//met opevraagde post de afbeelding wissen
unlink($thisPost['filelocation']);
//post wissen uit database
$post->setPostId($postid);
$post->deletePost();
header('Location: profile.php?userID='.$userID);

?>