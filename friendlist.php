<?php

    //temp hardcoded friendlist
$tempfriendlist=array(

    "bram@vanlaere.org",
    "tokke@ronaldo.com",
    "its@yaboy.com"

);


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>friendlist</h1>
<ul>
<?php foreach ($tempfriendlist as $res):?>
    <li><a href="#"><?php echo " ".$res ?></a></li>
<?php endforeach;?>
</ul>
</body>
</html>