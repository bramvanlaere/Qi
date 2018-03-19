<?php
include_once ('Db.class.php');
class User{
    private $email;
    private $password;
    private $firstname;
    private $lastname;

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
        }
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $this->password = $hash;

        return $this;
    }

    public function register(){

    $conn = new PDO('mysql:host=localhost;dbname=qi','root','');

        // query (insert)
        $statement = $conn->prepare("insert into users(email,password,firstname,lastname) values(:email,:password,:firstname,:lastname)");
        $statement->bindParam(':email',$this->email);
        $statement->bindParam(':password',$this->password);
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


    public function Loginfunc()
    {
        $password = $this->password;
        $conn = new PDO('mysql:host=localhost;dbname=qi','root','');
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








}