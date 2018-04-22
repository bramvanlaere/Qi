<?php
 include_once("classes/User.class.php");
 include_once("classes/Db.class.php");

session_start();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">

    <h2>Avatar</h2>
    <hr>
    <div class="feedback">
        <!--<p><?php echo $feedback; ?></p>-->
    </div>
    <form action="classes/User.class.php" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="inputAvatar3" class="col-sm-2 col-form-label">Choose new avatar:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputavatar33" placeholder="New avatar" name="avatar">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Upload avatar</button>
            </div>
        </div>
    </form>


    <h2>Change email</h2>
    <hr>
        <div class="feedback">
            <!--<p><?php echo $feedback; ?></p>-->
        </div>
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="inputNewEmail3" class="col-sm-2 col-form-label">Give new email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputNewEmail3" placeholder="New email" name="newEmail">
                         </div>
                </div>

                <div class="form-group row">
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                        </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Change email</button>
                    </div>
                </div>
            </form>


    <h2>Change Password</h2>
    <hr>
    <div class="feedback">
        <!--<p><?php echo $feedback; ?></p>-->
    </div>
    <form action="" method="POST">
        <div class="form-group row">
            <label for="inputNewPassword3" class="col-sm-2 col-form-label">Give new password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputNewPassword3" placeholder="New password" name="newPassword">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputNewPassword3" class="col-sm-2 col-form-label">Confirm new password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputNewPassword3" placeholder="New password" name="confirmNewPassword">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Give old password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="oldPassword">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Change password</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>