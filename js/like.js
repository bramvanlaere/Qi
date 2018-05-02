/*$("#like").on("click",function (e) {
    var postid = $(this).attr('id');
    var id = postid.slice(5);


    $.ajax({
        method: "POST",
        url: "ajax/ajax_like.php",
        data: {id:id}
    })

        .done(function (res) {
            var likebtn = $('#post'+id);
            if (res.status == 'success'){
                if(res.type == 'liked'){
                    var likes = likebtn.parent().sibling('.likes').find("span");
                    var num = +(likes.text()) +1;
                    likes.text(num);
                    console.log(num);
                }

                else if (res.type == 'disliked'){
                    var likes = likebtn.parent().sibling('.likes').find("span");
                    var num = +(likes.text()) -1;
                    likes.text(num);
                    console.log(num);
                }
            }
        });
e.preventDefault();
});*/