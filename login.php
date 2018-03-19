<?php

    include_once("classes/User.class.php");

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        if($user->Loginfunc()){
            $user->login();
        }
        else{

            $error=true;

        }

    }





?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<form action="" method="post">
<input type="text" name="email" id="email" placeholder="Email">
<input type="text" name="password" id="password" placeholder="Password">
<input type="submit" value="Login">
</form>
    
</body>
</html>