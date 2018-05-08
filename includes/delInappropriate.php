<?php
include_once("../classes/Db.class.php");
session_start();
$conn = Db::getInstance();
$movieid = $_POST['delReport'];



$statement = $conn->prepare("delete from inappropriate WHERE postid = :postid and userid = (SELECT id FROM users WHERE email = :email)");
$statement->bindValue(':email',$_SESSION['user']);
$statement->bindValue(':postid',$movieid);
$res = $statement->execute();
return $res;


?>