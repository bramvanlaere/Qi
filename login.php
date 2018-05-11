<?php

    include_once("classes/User.class.php");
    $feedback = "";

    if(!empty($_POST)){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        if($user->canLogin()){
            $user->login();
        } else {
            $feedback = "Sorry something went wrong! Please check your email or password.";
            $error=true;

        }

        if (empty($_POST['email'])){
            $feedback = "Please fill in your email.";
        } elseif (empty($_POST['password'])){
            $feedback = "Please fill in your password.";
        }




    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="welcome">
    <img class=logo src="images/qilogo.jpg" alt="logoqi">
</div>
<div class="container">
<h2>Login</h2>
<div class="login">
    <div class="feedback">
        <p> <?php echo $feedback;?> </p>
    </div>
<form action="" method="post">
    <div class="email">
<input type="text" name="email" id="email" placeholder="Email">
    </div>
    <div class="password">
<input type="password" name="password" id="password" placeholder="Password">
    </div>
    <div class="submit">
    <button type="submit" class="submit">Sign in</button>
    </div>
</form>
</div>
<br>
    <div class="signup">
    <p> <a href="signup.php">Don't have an account yet? Sign up right here !</a></p>
    </div>
</div>
</body>
</html>