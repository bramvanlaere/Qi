<?php

include_once("classes/User.class.php");

if( !empty($_POST) ) {


    if ($_POST['password'] == $_POST['password_confirmation']) {


        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        if ($user->register()) {
            $user->login();
        } else {
            $feedback = "Something went wrong.";
        }
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="welcome">
    <h1>Welcome to QI</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in condimentum nulla. Vestibulum eu scelerisque nibh. Nullam ligula mauris, aliquet.</p>
</div>
<div class="container">
    <h2>Sign up</h2>
    <div class="feedback">
        <!--<p><?php echo $feedback; ?></p>-->
    </div>
    <form action="" method="POST">
        <div class="email">

            <input type="email" class="email" id="email" placeholder="Email" name="email">
        </div>

        <div class="password">

            <input type="password" class="password" id="password" placeholder="Password" name="password">
        </div>

        <div class="repeatPassword">

                <input type="password" class="repeatPassword" id="repeatPassword" placeholder="Confirm password" name="password_confirmation">
        </div>


        <div class="firstname">

            <input type="text" class="firstname" id="firstname" placeholder="Firstname" name="firstname">
        </div>

        <div class="lastname">

            <input type="text" class="lastname" id="lastname" placeholder="Lastname" name="lastname">
        </div>

        <div class="submit">
                <button type="submit" class="submit">Sign Up</button>
        </div>

        <div class="login">
            <p>Already an account? Login <a href="../Qi-master-9/login.php">Here</a> </p>
        </div>

    </form>
</div>




</body>
</html>