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


<?php foreach($r as $post): ?>
    <h2><a href="#"><?php echo $post['user']?></a></h2>
    <img src="<?php echo $post['filelocation']?>" alt="">
    <p><?php echo $post['besch']?></p>
<?php endforeach;?>

<button class="btnLoadMore">Load More</button>

</body>
</html>