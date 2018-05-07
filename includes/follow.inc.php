<?php
session_start();
$conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');

if(!empty($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    $friendid = $_SESSION['targetUserID'];
    $statement = $conn->prepare('insert into friendlist (userid, friendid) values (:userid, :friendid)');
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':friendid', $friendid);
    if($statement->execute()){
        echo "followed";
    };
}
?>