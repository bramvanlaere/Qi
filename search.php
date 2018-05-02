
<?php
include_once('includes/session.inc.php');
include_once('classes/Db.class.php');

if(isset($_GET['txtSearch'])) {
    $conn = Db::getInstance();
    $searchKeyword = $_GET['txtSearch'];
    $results = array();
    $statement = $conn->prepare("SELECT * FROM posts WHERE besch LIKE :keywords OR user LIKE :keywords ORDER BY id DESC");
    $statement->bindValue(':keywords', '%' . $searchKeyword . '%');
    $statement->execute();

    if($statement->rowCount() >= 1){
        $results = $statement->fetchAll();
        $countPosts = $statement->rowCount();
    }
    else
    {
        $errorMessage = "Helaas, we vonden geen posts die gelijk zijn aan de zoekterm: ".$_GET['txtSearch'];
    }

}

?><!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<?php include_once("includes/nav.inc.php"); ?>

<body>



    <h1><?php if(isset($errorMessage)){ echo $errorMessage;} ?></h1>

    <h2><?php if(isset($countPosts)){echo $_GET['txtSearch'];} ?></h2>
    <h3><?php if(isset($countPosts)){echo "<span>".$countPosts."</span>"." posts";} ?></h3>
        <?php foreach($results as $res): ?>
            <h2><a href="#"><?php echo $res['user']?></a></h2>
            <img src="<?php echo $res['filelocation']?>" alt="">
            <p><?php echo $res['besch']?></p>

        <?php endforeach;?>




</body>
</html>