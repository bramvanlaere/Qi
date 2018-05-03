$(document).ready(function(){
    $('.comment-btn-submit').click( function(e){
        console.log("comment");

        var _postID = $(this).val();
        console.log(_postID);
        var _comment = $(".commentField"+_postID).val();
        var _userID = $(".userID").val();
        var _userName = $(".email").val();
        var _imageID = $(".imageID"+_postID).val();


        if (_comment.length > 0 && _userID != null){

            $(".commentsList"+_postID).append("<li><a href='profile.php?userID=>"+ _userID +"'>"+_userName+"</a>" +
                "<span> "+_comment+"</span></li>");

            console.log(_comment+_userID+_userName+_postID);
            $.ajax({
                type: 'POST',
                url: 'includes/comment.inc.php',
                data: {newComment: _comment, userid: _userID, userName: _userName, imageID: _imageID},
                succes: function(data)
                {

                    console.log(data);
                }

            });
        }

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
        else
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
    })
});