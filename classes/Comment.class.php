
<?php
include_once ('Db.class.php');
class Comments
{
    private $comments;
    /**
 * @return mixed
 */
    public function getComments()
    {
    return $this->comments;
    }/**
 * @param mixed $comments
 */
    public function setComments($comments)
    {
    $this->comments = $comments;
    }

    public function saveComments()
    {

            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into comments (comment,user,commentuserid) values (:comment,:user,:commentuserid)");
            $statement->bindParam(":comment", $this->comments);
            $statement->bindValue(":commentuserid", $_SESSION['userid']);
            $statement->bindParam(":user",$_SESSION['user']);
            $res = $statement->execute();
            if ($res = true) {
                header('Location:index.php');
            }


        }













}

?>