<?php
include_once ("includes/session.inc.php");
include_once ("classes/User.class.php");

    $p = new User();
    $c=$p->displayFriends($_SESSION['userid']);






?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Friendlist</title>
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>
<h1>friendlist</h1>
<ul>

<?php foreach ($c as $res):?>
    <li><a href="#"><?php echo $res['email'];?></a></li>
<?php endforeach;?>
</ul>
</body>
</html>