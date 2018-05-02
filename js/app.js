$(document).ready(function(){
    $('.btnLoadMore').click(function() {
        $.ajax({
            type: 'POST',
            url: 'includes/loadmore.inc.php',
            data: {},
            success: function (data) {
                var parsed = JSON.parse(data);

                if (parsed !== "No data") {
                    $('.indexFeed').append("<div class='post__user'>" +
                        "<h4><a href='#'>"+parsed.user+"</a></h4>" +
                        "</div><div class='image'><img src="+parsed.filelocation+"></div>" +
                        "<div> <p class='feedNavTimestamp'>" +
                         +parsed.timestamp+
                        "</p><div class='card-text'><p>"+parsed.besch+"</p></div>" +
                        "<div class='comments'> <form method='post'> " +
                        "<label for='comment'></label>" +
                        " <input type='text' name='comments'>" +
                        "<button class='btn btn-primary' name='submit'>Comment</button> " +
                        "</form> </div>");
                } else {
                    alert("There are no more images to load!");
                }
            }
        });
    })
});