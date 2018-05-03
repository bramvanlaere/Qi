<?php
if(!isset($_SESSION)){session_start();}
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
//userID
$commentUserID = $_POST['userid'];
//commentID
$commentImageID = $_POST['imageID'];
//newComment
if(isset($_POST['newComment'])){
    $commentText = $_POST['newComment'];
}

if(!empty($commentText)) {
    $statement = $conn->prepare("INSERT INTO comments (commentuserid, commentimageid, comment) VALUES (:commentuserid, :commentimageid, : comment)");
    $statement->bindValue(':commentuserid',$commentUserID);
    $statement->bindValue(':commentimageid', $commentImageID);
    $statement->bindValue(':comment', $commentText);
    $statement->execute();
}
?>