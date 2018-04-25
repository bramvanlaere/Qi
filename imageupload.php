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
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<h2>Upload an image</h2>
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