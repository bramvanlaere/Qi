<?php

include_once ("includes/session.inc.php");
include_once ("classes/User.class.php");
include_once ("classes/Comment.class.php");
include_once ("classes/postDetails.class.php");

if(!empty($_GET)) {

    $userID = $_GET['userID'];
    $_SESSION['targetUserID'] = $_GET['userID'];

    $profile = new User();
    $r=$profile->getProfile($userID);


    $username = $r['email'];
    $bioText = $r['bio'];
    $avatar = $r['avatar'];
    $userID = $r['id'];

    $feed = new User();
    $res=$feed->getProfileFeed($userID);


}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>



<div class="profileInfo">
    <img class="profilePhoto" src="" alt="profile photo">
    <div class="profileDetails">
        <div class="editProfile">
            <p class="userName"><?php echo $username; ?></p>

            <button></button>
        </div>

        <p class="userDescription"><?php echo $bioText; ?></p>

        <ul class="userStats">
            <li><span></span> posts</li>
            <li><span></span> followers</li>
            <li><span></span> following</li>
        </ul>

    </div>

</div>

<main class="feedContainer">

    <div class="profileFeed">

        <?php foreach($res as $post): ?>
            <a href="postDetail.php?imageID=<?php echo $post['id']; ?>">
                <div class="feedBox">

                        <img src="<?php echo $post['filelocation']; ?>" alt="">

                    <div class="overlay">
                        <div class="likes">
                            <img class="overlay-icon"src="images/white_heart.png" alt="">
                            <p>
                            </p>
                        </div>
                        <div class="comments">
                            <img class="overlay-icon" src="images/comments.png" alt="">
                            <p>
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