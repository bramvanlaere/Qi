<?php
    include_once ("classes/Db.class.php");
    include_once ("includes/session.inc.php");
    include_once ("classes/User.class.php");
    include_once ("classes/postDetails.class.php");
    include_once ("classes/Post.class.php");

    $userid = $_SESSION['userid'];
    $f = new User();
    $r=$f->getFeed($userid);
    $_SESSION['offset'] = 0;




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
    <title>Qi</title>
</head>
<body>
<?php include_once("includes/nav.inc.php"); ?>

<div class="indexFeed col-lg-4 mx-auto" style="margin-top: 80px;font-family: Oswald;">
    <?php $i = 0 ?>

        <?php foreach($r as $post): ?>
        <?php $i++ ?>
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
            <div class="post__user" >
                <form action="" method="post">

                        <button class="btn-btn-primary-<?php echo $class; ?>" name="report" id="report" value="<?php echo $post['id'] ?>"><?php echo $class; ?></button>


                    <span><?php echo Post::countInappropriate($post['id']); ?></span>
                    <input type="hidden" name="postid" id="postid" value="<?php echo $post['id']?>">
                </form>
                <h4 class=""><a class="" href="profile.php?userID=<?php echo $post['imageuserid'];?>"><?php echo $post['user']?></a></h4>
                <img src="<?php echo $post['avatar']?>" alt="">
             </div>
            <div class="">
                <img class="" src="<?php echo $post['filelocation']?>" alt="">
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
                    <input type="hidden" class="imageID<?php echo $i; ?>" value="<?php echo $post['id']; ?>">
                    <input type="hidden" class="userID" value="<?php echo $_SESSION['userid']; ?>">
                    <input type="hidden" class="username" value="<?php echo $_SESSION['user']; ?>">




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
                <img class="likeHeart <?php echo $class; ?> "src="<?php echo $source; ?>" alt="like"
                     value="<?php echo $post['id'] ?>">
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
<button class="btnLoadMore">Load More</button>
</footer>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

<script src="js/app.js"></script>
</body>
</html>