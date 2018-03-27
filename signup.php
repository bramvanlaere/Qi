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
        } else{
            $feedback = "Something went wrong.";
        }
<<<<<<< HEAD

    }

}
=======
        
    }

 }
>>>>>>> origin/master
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
<<<<<<< HEAD
<div class="container">
    <h2>Register</h2>
    <div class="feedback">
        <!--<p><?php echo $feedback; ?></p>-->
    </div>
    <form action="" method="POST">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </small>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm password" name="password_confirmation">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputFirstname3" class="col-sm-2 col-form-label">Firstname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputFirstname3" placeholder="Firstname" name="firstname">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputLastname3" class="col-sm-2 col-form-label">lastname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputLastname3" placeholder="Lastname" name="lastname">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </div>


    </form>
=======
    <div class="container">
        <h2>Register</h2>
        <div class="feedback">
            <!--<p><?php echo $feedback; ?></p>-->
        </div>
        <form action="" method="POST">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                    </div>
            </div>

  <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                         Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </small>
            </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm password" name="password_confirmation">
            </div>
    </div>

    <div class="form-group row">
        <label for="inputFirstname3" class="col-sm-2 col-form-label">Firstname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputFirstname3" placeholder="Firstname" name="firstname">
            </div>
    </div>

    <div class="form-group row">
        <label for="inputLastname3" class="col-sm-2 col-form-label">lastname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputLastname3" placeholder="Lastname" name="lastname">
            </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
  </div>


        </form>
>>>>>>> origin/master
</div>




</body>
</html>