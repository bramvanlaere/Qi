<?php
include_once("../classes/Db.class.php");
session_start();
$conn = Db::getInstance();
$movieid = $_POST['newReport'];



$statement = $conn->prepare("insert into inappropriate(userid,postid) VALUES (:userid,:postid)");
$statement->bindValue(':userid',$_SESSION['userid']);
$statement->bindValue(':postid',$movieid);
$res = $statement->execute();
return $res;


?>