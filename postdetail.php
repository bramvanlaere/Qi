<?php
include_once ("includes/session.inc.php");
include_once ("classes/postDetails.class.php");
include_once ("classes/user.class.php");
include_once ("classes/Post.class.php");

require 'vendor/autoload.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

$_SESSION['imageID'] = $_GET['imageID'];

if(isset($_GET['imageID'])){
    $post = new postDetails();
    $image = $post->getImage($_GET['imageID']);
    $avatar = $post->getAvatar($_GET['imageID']);
    $email = $post->getEmail($_GET['imageID']);
    $postTime = $post->getPostHour($_GET['imageID']);
    $likeCount = $post->getLikes($_GET['imageID']);
    $userID = $post->getUserID($_GET['imageID']);
    $description = $post->getDescription($_GET['imageID']);
    $comments = $post->getComments($_GET['imageID']);
    $colors= new Post();

    $likeCheck = $post->likeCheck($_GET['imageID']);
    if($likeCheck)
    {
        $source = "images/heart_filled.png";
        $class = "btnUnlike";
    }
    else
    {
        $source = "images/heart_blank.png";
        $class = "btnLike";
    }
}


$i = "";

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body class="col-lg-4 mx-auto" style="border-bottom: #c61c18 solid 4px; font-family: Oswald; margin-bottom: 30px;">
<?php include_once ("includes/nav.inc.php")?>
<div style="padding-top: 100px;">
    <img src="<?php echo $image['filelocation']; ?>" alt="">
    <?php

    if($colors->checkPostidColor($_SESSION['imageID'])){

        $colors->SaveColors($image['filelocation'],$_SESSION['imageID']);

    }
    else{

    }
    $c=$colors->showColors($_SESSION['imageID']);



    ?>

</div>
<a href="profile.php?userID=<?php echo $userID['imageuserid']; ?>"><img style="height: 40px;width:40px;border-radius: 40px; margin-top:10px; display: inline-block;" src="<?php echo $avatar['avatar']; ?>" alt=""></a>
<a href="profile.php?userID=<?php echo $userID['imageuserid']; ?>"><p class="name<?php echo $i ?> namePostDetail"><?php echo $email['email']; ?></p></a>
<span class="comment-text"><?php echo $description['besch']; ?></span>
<p class="timestamp"><?php echo $postTime ?></p>
<?php foreach ($c as $col){
    echo "<div style='float: right; width: 20px;height: 20px; background-color:". $col['color']."'></div>";

}?>
<hr>

        <p class="likes"><?php

            if($likeCount == 0) {
                echo "No likes yet";
            }
            elseif($likeCount == 1)
            {
                echo $likeCount." Like";
            }
            else
            {
                echo $likeCount." Likes";
            }
            ?>
        </p>


<div class="commentFeed">
    <ul class="commentsList">
        <?php foreach( $comments as $comment): ?>
            <li>
                <a href="profile.php?userID=<?php echo $comment['commentuserid']; ?>">
                    <?php
                    $user = new User();
                    $email=$user->getProfile($comment['commentuserid']);;
                    echo $email['email'];
                    ?></a>
                <span class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></span>
            </li>

        <?php endforeach; ?>
    </ul>
</div>

</body>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="js/app.js">


</script>
</html>