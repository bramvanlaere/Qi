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



}


?>