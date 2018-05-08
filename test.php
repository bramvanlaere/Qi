<?php
require 'vendor/autoload.php';

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;


$palette = Palette::fromFilename('files/49-1524566823.jpg');

// $palette is an iterator on colors sorted by pixel count


// it offers some helpers too
$topFive = $palette->getMostUsedColors(5);





$colorCount = count($palette);

$blackCount = $palette->getColorCount(Color::fromHexToInt('#000000'));


// an extractor is built from a palette
$extractor = new ColorExtractor($palette);

// it defines an extract method which return the most “representative” colors
$colors = $extractor->extract(5);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
</div>

<?php foreach ($topFive as $key => $value):?>
    <div style='background-color:<?php echo Color::fromIntToHex($key);?>'>lel</div>



<?php endforeach;?>
</body>
</html>
