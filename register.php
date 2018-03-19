<?php

include_once("classes/User.class.php");

    if( !empty($_POST) ) {


        if($_POST['password'] == $_POST['password_confirmation']){
       

                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                if($user->register()){
                    $user->login();
                }
        }
            }
            
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>

<h2>register</h2>

<form action="" method="post">
<input type="text" id="firstname" name="firstname" placeholder ="firstname">
<input type="text" id="lastname" name="lastname" placeholder="lastname">
<input type="text" id="email" name="email" placeholder="Email">
<input type="text" id="password" name="password" placeholder="Password">
<input type="text" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
<input type="submit" id="submit" value="Register">
</form>
    
</body>
</html>