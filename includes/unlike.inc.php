<?php
session_start();
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');

// likeImageID
$likeImageID = $_POST['nieuweLike'];
// likeSenderID
$likeSenderID = $_SESSION['userid'];

$deleteLike = $conn->prepare("DELETE FROM likes
                              WHERE likeimageid = $likeImageID AND likesendid = $likeSenderID");
$deleteLike->execute();
?>