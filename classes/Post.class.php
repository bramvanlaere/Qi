<?php
include_once ('Db.class.php');

require 'vendor/autoload.php';

    use League\ColorExtractor\Color;
    use League\ColorExtractor\ColorExtractor;
    use League\ColorExtractor\Palette;

class Post
{
    private $image;
    private $filePath;
    private $besch;
    private $postId;
    private $filter;
    private $location;

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

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
    }


    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return mixed
     */
    public function getBesch()
    {
        return $this->besch;
    }

    /**
     * @param mixed $besch
     */
    public function setBesch($besch)
    {
        $this->besch = $besch;
    }


    public function moveImage()
    {

        $fileName=$_FILES["file"]["name"];
        $fileTmpName=$_FILES["file"]["tmp_name"];
        $filePath= "files/" . $_SESSION['userid']."-" . time().".jpg";
        $fileExt=explode(".",$fileName);
        $fileActualExt=strtolower(end($fileExt));
        $allowed=array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed)){
            move_uploaded_file($fileTmpName, $filePath);
            $this->cropimage($filePath,"400");

            $this->filePath=$filePath;


        }
        else{
            throw new exception("Oops you can't upload that file type");

        }





    }

    private function cropimage($file,$maxresolution){

        if(file_exists($file)){
            $originalimage=imagecreatefromjpeg($file);
            $originalwidth=imagesx($originalimage);
            $originalheight=imagesy($originalimage);

            //try max width
            if($originalheight>$originalwidth) {
                $ratio = $maxresolution / $originalwidth;
                $newwidth = $maxresolution;
                $newheight = $originalheight * $ratio;

                $verschil=$newheight-$newwidth;

                $x=0;
                $y= round($verschil/2);
            }

            else

            //als da ni werkt
            {
                $ratio=$maxresolution/$originalheight;
                $newheight=$maxresolution;
                $newwidth=$originalwidth*$ratio;

                $verschil=$newwidth-$newheight;

                $x=round($verschil/2);
                $y= 0;
            }

            if($originalimage){
                $newimage=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($newimage,$originalimage,0,0,0,0,$newwidth,$newheight,$originalwidth,$originalheight);

                $newcropimage=imagecreatetruecolor($maxresolution,$maxresolution);
                imagecopyresampled($newcropimage,$newimage,0,0,$x,$y,$maxresolution,$maxresolution,$maxresolution,$maxresolution);

                imagejpeg($newcropimage,$file,90);
            }
        }

    }


    public function savePost()
    {
        $besch = $this->besch;
        if (empty($besch)) {
            throw new exception("add a description please");
        } else {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into posts (filelocation,besch,user,imageuserid,filter,location) values (:filelocation, :besch,:user,:imageuserid,:filter,:location)");
            $statement->bindParam(":filelocation", $this->filePath);
            $statement->bindParam(":besch", $this->besch);
            $statement->bindValue(":imageuserid", $_SESSION['userid']);
            $statement->bindParam(":user",$_SESSION['user']);
            $statement->bindParam(":filter",$this->getFilter());
            $statement->bindParam(":location",$this->getLocation());
            $res = $statement->execute();
            if ($res = true) {
                header('Location:index.php');
            }


        }
    }
    public function newInappropriate(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into inappropriate(userid,postid) VALUES (:userid,:postid)");
        $statement->bindValue(':userid',$_SESSION['userid']);
        $statement->bindValue(':postid',$this->getPostId());
        $res = $statement->execute();
        return $res;
    }

    public function delInappropriate(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("delete from inappropriate WHERE postid = :postid and userid = (SELECT id FROM users WHERE email = :email)");
        $statement->bindValue(':email',$_SESSION['user']);
        $statement->bindValue(':postid',$this->getPostId());
        $res = $statement->execute();
        return $res;
    }

    public function userInappropriate($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from inappropriate WHERE postid = :postid and userid = (SELECT id FROM users WHERE email = :email)");
        $statement->bindValue(':postid',$id);
        $statement->bindValue(':email',$_SESSION['user']);
        $statement->execute();
        $res = $statement->rowCount();
        return $res;
    }

    public function countInappropriate($id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from inappropriate WHERE postid= :postid");
        $statement->bindValue(':postid',$id);
        $statement->execute();
        if($statement->rowCount()>=3){
            $res = true;
        } else{
            $res = false;
        }
        return $res;

    }

    public function SaveColors($filelocation,$postid) {
        $conn = Db::getInstance();
        $palette = Palette::fromFilename($filelocation);
        $extractor = new ColorExtractor($palette);
        $colors = $extractor->extract(5);

        foreach($colors as $color) {
            $b=Color::fromIntToHex($color);
            $statement = $conn->prepare("insert into colorpost (postid, color) VALUES (:postid,:color)");
            $statement->bindValue(":postid", $postid);
            $statement->bindValue(":color", $b);
            $statement->execute();
        }
    }

    public function checkPostidColor($postid){
        $conn = Db::getInstance();
        $statement =$conn->prepare("SELECT * FROM colorpost WHERE postid = :postid");
        $statement->bindParam(":postid",$postid);
        $statement->execute();
        if($statement->rowCount() >= 1){
            return false;
        }
        else{
            return true;

    }
    }


    public function showColors($postid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM colorpost WHERE postid = :postid");
        $statement->bindParam(":postid", $postid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
         }
    public function updatePost($postid)
    {
        $conn = Db::getInstance();

        $stmt = $conn->prepare("UPDATE posts SET besch=:besch, filelocation=:filelocation WHERE id = :postid");
        $stmt->bindValue(':postid', $postid);
        $stmt->bindParam(':besch', $this->getBesch());
        $stmt->bindValue(':filelocation', $this->getFilePath());
        return $stmt->execute();
    }

    public function getUserPost($postid)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * from posts WHERE id = :postid");
        $statement->bindValue(':postid', $postid);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);


        if ($res) {
            //$this->setFilePath($res['filelocation']);
            return $res;
        } else {
            throw new Exception("oeps er liep iets mis");
        }
    }

    public function deletePost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE id = :postid");
        $statement->bindValue('postid', $this->getPostId());
        $statement->execute();
    }




}


?>