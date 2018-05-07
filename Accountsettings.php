<?php
include_once("includes/session.inc.php");
include_once ("classes/User.class.php");
include_once ("includes/nav.inc.php");

$n=new User();
$n->showAvatar();

if(!empty($_POST)){
    if(isset($_POST['update'])){
        $editEmail = $_POST['editEmail'];
        $editBio = $_POST['editBio'];
        $_SESSION['bio'] = $_POST['editBio'];
        $oldPassword=$_POST['oldpassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        if(!empty($editBio) or !empty($editEmail))
        {
            $updateProfile = new User();
            $updateProfile->setEditemail($editEmail);
            $updateProfile->setEditbio($editBio);
            $updateProfile->updateProfile();

            $messageUpdate = "Your information was successfully updated.";

        }

        else
        {
            $messageEmptySubmit = "We could not change your information. Try again!";
        }


        if(!empty($newPassword) or !empty($confirmNewPassword) or !empty($oldPassword)) {
            $user = new User();
            $user->setPassword($oldPassword);
            if ($user->checkpass())
            {

                if (strcmp($newPassword, $confirmNewPassword) == 0) {
                    $updatePassword = new User();
                    $updatePassword->setEditpassword($confirmNewPassword);
                    $updatePassword->updatePassword();

                    $passwordSucces = "Your password was successfully changed.";
                }

                else {
                    $passwordError = "Woops, passwords do not match. Try again!";
                }
            }else{
                $passwordError ="old password doesn't seem to fit this account hackerboy";
            }
        }
        else {
            $passwordError="please fill in all fields";
        }
     }

    /*avatar uploaden aan de hand van img*/
     if(isset($_POST['upload'])){

             $p = new User();
             $p->moveAvatar();
             $p->saveAvatar();




     }
    }






?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/settings.css">
</head>

<body>



<div>

    <div class="editProfile">

        <img src="<?php echo $_SESSION['avatar'] ;?>" alt="avatar">

        <form class="formUpload" action="" enctype="multipart/form-data" method="post">
            <label for="avatar">Change profile picture:</label>

            <input type="file" name="file" id="avatar">

            <input class="btnUpload" type="submit" name="upload" value="Upload" id="upload">
        </form>



        <h1>Edit profile</h1>

        <form class="formDetails formPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="email">Email:</label>
            <input type="email" name="editEmail" placeholder="<?php echo $_SESSION['user'];?>" id="email"></br>

            <label for="bio">Bio:</label>
            <textarea name="editBio" maxlength="150" id="bio" cols="30" rows="5"></textarea></br>

            <?php
            if( isset($messageUpdate) ) {
                echo "<p class='messageUpdate'>$messageUpdate</p>";
            }
            ?>

            <h1>Change password</h1>


            <input type="password" name="oldpassword" placeholder="Old password..."></br>


            <input type="password" name="newPassword" placeholder="New password..."></br>


            <input type="password" name="confirmNewPassword" placeholder="Repeat new password"></br>

            <?php
            if( isset($passwordSucces) )
            {
                echo "<p class='messageUpdate'>$passwordSucces</p>";
            }
            else if( isset($passwordError) )
            {
                echo "<p class='messageUpdateError'>$passwordError</p>";
            }
            else if( isset($messageEmptySubmit) )
            {
                echo "<p class='messageUpdateError'>$messageEmptySubmit</p>";
            }
            ?>

            <input class="submitEdit" name="update" type="submit" value="Submit" id="submit">
        </form>
    </div>
</div>
</body>
</html>