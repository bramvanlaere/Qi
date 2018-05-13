<?php
session_start();


class call
{
    /*geen idee waarom maar ik kan geen classes includen wanneer de file gebruikt wordt via ajax */

    public function getPostHour($id){
        $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');

        $postTime = $conn->prepare("SELECT timestamp FROM posts WHERE id = :id");
        $postTime->bindValue(':id', $id);
        $postTime->execute();
        $postTime = $postTime->fetch(PDO::FETCH_ASSOC);

        $currentTime = strtotime(date('Y-m-d H:i:s'));
        $postedTime = strtotime($postTime['timestamp']);

        $difference = $currentTime - $postedTime;
        $days = $difference/60/60/24;
        $hour = $difference/(60*60);
        $minutes = (abs($difference)/60);

        if(number_format($minutes, 0) < 1)
        {
            $result = "A moment ago";
        }
        elseif(number_format($hour, 0) < 1)
        {
            $result = number_format($minutes, 0). " minutes ago" ;
        }
        elseif(number_format($hour, 0) < 24)
        {
            $result = number_format($hour, 0)."h";
        }
        else
        {
            $result = number_format($days, 0)." days ago";
        }
        return $result;
    }


    public function getLikes($postid)
    {
        $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');

        $likeCount = $conn->prepare("SELECT likeimageid FROM likes WHERE likeimageid = :likeimageid");
        $likeCount->bindValue(":likeimageid", $postid);
        $likeCount->execute();
        $result = $likeCount->rowCount();
        return $result;
    }


    public function getComments($postid)
    {
        $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
        $getComments = $conn->prepare("SELECT * from comments where commentpostid = :postid");
        $getComments->bindValue(':postid', $postid);
        $getComments->execute();
        $comments = $getComments->fetchAll();
        return $comments;

    }


    public function getAvatar($postid)
    {
        $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
        $getUserID = $conn->prepare("SELECT imageuserid FROM posts WHERE id = :id");
        $getUserID->bindValue(':id', $postid);
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $avatarLocation = $conn->prepare("SELECT avatar FROM users WHERE id = :userid");
        $avatarLocation->bindValue(':userid', $userID['imageuserid']);
        $avatarLocation->execute();
        $result = $avatarLocation->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUserID($postid)
    {
        $conn = new PDO('mysql:host=localhost; dbname=qi', 'root', '');
        $getUserID = $conn->prepare("SELECT imageuserid FROM posts WHERE id = :id");
        $getUserID->bindValue(':id', $postid);
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $result = $userID;

        return $result;
    }

}

        $post = new call();
        $avatar = $post->getAvatar($_POST['postid']);
        $postTime = $post->getPostHour($_POST['postid']);
        $likeCount = $post->getLikes($_POST['postid']);
        $userID = $post->getUserID($_POST['postid']);
        $comments = $post->getComments($_POST['postid']);


    $result= [
        "avatar" =>$avatar,
        "postTime"=> $postTime,
        "likecount"=>$likeCount,
        "userid"=>$userID,
        "comment"=>$comments,
    ];

        echo json_encode($result,JSON_UNESCAPED_SLASHES);




?>