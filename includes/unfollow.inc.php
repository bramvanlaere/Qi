<?php
session_start();
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', 'root');
if(!empty($_SESSION['targetUserID'])){
    $userID = $_SESSION['userid'];
    $friendid = $_SESSION['targetUserID'];
    $statement = $conn->prepare('delete from friendlist where userid = :userid and friendid = :friendid');
    $statement->bindValue(':userid', $userID);
    $statement->bindValue(':friendid', $friendid);
    $statement->execute();
    if($statement->execute()){

        echo "unfollowed";
    };
}
?>