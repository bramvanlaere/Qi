<?php
    include_once ("classes/Db.class.php");
    include_once ("includes/session.inc.php");
    include_once ("classes/User.class.php");

    $userid = $_SESSION['userid'];
    $f = new User();
    $r=$f->getFeed($userid);







?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qi</title>
</head>
<body>
<?php include_once("includes/nav.inc.php"); ?>


<h2>Welcome></h2>
<a href="Accountsettings.php">Account</a>
<a href="friendlist.php">current friends</a>

<h2><?php echo $_SESSION['userid'];?></h2>

<div class="content">
    <?php $conn=Db::getInstance(); // voor het moment is de feedhardcoded samen met de friendlist deze gaat nog naar oop omgezetworden ?>
    <?php $q="SELECT * FROM POSTS";?>
    <?php $statement=$conn->prepare($q);?>
    <?php $statement->execute();?>
    <?php while ($res = $statement->fetch(PDO::FETCH_ASSOC)) :?>
        <h2><a href="#"><?php echo $res['user']?></a></h2>
        <img src="<?php echo $res['filelocation']?>" alt="">
        <p><?php echo $res['besch']?></p>
    <?php endwhile; ?>

<?php foreach($r as $post): ?>
    <h2><a href="#"><?php echo $post['user']?></a></h2>
    <img src="<?php echo $post['filelocation']?>" alt="">
    <p><?php echo $post['besch']?></p>
<?php endforeach;?>

<button class="btnLoadMore">Load More</button>

</body>
</html>