<?php
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
//userID

$email=$_POST['userName'];

$commentUserID = $_POST['userID'];
//commentID
$commentPostID = $_POST['postID'];
//newComment
if(isset($_POST['newComment'])){
    $commentText = $_POST['newComment'];
}



if(!empty($commentText)) {
    $statement = $conn->prepare("INSERT INTO comments (commentuserid, comment, commentpostid, email) VALUES (:commentuserid, :comment, :commentpostid, :email)");
    $statement->bindValue(':commentuserid',$commentUserID);
    $statement->bindValue(':comment', $commentText);
    $statement->bindValue(':commentpostid', $commentPostID);
    $statement->bindValue(':email',$email);
    $res=$statement->execute();
    return $res;
}
?>