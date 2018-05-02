<?php
include_once("includes/session.inc.php");
include_once ("classes/User.class.php");

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div>
    <div style="margin-top: 40px; class="editDetails">
        <h1>Avatar uploaden</h1>
        <img style="height: 50px;
	width: 50px;
	border-radius: 50%;" src="<?php echo $_SESSION['avatar'] ;?>" alt="avatar">

        <form class="formUpload" action="" enctype="multipart/form-data" method="post">
            <label for="avatar">Avatar uploaden:</label>

            <input type="file" name="file" id="avatar">

            <input class="btnUpload" type="submit" name="upload" value="Upload">
        </form>
        <?php echo $_SESSION['user'];?>


        <h1>Profiel bewerken</h1>

        <form class="formDetails formPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="email">E-mailadres:</label>
            <input type="email" name="editEmail"></br>

            <label for="bio">Biografie:</label>
            <textarea name="editBio" maxlength="150" id="bio" cols="30" rows="5"></textarea></br>

            <?php
            if( isset($messageUpdate) ) {
                echo "<p class='messageUpdate'>$messageUpdate</p>";
            }
            ?>

            <h1>Wachtwoord wijzigen</h1>

            <label for="oldpassword">oud wachtwoord:</label>
            <input type="password" name="oldpassword"></br>

            <label for="newpassword">Nieuw wachtwoord:</label>
            <input type="password" name="newPassword"></br>

            <label for="confirmnewpassword">Nieuw wachtwoord bevestigen:</label>
            <input type="password" name="confirmNewPassword"></br>

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

            <input class="submitEdit" name="update" type="submit" value="Gegevens wijzigen">
        </form>
    </div>
</body>
</html>