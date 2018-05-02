
<?php
    include_once ("classes/Db.class.php");
    include_once ("includes/session.inc.php");
    include_once ("classes/User.class.php");
    include_once ("classes/Comment.class.php");
    include_once ("classes/postDetails.class.php");
    include_once ("classes/Like.class.php");

    $userid = $_SESSION['userid'];
    $f = new User();
    $r=$f->getFeed($userid);
    $_SESSION['offset'] = 0;


// add new comment
        if (isset($_POST['submit'])) {
            $c = new Comments();
            $text = $_POST['comment'];
            $postId = $_POST['postid'];
            $userId = $_SESSION['userid'];
            $c->setComments($comments);
            //$c->setPostId($postId);
            //$c->setUserId($userId);

            $c->saveComments();




        }
// likes
    if (isset($_POST['like'])){
            $l = new Like();
            $postId = $_POST['postid'];
            $userId = $_SESSION['userid'];
            $l->setPostId($postId);
            $l->Like();


    }

if (isset($_POST['unlike'])){
    $l = new Like();
    $postId = $_POST['postid'];
    $userId = $_SESSION['userid'];
    $l->setPostId($postId);
    $l->delLike();


}










?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Qi</title>
    </head>

    <body>
<?php include_once("includes/nav.inc.php"); ?>

            <div class="indexFeed col-lg-4 mx-auto" style="margin-top: 40px;font-family: Oswald;">
                <?php $i = 0 ?>

                    <?php foreach($r as $post): ?>
                        <?php $i++ ?>
                            <div class="post__user">
                                <h4 class=""><a href="profile.php?userID=<?php echo $post['imageuserid'];?>"><?php echo $post['user']?></a></h4>
                                <img src="<?php echo $post['avatar']?>" alt="">
                            </div>
                            <div class="image">
                                <img src="<?php echo $post['filelocation']?>" alt="">
                            </div>
                            <div style="padding: auto;">
                                <div class="card-text">

                                    <p>
                                        <?php echo $post['besch']?>
                                    </p>
                                </div>
                                <p class="card-text">
                                    <?php
                    $timestamp = new postDetails();
                    $timestamp = $timestamp->getPostHour($post['id']);
                    echo $timestamp;
                    ?>
                                </p>

                                <div class="likes">
                                    <span><?php echo Like::countLikes($post['id']); ?> Likes</span>
                                    <form action="" method="post">
                                        <?php if (Like::userLike($post['id'])==0):?>
                                            <button class="btn btn-primary" name="like" id="like">like</button>

                                        <?php else:?>
                                            <button class="btn btn-primary" name="unlike" id="unlike">unlike</button>
                                        <?php endif; ?>

                                        <input type="hidden" name="postid" id="postid" value="<?php echo $post['id']?>">
                                    </form>
                                </div>




                                        <div class="comments">
                                            <form method='post'>
                                                <label for="comment"></label>
                                                <input type='text' name='comments'>
                                                <button class="btn btn-primary" name='submit'>Comment</button>
                                            </form>

                                        </div>

                                        <?php endforeach;?>
                            </div>
            </div>

            <footer>
                <button class="btnLoadMore">Load More</button>
            </footer>

            <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

            <script src="js/app.js"></script>
            <script src="js/like.js" type="text/javascript"></script>

    </body>

    </html>
