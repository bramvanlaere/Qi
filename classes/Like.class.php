<?php

include_once ("Db.class.php");
class Like
{
    private $postId;

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    public function Like(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into likes (userid,postid) VALUES (:userid,:postid)");
        $statement->bindValue(":userid",$_SESSION['userid']);
        $statement->bindValue(":postid",$this->getPostId());
        $res = $statement->execute();
        return $res;
    }

    public function userLike($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from likes WHERE postid = :postid and userid = (SELECT id FROM users WHERE email = :email)");
        $statement->bindValue(':postid',$id);
        $statement->bindValue(':email',$_SESSION['user']);
        $statement->execute();
        $res = $statement->rowCount();
        return $res;
    }

    public function delLike(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("delete from likes WHERE postid = :postid and userid = (SELECT id FROM users WHERE email = :email)");
        $statement->bindValue(':email',$_SESSION['user']);
        $statement->bindValue(':postid',$this->getPostId());
        $res = $statement->execute();
        return $res;
    }

    public function countLikes($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from likes WHERE postid =:postid");
        $statement->bindParam(':postid',$id);
        $statement->execute();
        $res = $statement->rowCount();
        return $res;
    }
}