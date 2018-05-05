<?php
include_once('includes/session.inc.php');
include_once('classes/Db.class.php');
include_once ('classes/postDetails.class.php');
include_once ('classes/User.class.php');

if(isset($_GET['txtSearch'])) {
    $conn = Db::getInstance();
    $searchKeyword = $_GET['txtSearch'];
    $results = array();
    $statement = $conn->prepare("SELECT * FROM posts WHERE besch LIKE :keywords OR user LIKE :keywords ORDER BY id DESC");
    $statement->bindValue(':keywords', '%' . $searchKeyword . '%');
    $statement->execute();

    if($statement->rowCount() >= 1){
        $results = $statement->fetchAll();
        $countPosts = $statement->rowCount();
    }
    else
    {
        $errorMessage = "Helaas, we vonden geen posts die gelijk zijn aan de zoekterm: ".$_GET['txtSearch'];
    }

}

?><!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/feed.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<?php include_once("includes/nav.inc.php"); ?>

<body>

<div class="indexFeed col-lg-4 mx-auto" style="margin-top: 80px;font-family: Oswald;">

    <h1><?php if(isset($errorMessage)){ echo $errorMessage;} ?></h1>

    <h2><?php if(isset($countPosts)){echo $_GET['txtSearch'];} ?></h2>
    <h3><?php if(isset($countPosts)){echo "<span>".$countPosts."</span>"." posts";} ?></h3>
        <?php foreach($results as $res): ?>

    <div class="post__user" >
        <form action="" method="post">
            <input type="hidden" name="postid" id="postid" value="<?php echo $res['id']?>">
        </form>
        <h4 class=""><a class="" href="profile.php?userID=<?php echo $res['imageuserid'];?>"><?php echo $res['user']?></a></h4>
        <img src="<?php echo $res['avatar']?>" alt="">
    </div>
    <div class="">
        <img class="" src="<?php echo $res['filelocation']?>" alt="">
    </div>
    <p>
        <?php
        $likeCounter = new postDetails();
        $likes = $likeCounter->getLikes($res['id']);
        if($likes == 0) {
            echo "No likes this yet";
        }
        elseif($likes == 1)
        {
            echo $likes." Like";
        }
        else
        {
            echo $likes." Likes";
        }
        ?>
    </p>
    <div style="padding: auto;">
        <ul class="commentsList<?php echo $i; ?>">
            <?php
            $singlePost = new postDetails();
            $email = $singlePost->getEmail($res['id']);
            $comments = $singlePost->getComments($res['id']);
            ?>
            <input type="hidden" class="imageID<?php echo $i; ?>" value="<?php echo $post['id']; ?>">
            <input type="hidden" class="userID" value="<?php echo $_SESSION['userid']; ?>">
            <input type="hidden" class="email" value="<?php echo $_SESSION['user']; ?>">

            <a href="profile.php?userID=<?php echo $res['imageuserid']; ?>"></a>

            <?php foreach( $comments as $comment): ?>
                <li>
                    <a href="profile.php?userID=<?php echo $comment['commentuserid']; ?>">
                        <?php
                        $user = new User();
                        $r=$user->getProfile($comment['commentuserid']);
                        $email = $r['email'];
                        echo $email;
                        ?></a>
                    <span class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="card-text">
            <p><?php echo $res['besch']?></p>
        </div>
        <div class="feedFooterBottom">
            <?php
            $like = new postDetails();

            $likeCheck = $like->likeCheck($res['id']);


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

            ?>
        </div>
    </div>
    <form>
        <img class="likeHeart <?php echo $class; ?> "src="<?php echo $source; ?>" alt="like"
             value="<?php echo $res['id'] ?>">
        <input class="commentField<?php echo $i; ?>" type="text" name="commentField" placeholder="Add a comment...">
        <input class="comment-btn-submit" type="submit" value="<?php echo $i; ?>"
               style="position: absolute; left: -9999px"/>
    </form>
    <p style="color: grey;font-size: small;">
        <?php
        $timestamp = new postDetails();
        $timestamp = $timestamp->getPostHour($res['id']);
        echo $timestamp;
        ?>
    </p>


    <?php endforeach;?>




</body>
</html>