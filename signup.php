<?php

include_once("classes/User.class.php");
$feedback="";
if( !empty($_POST) ) {
$email = $_POST['email'];
$feedback = "";
$defaultAvatar = "avatars/default.jpg";
if (User::userExists($email) == true) {
    if ($_POST['password'] == $_POST['password_confirmation']) {


        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        if (empty($_POST['firstname'])){
            $feedback = "Please fill in your firstname";
        }
        else if (empty($_POST['lastname'])){
            $feedback = "Please fill in your lastname";
        }
        else{

        if($user->register($defaultAvatar)){
            $user->login();
        } else {
            $feedback = "Something went wrong.";
        }
    }

    }
} else{
    $feedback = "Email already in use";
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
</div>
<div class="container">
    <h2>Sign up</h2>
    <div class="feedback">
        <p><?php echo $feedback; ?></p>
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
            <p>Already an account? Login <a href="login.php">Here</a> </p>
        </div>

    </form>
</div>




</body>
</html>