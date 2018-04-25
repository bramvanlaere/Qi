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