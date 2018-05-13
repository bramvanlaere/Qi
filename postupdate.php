<?php

include_once("includes/session.inc.php");
include_once("classes/Post.class.php");
include_once("classes/postDetails.class.php");



$post = new Post();
$postid = $_GET['imageID'];
$userID = $_SESSION['targetUserID'];


if (isset ($_POST['submitUpdate'])){

    $post->moveImage();

    $beschrijving=$_POST['besch'];
    $post->setBesch($beschrijving);
    $post->updatePost($postid);
    header('Location: profile.php?userID='.$userID);


}
$getUserPost = $post->getUserPost($postid);
$besch = $getUserPost['besch'];

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="updatePost">
    <p><img src="<?php echo $getUserPost ['filelocation']; ?>"/> </p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?imageID=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file" />
        <br>
        <textarea id="besch" rows="5" cols="40" name="besch"><?php echo $besch; ?></textarea>
        <br />

        <input type="submit" name="submitUpdate" value="upload!" />

    </form>
</div>
</body>
</html>