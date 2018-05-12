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
    $followers=$profile->getFollowCount($userID);
    $follow=$profile->getFollowerCount($userID);
    $postcount=$profile->getPostCount($userID);



    $username = $r['email'];
    $bioText = $r['bio'];
    $avatar = $r['avatar'];
    $userID = $r['id'];

if($_SESSION['userid']===$_SESSION['targetUserID']){
        $show="show";
        $btnClass="";
        $btnText="";
        $feed = new User();
        $res = $feed->getProfileFeed($userID);

}else   {
        $show="";
        if ($profile->followCheck()) {
            $btnClass = "btnUnfollow";
            $btnText = "FOLLOWING";
            $feed = new User();
            $res = $feed->getProfileFeed($userID);

        } else {
            // als hij nog niet gevolgd wordt, geen feed, wel boodschap.
            $btnClass = "btnFollow";
            $btnText = "Follow";
            $feed = new User();
            $res = $feed->getProfileFeed($userID);
        }

}

}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/cssgram.min.css">
    <title>Profile</title>
</head>
<body>
<?php include_once ('includes/nav.inc.php');?>

<div  style="padding-top: 120px; id="box">
<div class="profileInfo">
    <img class="profilePhoto" src="<?php echo $avatar?>" alt="profile photo">
    <div class="profileDetails">
        <div class="editProfile">
            <p class="userName"><?php echo $username; ?></p>

            <button id="<?php echo $show?>" class="<?php echo $btnClass; ?>"><?php echo $btnText; ?></button>
        </div>

        <p class="userDescription"><?php echo $bioText; ?></p>

        <ul class="userStats">
            <li><span><?php echo $postcount; ?></span> posts</li>
            <li><span><?php echo $follow?></span> followers</li>
            <li><span><?php echo $followers?></span> following</li>
        </ul>

    </div>

</div>

<main class="feedContainer">

    <div class="profileFeed">

        <?php foreach($res as $post): ?>
            <a href="postDetail.php?imageID=<?php echo $post['id']; ?>">
                <div class="feedBox">

                        <img class="<?php echo $post['filter'];?>" src="<?php echo $post['filelocation']; ?>" alt="">

                    <div class="overlay">
                        <div class="likes">
                            <img class="overlay-icon"src="images/heart_blank.png" alt="">
                            <p>
                                <?php
                                $likes = new postDetails();
                                $likecount = $likes->getLikes($post['id']);
                                echo $likecount;
                                ?>
                            </p>
                        </div>
                    </div>
                    <a href="postupdate.php?imageID=<?php echo $post['id']; ?>">bewerken</a>
                    <a onclick="return confirm('Ben je zeker dat je deze post wil verwijderen')" href="deletePost.php?imageID=<?php echo $post['id']; ?>">verwijderen</a>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
    <a href="imageupload.php" id="floatingBtn">+</a>
</main>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</body>
</html>