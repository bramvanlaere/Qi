<?php

include_once ("includes/session.inc.php");
include_once ("classes/User.class.php");
include_once ("classes/Comment.class.php");
include_once ("classes/postDetails.class.php");

if(!empty($_GET)) {

    $userID = $_GET['userID'];
    $_SESSION['targetUserID'] = $_GET['userID'];





}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<div class="profileInfo">
    <img class="profilePhoto" src="<?php echo $avatar; ?>" alt="profile photo">
    <div class="profileDetails">
        <div class="editProfile">
            <p class="userName"><?php echo $username; ?></p>

            <button id="" class="<?php echo $btnClass; ?>"><?php echo $btnText; ?></button>
        </div>

        <p class="userDescription"><?php echo $bioText; ?></p>

        <ul class="userStats">
            <li><span><?php echo $feed->PostCount; ?></span> posts</li>
            <li><span><?php echo $profile->FollowerCount; ?></span> followers</li>
            <li><span><?php echo $profile->FollowCount; ?></span> following</li>
        </ul>

    </div>

</div>

<main class="feedContainer">

    <div class="profileFeed">

        <span class="privacyMessage"><?php if(isset($privacyMessage)){echo $privacyMessage;} ?></span>
        <?php foreach($feed->Results as $post): ?>
            <a href="postDetail.php?imageID=<?php echo $post['imageID']; ?>">
                <div class="feedBox">
                    <figure class="<?php echo $post['filter']; ?>">
                        <img src="<?php echo $post['fileLocation']; ?>" alt="">
                    </figure>
                    <div class="overlay">
                        <div class="likes">
                            <img class="overlay-icon"src="images/white_heart.png" alt="">
                            <p>
                                <?php
                                $likes = new postDetail();
                                $likecount = $likes->getLikes($post['imageID']);
                                echo $likecount;
                                ?>
                            </p>
                        </div>
                        <div class="comments">
                            <img class="overlay-icon" src="images/comments.png" alt="">
                            <p>
                                <?php
                                $comments = new postDetail();
                                $commentCount = $comments->countComments($post['imageID']);
                                echo $commentCount;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="loadMoreContainer">

        <button class="btnLoadMore">Load More</button>

    </div>
    <a href="imageupload.php" id="floatingBtn">+</a>
</main>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>