<<<<<<< HEAD
<?php
include_once ('Db.class.php');
class User{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $editemail;
    private $editbio;
    private $editpassword;
    private $filepath;
    public $results;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return mixed
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * @param mixed $filepath
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * @return mixed
     */
    public function getEditemail()
    {
        return $this->editemail;
    }

    /**
     * @param mixed $editemail
     */
    public function setEditemail($editemail)
    {
        $this->editemail = $editemail;
    }

    /**
     * @return mixed
     */
    public function getEditbio()
    {
        return $this->editbio;
    }

    /**
     * @param mixed $editbio
     */
    public function setEditbio($editbio)
    {
        $this->editbio = $editbio;
    }

    /**
     * @return mixed
     */
    public function getEditpassword()
    {
        return $this->editpassword;
    }

    /**
     * @param mixed $editpassword
     */
    public function setEditpassword($editpassword)
    {
        $this->editpassword = $editpassword;
    }




    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {

        if(strlen($password)<8){
            throw new exception("Password must be at least 8 characters long.");
        } else {
            $this->password = $password;
        }

        return $this;
    }

    private function hashPassword(){
        $hash = password_hash($this->password,PASSWORD_DEFAULT);

        return $hash;


    }

    public function register(){
        $conn = Db::getInstance();

        // query (insert)
        $statement = $conn->prepare("insert into users(email,password,firstname,lastname) values(:email,:password,:firstname,:lastname)");
        $statement->bindParam(':email',$this->email);
        $statement->bindParam(':password',$this->hashPassword());
        $statement->bindParam(':firstname',$this->firstname);
        $statement->bindParam(':lastname',$this->lastname);

        $result = $statement->execute();


        // execute


        // return true/false
        return $result;
    }

    public function login(){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user']= $this->email;
        $this->getid();
        header('Location: index.php');
    }





    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function canLogin()
    {
        $password = $this->getPassword();
        $conn=Db::getInstance();
        $q = "select * from users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$this->email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $hash = $user['password'];

        if ( password_verify($password, $hash)) {
            return true;
        }
        else
        {
            return false;
        }


    }

    public function checkpass()
    {
        $password = $this->getPassword();
        $conn=Db::getInstance();
        $q = "select * from users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$_SESSION['user']);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $hash = $user['password'];

        if ( password_verify($password, $hash)) {
            return true;
        }
        else
        {
            return false;
        }


    }
    public function getid(){
        $conn = Db::getInstance();
        $q="SELECT id FROM users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$_SESSION['user']);
        $statement->execute();
        $result = $statement->fetch();
        $res = $result['id'];
        $_SESSION['userid']=$res;



    }

    public function updateProfile()
    {
        $currentUser = $_SESSION['userid'];
        $conn=Db::getInstance();
        $sqlUpdate = "UPDATE users SET email = (case when '".$this->editemail."' = '' then email else '".$this->editemail."' end),bio = (case when '".$this->editbio."' = '' then bio else '".$this->editbio."' end) WHERE id = '".$currentUser."'";
        $statementUpdate = $conn->prepare($sqlUpdate);
        if($statementUpdate->execute()){
            $_SESSION['user']=$this->editemail ;
        };


    }

    public function updatePassword()
    {
        $currentUser = $_SESSION['userid'];

        // password options
        $options = [
            'cost'=> 12
        ];
        // bcrypting new password
        $password = password_hash($this->editpassword, PASSWORD_DEFAULT, $options);

        $conn=Db::getInstance();
        $qUpdatePassword = "update users set password = '".$password."' where id = '".$currentUser."'";
        $statement = $conn->prepare($qUpdatePassword);
        $statement->execute();
    }

    public function moveAvatar() {
        $filename = $_FILES["file"]["tmp_name"];
        $filepath = "avatars/" . $_SESSION['userid'] . "_avatar.jpg";
        move_uploaded_file($filename, $filepath);
        // nieuwe locatie opslaan in variabele voor de query
        $this->filepath = $filepath;
    }

