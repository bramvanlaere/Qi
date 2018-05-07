<?php
include_once ("includes/session.inc.php");
include_once ("classes/postDetails.class.php");
include_once ("classes/user.class.php");

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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
<?php include_once ("includes/nav.inc.php")?>
<div class="postDetail">
    <div class="innerLeft">
            <img src="<?php echo $image['filelocation']; ?>" alt="">

    </div>
    <div class="innerRight">
        <div class="innerRightContainer">
            <div class="innerRightHeader">
                <a href="profile.php?userID=<?php echo $userID['imageuserid']; ?>"><img class="avatarPostDetail" src="<?php echo $avatar['avatar']; ?>" alt=""></a>
                <a href="profile.php?userID=<?php echo $userID['imageuserid']; ?>"><p class="name<?php echo $i ?> namePostDetail"><?php echo $email['email']; ?></p></a>
            </div>
            <div class="innerRightSecondHeader">
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
                <p class="timestamp"><?php echo $postTime ?></p>
            </div>
            <div class="commentFeed">
                <ul class="commentsList">
                    <li><a href="profile.php?userID=<?php echo $comment['commentuserid']; ?>">
                            <?php echo $username['username']; ?>
                        </a>
                        <span class="comment-text"><?php echo $description['description']; ?></span>
                    </li>
                    <?php foreach( $comments as $comment): ?>
                        <li>
                            <a href="profile.php?userID=<?php echo $comment['commentUserID']; ?>">
                                <?php
                                $user = new Users();
                                $user->getProfile($comment['commentUserID']);
                                $username = $user->Username;
                                echo $username;
                                ?></a>
                            <span class="comment-text"><?php echo htmlspecialchars($comment['commentText']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="innerRightFooter">
                <form id="commentForm" class="innerRightFooterForm" action="" method="post">
                    <img id="heart" class="likeHeart <?php echo $class ?>" src="<?php echo $source ?>" alt="like"
                         value="<?php echo $_GET['imageID']; ?>">
                    <input class="commentField commentField<?php echo $i ?>" type="text" name="commentField" placeholder="Add a comment...">
                    <input class="comment-btn-submit" type="submit" style="position: absolute; left: -9999px" value="<?php echo $i ?>"/>
                </form>

                <span class="glyphicon glyphicon-trash" id="<?php echo $visible; ?>" aria-hidden="true" title="Verwijder je foto"></span>

            </div>
        </div>
    </div>
</div>
<input type="hidden" class="imageID<?php echo $i; ?>" value="<?php echo $_GET['imageID'].$i; ?>">
<input type="hidden" class="userID" value="<?php echo $_SESSION['userID']; ?>">
<input type="hidden" class="username" value="<?php echo $_SESSION['username']; ?>">
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scripts.js">


</script>
</html>