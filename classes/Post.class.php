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
            $statement = $conn->prepare("insert into posts (filelocation,besch,user,imageuserid) values (:filelocation, :besch,:user,:imageuserid)");
            $statement->bindParam(":filelocation", $this->filePath);
            $statement->bindParam(":besch", $this->besch);
            $statement->bindValue(":imageuserid", $_SESSION['userid']);
            $statement->bindParam(":user",$_SESSION['user']);
            $res = $statement->execute();
            if ($res = true) {
                header('Location:index.php');
            }


        }
    }




}


