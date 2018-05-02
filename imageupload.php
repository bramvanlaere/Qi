<?php
    include_once ('classes/Db.class.php');
    include_once ('classes/Post.class.php');
    session_start();
        if(isset($_SESSION['loggedin'])){

            if(!empty($_POST)){

                $besch=$_POST["besch"];

                $p = new Post();
                $p->moveImage();
                $p->setBesch($besch);
                $p->savePost();
            }


        }
        else{
            header('Location: login.php');
        }








?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div style="margin-top: 60px";><h4>Upload an image</h4></div>
<div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file"  name="file" id="fileUpload" />
        <br>
        <textarea id="beschrijving" rows="5" cols="40" name="besch" id="comment"></textarea>
        <br />

        <input type="submit" name="submit" value="upload!" />

        <?php
        if( isset($error) ) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </form>
</body>
</html>