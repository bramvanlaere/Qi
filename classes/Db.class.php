<?php
class Db{

    private static $conn;

    public static function getInstance(){
        if(self::$conn == null){
            self::$conn = new PDO('mysql:host=localhost;dbname=qi','root','');
            return self::$conn;
        }
        else{
            return self::$conn;
        }
    }


}






?>