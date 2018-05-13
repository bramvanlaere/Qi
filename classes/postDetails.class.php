<?php

include_once ('Db.class.php');

class postDetails{

    private $Postid;
    private $bio;

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }


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
        $getComments = $conn->prepare("SELECT * from comments where commentpostid = :postid");
        $getComments->bindValue(':postid', $postid);
        $getComments->execute();
        $comments = $getComments->fetchAll();
        return $comments;

    }
    public function getImage($postid){
        $conn = Db::getInstance();
        $result = array();

        $statement = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $statement->bindValue(':id', $postid);
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        return $result;

    }
    public function getAvatar($postid){
        $conn = Db::getInstance();
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

    public function getUserID($postid){
        $conn = Db::getInstance();
        $getUserID = $conn->prepare("SELECT imageuserid FROM posts WHERE id = :id");
        $getUserID->bindValue(':id',$postid);
        $getUserID->execute();
        $userID = $getUserID->fetch(PDO::FETCH_ASSOC);

        $result = $userID;

        return $result;
    }
    public function getDescription ($postid){
        $conn = Db::getInstance();
        $getDescription = $conn->prepare("SELECT besch FROM posts WHERE id = :id");
        $getDescription->bindValue(':id', $postid );
        $getDescription->execute();
        $description = $getDescription->fetch(PDO::FETCH_ASSOC);

        return $description;
    }
    public function getFilter ($postid){
        $conn = Db::getInstance();
        $getfilter = $conn->prepare("SELECT filter FROM posts WHERE id = :id");
        $getfilter->bindValue(':id', $postid );
        $getfilter->execute();
        $filter = $getfilter->fetch(PDO::FETCH_ASSOC);

        return $filter;
    }
    public function delPost($postid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("Delete from posts WHERE imageuserid = :id AND id = :postid");
        $statement->bindValue(":id",$_SESSION['userid']);
        $statement->bindValue(":postid",$postid);
        $res = $statement->execute();
        return $res;


    }

    public function updatePost($postid){
        $conn = Db::getInstance();
        $statement = $conn->prepare("update posts set besch = :besch WHERE id = :postid");
        $statement->bindValue(":postid",$postid);
        $statement->bindValue(":besch",$this->getBio());
        $res = $statement->execute();
        return $res;
    }









}



?>