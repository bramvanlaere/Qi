<?php

include_once ('Db.class.php');

class postDetails{

    private $Postid;

    /**
     * @return mixed
     */
    public function getPostid()
    {
        return $this->Postid;
    }

    /**
     * @param mixed $Postid
     */
    public function setPostid($Postid)
    {
        $this->Postid = $Postid;
    }

    public function getPostHour($id){
        $conn = Db::getInstance();

        $postTime = $conn->prepare("SELECT timestamp
                                   FROM posts
                                   WHERE id = :id");
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

    public function likeCheck($postid){
        $conn = Db::getInstance();

        $likeSenderID = $_SESSION['userid'];

        $likeCheck = $conn->prepare("SELECT * FROM likes WHERE likeimageid = $postid AND likesendid = $likeSenderID");
        $likeCheck->execute();

        if ($likeCheck->rowCount() == 1) {
            return true;
        }
        else{return false;}


    }
    public function getLikes($postid){
    $conn = Db::getInstance();

        $likeCount = $conn->prepare("SELECT likeimageid FROM likes WHERE likeimageid = :likeimageid");
        $likeCount->bindValue(":likeimageid", $postid);
        $likeCount->execute();
        $result = $likeCount->rowCount();
        return $result;
    }

    public function GetEmail($postid){
        $conn = Db::getInstance();
        $getUserID = $conn->prepare("SELECT imageuserid FROM posts WHERE id = :postid");
        $getUserID->bindValue(':postid', $postid );
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $email = $conn->prepare("SELECT email FROM users WHERE id = :id");
        $email->bindValue(':id', $userID['imageuserid']);
        $email->execute();
        $result = $email->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getComments($postid){
        $conn = Db::getInstance();
        $getComments = $conn->prepare("SELECT * from comments where commentimageid = :postid");
        $getComments->bindValue(':postid', $postid);
        $getComments->execute();
        $comments = $getComments->fetchAll();
        return $comments;

    }







}



?>