    public function saveAvatar()
    {
        $conn=Db::getInstance();
        $statement = $conn->prepare("update users set avatar = :avatar where id = '".$_SESSION['userid']."'");
        $statement->bindValue(":avatar", $this->filepath);
        $statement->execute();

        $_SESSION['avatar'] = $this->filepath;
    }

    public function showAvatar()
    {
        $conn=Db::getInstance();
        $statement = $conn->prepare("select avatar from users where id = '".$_SESSION['userid']."'");
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['avatar'] = $result['avatar'];


        }
    }

    private function getFriendId($userid){
        $conn=Db::getInstance();
        $statement = $conn->prepare("select friendid from friendlist where userid = :userid");
        $statement->bindValue(":userid",$userid);
        $statement->execute();
        $results = $statement->fetchAll();
        $array = array();
        array_push($array, $_SESSION['userid']);
        foreach($results as $res){
            array_push($array, $res['friendid']);
        }



        return $array;


    }

    public function displayFriends($userid){
        $friendsid=$this->getFriendId($userid);
        $conn=Db::getInstance();
        $statement=$conn->prepare("select * from users where id in(".implode(',', $friendsid).") ");
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;

    }

    public function getFeed($userid){
        $friendsid=$this->getFriendId($userid);
        $_SESSION['getal'] = 1;
        $_SESSION['offset'] = 3;
        $conn=Db::getInstance();
        $array=implode(',', $friendsid);
        $_SESSION['friendarray']=$array;
        $statement = $conn->prepare("select * from posts where imageuserid in (".implode(',', $friendsid).") order by timestamp desc ");

        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
        //returned een array met kleinere arrays in die de vriend profielen bevatten


        //;



    }










}
=======
<?php
include_once ('Db.class.php');
class User{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $editemail;
    private $editbio;
    private $editpassword;
    private $filepath;
    public $results;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * @return mixed
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * @param mixed $filepath
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * @return mixed
     */
    public function getEditemail()
    {
        return $this->editemail;
    }

    /**
     * @param mixed $editemail
     */
    public function setEditemail($editemail)
    {
        $this->editemail = $editemail;
    }

    /**
     * @return mixed
     */
    public function getEditbio()
    {
        return $this->editbio;
    }

    /**
     * @param mixed $editbio
     */
    public function setEditbio($editbio)
    {
        $this->editbio = $editbio;
    }

    /**
     * @return mixed
     */
    public function getEditpassword()
    {
        return $this->editpassword;
    }

    /**
     * @param mixed $editpassword
     */
    public function setEditpassword($editpassword)
    {
        $this->editpassword = $editpassword;
    }




    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {

        if(strlen($password)<8){
            throw new exception("Password must be at least 8 characters long.");
        } else {
            $this->password = $password;
        }

        return $this;
    }

    private function hashPassword(){
        $hash = password_hash($this->password,PASSWORD_DEFAULT);

        return $hash;


    }

    public function register(){
        $conn = Db::getInstance();

        // query (insert)
        $statement = $conn->prepare("insert into users(email,password,firstname,lastname) values(:email,:password,:firstname,:lastname)");
        $statement->bindParam(':email',$this->email);
        $statement->bindParam(':password',$this->hashPassword());
        $statement->bindParam(':firstname',$this->firstname);
        $statement->bindParam(':lastname',$this->lastname);

        $result = $statement->execute();


        // execute


        // return true/false
        return $result;
    }

    public function login(){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user']= $this->email;
        $this->getid();
        header('Location: index.php');
    }





    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function canLogin()
    {
        $password = $this->getPassword();
        $conn=Db::getInstance();
        $q = "select * from users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$this->email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $hash = $user['password'];

        if ( password_verify($password, $hash)) {
            return true;
        }
        else
        {
            return false;
        }


    }

