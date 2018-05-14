<?php
    include_once ("classes/Db.class.php");
    include_once ("includes/session.inc.php");
    include_once ("classes/User.class.php");
    include_once ("classes/postDetails.class.php");
    include_once ("classes/Post.class.php");


    $userid = $_SESSION['userid'];
    $f = new User();
    $r=$f->getFeed($userid);
    $a=new postDetails();
    $s = $f->popularUsers();




    if (isset($_POST['report'])){
        $p = new Post();
        $postId = $_POST['postid'];
        $p->setPostId($postId);
        $p->newInappropriate();
        $id = $postId;

    }

    if (isset($_POST['undoreport'])){
        $p = new Post();
        $postId = $_POST['postid'];
        $p->setPostId($postId);
        $p->delInappropriate();
    }











?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/cssgram.min.css">
    <title>Qi</title>
</head>
<body>
<?php include_once("includes/nav.inc.php"); ?>
<?php if (User::getFollowCount($_SESSION['userid'])<1): ?>
<div class="suggested" style="margin-top: 5%; width: 37%; margin-left: 33.5% ">
    <h4>Suggested Friends</h4>
    <hr>

    <?php foreach($s as $user) :  ?>
        <div class="users" style="display: block; float: left; margin-left: 10px; width: 130px; text-align: center; height: 180px; font-family: Oswald; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <img src="<?php echo $user['avatar']?>" style="width: 120px; height: 120px; border-radius: 100%" alt="profilepic">
            <a href="profile.php?userID=<?php echo $user['id']; ?>"><?php echo $user['firstname'],"<br> ",$user['lastname']?></a>
        </div>

    <?php endforeach; ?>





</div>
<?php endif ?>

<div class="indexFeed col-lg-4 mx-auto" style="margin-top: 80px;font-family: Oswald;">
        <?php foreach($r as $post): $b=$a->getAvatar($post['id']); ?>
            <?php
            $report = new Post();

            $reportCheck = $report->userInappropriate($post['id']);


            if($reportCheck == 0)
            {

                $class = "report";
            }
            else
            {

                $class = "unreport";
            }

            ?>
            <?php if (Post::countInappropriate($post['id']) === false):?>
            <div class="post__user">
                <form action="" method="post">
                    <button  style="border-radius: 15px; color: whitesmoke; background-color: #c61c18; float: right; border: none;" class="btn-btn-primary-<?php echo $class; ?>" name="report" id="report" value="<?php echo $post['id'] ?>"><?php echo $class; ?></button>
                    <span><?php echo Post::countInappropriate($post['id']); ?></span>
                    <input type="hidden" name="postid" id="postid" value="<?php echo $post['id']?>">
                </form>
                <h4 class=""><img style="height: 75px; width: 75px; border-radius: 100px;" src="<?php echo $b['avatar'];?>"><a class="" href="profile.php?userID=<?php echo $post['imageuserid'];?>"><?php echo $post['user']?></a></h4>
                <h6 style="color: grey;font-size: small;"><?php echo $post["location"]?></h6>
             </div>
            <div class="">
                <img style="width: auto; max-width: 100%;height: auto;" class="<?php echo $post['filter'];?>" src="<?php echo $post['filelocation']?>" alt="">
             </div>
                <span><?php echo $post['besch']?></span>
            <p>
                <?php
                $likeCounter = new postDetails();
                $likes = $likeCounter->getLikes($post['id']);
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
                <ul class="commentsList<?php echo $post['id']; ?>">
                    <?php
                    $singlePost = new postDetails();
                    $email = $singlePost->GetEmail($post['id']);
                    $comments = $singlePost->getComments($post['id']);
                    ?>
                    <input type="hidden" class="imageID<?php echo $post['id']; ?>" value="<?php echo $post['id']; ?>">
                    <input type="hidden" class="userID" value="<?php echo $_SESSION['userid']; ?>">
                    <input type="hidden" class="email" value="<?php echo $_SESSION['user']; ?>">




                    <?php foreach( $comments as $comment): ?>
                        <li>
                            <a href="profile.php?userID=<?php echo $comment['commentuserid']; ?>">
                                <?php
                                $user = new User();
                                $email=$user->getProfile($comment['commentuserid']);
                                echo $email['email'];
                                ?></a>
                            <span class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="feedFooterBottom">
                    <?php
                    $like = new postDetails();

                    $likeCheck = $like->likeCheck($post['id']);


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
                <img class="likeHeart <?php echo $class; ?> "src="<?php echo $source; ?>" alt="like" value="<?php echo $post['id'] ?>">
            <input class="commentField<?php echo $post['id']; ?>" type="text" name="commentField" placeholder="Add a comment...">
            <input class="comment-btn-submit" type="submit" value="<?php echo $post['id']; ?>"
                   style="position: absolute; left: -9999px"/>
            </form>
                <p style="color: grey;font-size: small;">
                    <?php
                    $timestamp = new postDetails();
                    $timestamp = $timestamp->getPostHour($post['id']);
                    echo $timestamp;

                    ?>
                </p>


            <?php endif?>
            
            <hr>
<?php endforeach;?>
    </div>
</div>

<footer>
<button style="border: none; background-color:grey;font-family: Oswald;color: whitesmoke; margin-left: 50%;margin-right: 50%;" class="btnLoadMore btn btn-dark">Load More</button>
</footer>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

<script src="js/app.js"></script>
</body>
</html>