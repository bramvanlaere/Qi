$(document).ready(function(){

    $('.btnUnfollow').click(function(){
        $.ajax({
            type : 'POST',
            url  : 'includes/unfollow.inc.php',
            data : $(this).serialize(),
            success : function(data)
            {
                console.log(data);
                console.log("succes!");
                $(".btnUnfollow").attr("class", "btnFollow");
                $(".btnFollow").html("Follow");

            }
        });

    });

    $('.btnFollow').click(function(){
        $.ajax({
            type : 'POST',
            url  : 'includes/follow.inc.php',
            data : $(this).serialize(),
            success : function(data)
            {
                console.log(data);
                console.log("succes!");
                $(".btnFollow").attr("class", "btnUnfollow");
                $(".btnUnfollow").html("FOLLOWING");

            }
        });

    });

    $('.comment-btn-submit').click( function(e){
        console.log("comment");
        var postID = $(this).val();
        var comment = $(".commentField"+postID).val();
        var userID = $(".userID").val();
        var userName = $(".username").val();
        console.log(userName+postID+comment+userID);

        if (comment.length > 0 && userID != null){

            $(".commentsList"+postID).append("<li><a href='profile.php?userID=>"+ userID +"'>"+userName+"</a>" +
                "<span> "+comment+"</span></li>");


            $.ajax({
                type: 'POST',
                url: 'includes/comment.inc.php',
                data: {newComment: comment, userID: userID, userName: userName, postID: postID},
                succes: function(data)
                {
                    console.log(data);
                }

            });
        }
        var comment = $('.commentField').val("");

        e.preventDefault();
        return false;


    });


    $('.likeHeart').on('click', function(e){
        console.log('clicked');
        var imageID = $(this).attr("value");

        if($(this).is('.btnLike')){
            console.log('liked');
            $.ajax({
                type: 'POST',
                url: 'includes/like.inc.php',
                data: {nieuweLike: imageID},
                success: function(data)
                {
                    console.log(data);
                }
            });
            $(this).attr("src", "images/heart_filled.png");
            $(this).attr("class", "likeHeart btnUnlike");
            return false;
        }


        if($(this).is('.btnUnlike'))
        {
            console.log('unliked');
            $.ajax({
                type: 'POST',
                url: 'includes/unlike.inc.php',
                data: {nieuweLike: imageID},
                success: function(data)
                {
                    console.log(data);
                }
            });
            $(this).attr("src", "images/heart_blank.png");
            $(this).attr("class", "likeHeart btnlike");
            e.preventDefault();
            return false;
        }

    });

    $('.btnLoadMore').click(function() {

        $.ajax({
            type: 'POST',
            url: 'includes/loadmore.inc.php',
            data: {},
            success: function (data) {
                var parsed = JSON.parse(data);

                if (parsed !== "No data") {
                    $('.indexFeed').append("<div class='post__user' >" +
                        "<h4 class=''>" +
                        "<a class='' href='profile.php?userID="+parsed.imageuserid+">'>" +
                        ""+parsed.user+"</a></h4><img src='<?php echo $post['avatar']?>'>" +
                        "</div><div class=''> <img class='' src="+parsed.filelocation+">" +
                        "</div>" +
                        "<p><?php$likeCounter = new postDetails();" +
                        "$likes = $likeCounter->getLikes($post['id']);if($likes == 0) {echo 'No likes yet';}" +
                        "elseif($likes == 1){echo $likes.' Like';}else{echo $likes.' Likes';} ?>" +
                        " </p> " +
                        "<div style='padding: auto;'> <div class='feedFooterBottom'> " +
                        "<?php$like = new postDetails();$likeCheck = $like->likeCheck($post['id']);if($likeCheck)" +
                        "{$source = 'images/heart_filled.png';$class = 'btnUnlike';}else{$source = 'images/heart_blank.png';$class = 'btnLike';} ?>" +
                        " </div> </div> " +
                        "<img class='likeHeart <?php echo $class; ?> 'src='<?php echo $source; ?>' alt='like'value='<?php echo $post['id'] ?>'>" +
                        " <div class='card-text'> <p><?php echo $post['besch']?></p> </div> <p style='color: grey;font-size: small;'> " +
                        "<?php$timestamp = new postDetails();$timestamp = $timestamp->getPostHour($post['id']);echo $timestamp; ?> </p> " +
                        "<div style='margin-bottom: 10%;' class='comments'> <form method='post'> <label for='comment'></label>" +
                        " <input type='text' name='comments'> <button class='btn btn-dark' name='submit'>Comment</button> <hr> </form> </div>");
                } else {
                    alert("There are no more images to load!");
                }
            }
        });
    });

    $('.btn-btn-primary-report').click(function (e) {
        var imageID = $(this).attr("value");
        console.log("report");
        console.log(imageID);
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'includes/makeInappropriate.php',
            data:{newReport : imageID},
            success : function (data) {
                console.log(data);
            }
        });
        $(".btn-btn-primary-report").attr("class", "btn-btn-primary-unreport");
        $(".btn-btn-primary-unreport").html("unreport");



    })

    $('.btn-btn-primary-unreport').click(function (e) {
        var imageID = $(this).attr("value");
        console.log("unreport");
        console.log(imageID);
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'includes/delInappropriate.php',
            data:{delReport : imageID},
            success : function (data) {
                console.log(data);
            }
        });

        $(".btn-btn-primary-unreport").attr("class", "btn-btn-primary-report");
        $(".btn-btn-primary-report").html("report");
    })
});