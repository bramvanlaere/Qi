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


                    $.ajax({
                        type: 'POST',
                        url: 'includes/avatarcall.php',
                        data: {postid:parsed.id},
                        success:function (data) {
                            var rest = JSON.parse(data);
                            var comments = rest.comment;

                            if(rest.likecount == 0) {
                                var like="No likes this yet";
                            }
                            else{
                                if(rest.likecount == 1){
                                    var like=" like";

                                }else{
                                    var like=" likes"
                                }




                            }






                    $('.indexFeed').append("<div class='post__user' >" +
                        "<form action='' method='post'>" +
                            "<button  style='border-radius: 15px; color: whitesmoke; background-color: #c61c18; float: right; border: none;' class='btn-btn-primary-report' name='report' id='report' value='report'>report</button>" +
                        " <span></span> " +
                        "<input type='hidden' name='postid' id='postid' value=''> " +
                                "</form> " +
                        "<h4><img style='height: 75px; width: 75px; border-radius: 100px;' src="+rest.avatar["avatar"]+"><a href=''>"+parsed.user+"</a></h4></div>" +
                        "<div><img style='margin-left: -19px;' class='' src="+parsed.filelocation+" alt='post'> </div> " +
                        "<span>"+parsed.besch+"</span>" +
                        "<p>"+rest.likecount+like+"</p>"+
                        "<div style='padding: auto;'> <ul class='commentsList"+parsed.id+"'>" +

                        " <input type='hidden' class='imageID"+parsed.id+"' value="+parsed.id+">" +
                        "<input type='hidden' class='userID' value='"+parsed.imageuserid+"'> " +
                        "<input type='hidden' class='username' value="+parsed.email+"> " +

                        "</ul> <div class='feedFooterBottom'> " +
                        " <form> " +
                        "<img class='likeHeart btnLike 'src='images/heart_blank.png' alt='like'value='<?php echo $post['id'] ?>'>" +
                        " <input class='commentField"+parsed.id+"' type='text' name='commentField' placeholder='Add a comment...'> " +
                        "<input class='comment-btn-submit' type='submit' value="+parsed.id+" style='position: absolute; left: -9999px'/> " +
                        "</form> <p style='color: grey;font-size: small;'>"+rest.postTime+"" +
                        " </p>  <hr>")
                        }

                    });


                }else{
                    alert("There are no more images to load!");
                }
                var i;
                for (i = 0; i < comments.length; ++i) {
                    var commentdeel="<li><a href='profile.php?userID="+comments[i]["commentuserid"]+"'>"+comments[i]["email"]+"</a> " + "<span class='comment-text'>"+comments[i]["comment"]+"</span> </li>"
                    var postid=comments[i][3];
                    console.log(postid);
                    $(".commentsList"+postid+"").append(commentdeel);
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
        $(this).attr("class", "btn-btn-primary-unreport");
        $(this).html("unreport");



    });

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

        $(this).attr("class", "btn-btn-primary-report");
        $(this).html("report");
    })
});