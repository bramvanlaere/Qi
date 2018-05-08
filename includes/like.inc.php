<?php
session_start();
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');

$likeImageID = $_POST['nieuweLike'];
// likeSenderID
$likeSenderID = $_SESSION['userid'];

$getReceiverID = $conn->prepare("SELECT imageuserid FROM posts WHERE id = :imageID");
$getReceiverID->bindValue(":imageID", $likeImageID);
$getReceiverID->execute();
$result = $getReceiverID->fetch(PDO::FETCH_ASSOC);
// likeReceiverID
$likeReceiverID = $result['imageuserid'];

if(!empty($likeReceiverID)){
    $statement = $conn->prepare("INSERT INTO likes (likeimageid, likesendid, likereceiveid) VALUES (:likeimageid, :likesendid, :likereceiveid)");
    $statement->bindValue(':likeimageid', $likeImageID);
    $statement->bindValue(':likesendid', $likeSenderID);
    $statement->bindValue(':likereceiveid', $likeReceiverID);
    $statement->execute();
}