    public function checkpass()
    {
        $password = $this->getPassword();
        $conn=Db::getInstance();
        $q = "select * from users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$_SESSION['user']);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $hash = $user['password'];

        if ( password_verify($password, $hash)) {
            return true;
        }
        else
        {
            return false;
        }


    }
    public function getid(){
        $conn = Db::getInstance();
        $q="SELECT id FROM users where email = :email";
        $statement = $conn->prepare($q);
        $statement->bindParam(":email",$_SESSION['user']);
        $statement->execute();
        $result = $statement->fetch();
        $res = $result['id'];
        $_SESSION['userid']=$res;



    }

    public function updateProfile()
    {
        $currentUser = $_SESSION['userid'];
        $conn=Db::getInstance();
        $sqlUpdate = "UPDATE users SET email = (case when '".$this->editemail."' = '' then email else '".$this->editemail."' end),bio = (case when '".$this->editbio."' = '' then bio else '".$this->editbio."' end) WHERE id = '".$currentUser."'";
        $statementUpdate = $conn->prepare($sqlUpdate);
        if($statementUpdate->execute()){
            $_SESSION['user']=$this->editemail ;
        };


    }

    public function updatePassword()
    {
        $currentUser = $_SESSION['userid'];

        // password options
        $options = [
            'cost'=> 12
        ];
        // bcrypting new password
        $password = password_hash($this->editpassword, PASSWORD_DEFAULT, $options);

        $conn=Db::getInstance();
        $qUpdatePassword = "update users set password = '".$password."' where id = '".$currentUser."'";
        $statement = $conn->prepare($qUpdatePassword);
        $statement->execute();
    }

    public function moveAvatar() {
        $filename = $_FILES["file"]["tmp_name"];
        $filepath = "avatars/" . $_SESSION['userid'] . "_avatar.jpg";
        move_uploaded_file($filename, $filepath);
        // nieuwe locatie opslaan in variabele voor de query
        $this->filepath = $filepath;
    }

    public function saveAvatar()
    {
        $conn=Db::getInstance();
        $statement = $conn->prepare("update users set avatar = :avatar where id = '".$_SESSION['userid']."'");
        $statement->bindValue(":avatar", $this->filepath);
        $statement->execute();

        $_SESSION['avatar'] = $this->filepath;
    }

    public function showAvatar()
    {
        $conn=Db::getInstance();
        $statement = $conn->prepare("select avatar from users where id = '".$_SESSION['userid']."'");
        $statement->execute();

        if($statement->rowCount() == 1){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['avatar'] = $result['avatar'];


        }
    }

    private function getFriendId($userid){
        $conn=Db::getInstance();
        $statement = $conn->prepare("select friendid from friendlist where userid = :userid");
        $statement->bindValue(":userid",$userid);
        $statement->execute();
        $results = $statement->fetchAll();
        $array = array();
        array_push($array, $_SESSION['userid']);
        foreach($results as $res){
            array_push($array, $res['friendid']);
        }



        return $array;


    }

    public function displayFriends($userid){
        $friendsid=$this->getFriendId($userid);
        $conn=Db::getInstance();
        $statement=$conn->prepare("select * from users where id in(".implode(',', $friendsid).") ");
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;

    }

    public function getFeed($userid){
        $friendsid=$this->getFriendId($userid);
        $_SESSION['getal'] = 1;
        $_SESSION['offset'] = 3;
        $conn=Db::getInstance();
        $array=implode(',', $friendsid);
        $_SESSION['friendarray']=$array;
        $statement = $conn->prepare("select * from posts where imageuserid in (".implode(',', $friendsid).") order by timestamp desc limit :getal ");
        $statement->bindValue(':getal',$_SESSION['getal'], PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
        //returned een array met kleinere arrays in die de vriend profielen bevatten


        //;



    }










}
>>>>>>> 3fea1da4c7a603405dae8e1adebd69080574456d
