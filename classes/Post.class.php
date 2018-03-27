<?php
include_once ('Db.class.php');
class Post
{
    private $image;
    private $filePath;
    private $besch;

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
        $filePath= "files/" . $_SESSION['user']."-" . time().".jpg";
        //om file size te limiteren $fileSize=$_FILES["file"]["size"];
        $fileExt=explode(".",$fileName);
        $fileActualExt=strtolower(end($fileExt));
        $allowed=array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed)){

            move_uploaded_file($fileTmpName, $filePath);
            $this->filePath=$filePath;
        }
        else{


        }





    }


    public function savePost(){
        $conn=Db::getInstance();
        $statement=$conn->prepare("insert into posts (filelocation, besch) values (:filelocation, :besch)");
        $statement->bindParam(":filelocation", $this->filePath);
        $statement->bindParam(":besch", $this->besch);
        $res=$statement->execute();
        if ($res=true){
            header('Location: index.php');
        }


    }


}


?>