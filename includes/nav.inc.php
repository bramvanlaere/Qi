<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<nav style="background-color: white; border-bottom: #c61c18 solid 4px; font-family: Oswald;"; class="navbar navbar-expand-lg navbar-light fixed-top" id="">
    <div class="container">
        <a class="navbar-brand" href="index.php">QI</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="profile.php?userID=<?php echo $_SESSION['userid'];?>">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Accountsettings.php">Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="friendlist.php">Friends</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="imageupload.php">Upload</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="includes/logout.inc.php">Logout</a>
        </li>
        <li class="nav-item">
            <div class="searchBar">
                <form name="formSearch" method="get" action="search.php">
                    <span><input id="txtSearch" type="text" name="txtSearch" placeholder="Search" required></span>
                </form>
            </div>
        </li>
    </ul>
        </div>
    <hr>
    </div>
</nav>

</body>
</html>
