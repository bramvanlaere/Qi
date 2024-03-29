<?php
include_once ('classes/Db.class.php');
include_once ('classes/Post.class.php');
session_start();
if(isset($_SESSION['loggedin'])){

    if(!empty($_POST)){

        $besch=$_POST["besch"];
        $filter = $_POST["slctFilter"];


        $p = new Post();
        $p->moveImage();
        $p->setFilter($filter);
        $p->setBesch($besch);
        $p->setLocation($_POST['location']);
        $p->savePost();

    }


}
else{
    header('Location: login.php');
}








?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New upload</title>
    <style type="text/css" media="all">
        @import "css/cssgram.min.css";
    </style>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        function filterGo(d1) {
            var d1 = document.getElementById(d1);
            var output = document.getElementById('output');

            if(d1.value == '_1997'){
                output.className='_1997';
            }else if(d1.value == 'aden'){
                output.className='aden';
            }else if(d1.value == 'brannan'){
                output.className='brannan';
            }else if(d1.value == 'brooklyn'){
                output.className='brooklyn';
            }else if(d1.value == 'clarendon'){
                output.className='clarendon';
            }else if(d1.value == 'earlybird'){
                output.className='earlybird';
            }else if(d1.value == 'gingham'){
                output.className='gingham';
            }else if(d1.value == 'hudson'){
                output.className='hudson';
            }else if(d1.value == 'inkwell'){
                output.className='inkwell';
            }else if(d1.value == 'kelvin'){
                output.className='kelvin';
            }else if(d1.value == 'lark'){
                output.className='lark';
            }else if(d1.value == 'lofi'){
                output.className='lofi';
            }else if(d1.value == 'maven'){
                output.className='maven';
            }else if(d1.value == 'mayfair'){
                output.className='mayfair';
            }else if(d1.value == 'moon'){
                output.className='moon';
            }else if(d1.value == 'nashville'){
                output.className='nashville';
            }else if(d1.value == 'perpetua'){
                output.className='perpetua';
            }else if(d1.value == 'reyes'){
                output.className='reyes';
            }else if(d1.value == 'rise'){
                output.className='rise';
            }else if(d1.value == 'slumber'){
                output.className='slumber';
            }else if(d1.value == 'stinson'){
                output.className='stinson';
            }else if(d1.value == 'toaster'){
                output.className='toaster';
            }else if(d1.value == 'valencia'){
                output.className='valencia';
            }else if(d1.value == 'walden'){
                output.className='walden';
            }else if(d1.value == 'willow'){
                output.className='willow';
            }else if(d1.value == 'xpro2'){
                output.className='xpro2';
            }else{
                output.className='';
            }



        }
    </script>


</head>

<body>

<?php include_once("includes/nav.inc.php"); ?>
<div style="font-family: Oswald,sans-serif;" class="col-lg-4 mx-auto">
<div id="tit"><h4>Upload an image</h4></div>
<div class="form">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/*" onchange="loadFile(event)" id="fileUpload" />
        <br>
        <textarea id="beschrijving" rows="5" cols="29" name="besch" id="comment"></textarea>
        <br />
        <input type="hidden" name="location" id="location" value="">
        <button id="knop" class="uploadimg" name="submit">Upload</button>

        <?php
        if( isset($error) ) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <div class="custom-select" style="width:200px;">
            <select id="slctFilter" name="slctFilter" onchange="filterGo(this.id)">
                <div id="content">
                <option value="0">Select Filter:</option>
                <option value="_1997">1977</option>
                <option value="aden">Aden</option>
                <option value="brannan">Brannan</option>
                <option value="brooklyn">Brooklyn</option>
                <option value="clarendon">Clarendon</option>
                <option value="earlybird">Earlybird</option>
                <option value="gingham">Gingham</option>
                <option value="hudson">Hudson</option>
                <option value="inkwell">Inkwell</option>
                <option value="kelvin">Kelvin</option>
                <option value="lark">Lark</option>
                <option value="lofi">Lofi</option>
                <option value="maven">Maven</option>
                <option value="mayfair">Mayfair</option>
                <option value="moon">Moon</option>
                <option value="nashville">Nashville</option>
                <option value="perpetua">Perpetua</option>
                <option value="reyes">Reyes</option>
                <option value="rise">Rise</option>
                <option value="slumber">Slumber</option>
                <option value="stinson">Stinson</option>
                <option value="toaster">Toaster</option>
                <option value="valencia">Valencia</option>
                <option value="walden">Walden</option>
                <option value="willow">Willow</option>
                <option value="xpro2">Xpro2</option>
                </div>
            </select>
        </div>

    </form>
</</div>


    <img class="" id="output" />

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        if ("geolocation" in navigator) {
            /* geolocation is available */
            navigator.geolocation.getCurrentPosition(function(position) {

                var lng = position.coords.longitude;
                var lat = position.coords.latitude;
                console.log(lng);
                console.log(lat);

                $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=true", function(data){
                    console.log(data["results"][1]["formatted_address"]);
                    $("#location").attr("value", data["results"][1]["formatted_address"]);
                });
            });
        }
        else {
            /* geolocation IS NOT available */
        }
    })
</script>
<script src="js/app.js"></script>

</body>
</html>
