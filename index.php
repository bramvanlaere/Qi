<?php
    include_once ("classes/Db.class.php");
    include_once ("includes/session.inc.php");
    include_once ("classes/User.class.php");
    include_once ("classes/Comment.class.php");
    include_once ("classes/postDetails.class.php");

    $userid = $_SESSION['userid'];
    $f = new User();
    $r=$f->getFeed($userid);
    $_SESSION['offset'] = 0;


if(!empty($_POST['comments'])){

    $c = new Comments();
    $comments=$_POST["comments"];
    $c->setComments($comments);
    $c->saveComments();







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
                <p><?php echo $post['besch']?></p>
            </div>
                <p class="card-text">
                    <?php
                    $timestamp = new postDetails();
                    $timestamp = $timestamp->getPostHour($post['id']);
                    echo $timestamp;
                    ?>
                </p>

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

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

<script src="js/app.js"></script>
</body>
</html>