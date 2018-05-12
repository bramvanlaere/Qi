<?php

    session_start();

    $array= $_SESSION['friendarray'];

    $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', 'root');


    $statement = $conn->prepare("SELECT * FROM `posts` WHERE imageuserid = :array order by TIMESTAMP DESC LIMIT :getal OFFSET :offset");
    $statement->bindParam(':array',$array);
    $statement->bindValue(':getal',$_SESSION['getal'], PDO::PARAM_INT);
    $statement->bindValue(':offset',$_SESSION['offset'], PDO::PARAM_INT);
    $lel=$statement->execute();
    $res=$statement->fetch();




        echo json_encode($res);




?>