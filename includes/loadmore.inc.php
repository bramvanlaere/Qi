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

    $nolimit = $conn->prepare("SELECT * FROM `posts` WHERE imageuserid = :array order by TIMESTAMP DESC");
    $nolimit->bindParam(':array',$array);
    $nolimit->execute();

    if ($_SESSION['offset'] <= $nolimit->rowCount() - 1 ) {
        $_SESSION['offset'] += 1;
        header('application/json');
        echo json_encode($res);
    } else {
        echo json_encode("No data");
    }

?>