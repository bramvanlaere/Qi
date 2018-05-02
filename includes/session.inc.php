<?php
session_start();
if(isset($_SESSION['loggedin'])){

}
else{
    header('Location: login.php');
}
?>
