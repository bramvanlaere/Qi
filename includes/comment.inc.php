<?php
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
//userID


$commentUserID = $_POST['userid'];
//commentID
$commentImageID = $_POST['imageid'];
//newComment
if(isset($_POST['newcomment'])){
    $commentText = $_POST['newcomment'];
}



if(!empty($commentText)) {
    $statement = $conn->prepare("INSERT INTO comments (commentuserid, commentimageid, comment) VALUES (:commentuserid, :commentimageid, : comment)");
    $statement->bindValue(':commentuserid',$commentUserID);
    $statement->bindValue(':commentimageid', $commentImageID);
    $statement->bindValue(':comment', $commentText);
    $statement->execute();
}
?>