<?php
    include_once ("classes/Db.class.php");
    session_start();
        if(isset($_SESSION['loggedin'])){



        }
        else{
            header('Location: login.php');
        }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qi</title>
</head>
<body>

<h2>Welcome</h2>
<a href="friendlist.php">current friends</a>

<div class="content">
    <?php $conn=Db::getInstance(); // voor het moment is de feedhardcoded samen met de friendlist deze gaat nog naar oop omgezetworden ?>
    <?php $q="SELECT * FROM POSTS";?>
    <?php $statement=$conn->prepare($q);?>
    <?php $statement->execute();?>
    <?php while ($res = $statement->fetch(PDO::FETCH_ASSOC)):?>

        <img style="height: 400px;width: 450px;" src="<?php echo $res['filelocation']?>" alt="">
        <p><?php echo $res['besch']?></p>


    <?php endwhile;?>
</div>

</body>
</html>