<?php
    session_start();
        if(isset($_SESSION['loggedin'])){}
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
    
</body>
</html>