<?php
$city = $_GET['city'];

$url = "https://www.gismeteo.ua/ua/weather-" . $city . "/";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

preg_match("/<input type=\"search\" class=\"input js-input\" placeholder=\"(.*)\" autocomplete=\"off\"/", $res, $matches);
$cityName = $matches[1];

$date = date("m.d.Y");


preg_match("/<div>Схід — (.*?)<\/div>/", $res, $matches);
$sunrise = $matches[1];


preg_match("/<div>Захід — (.*?)<\/div>/", $res, $matches);
$sunset = $matches[1];


preg_match_all("/<div [^>]*?>Тривалість дня: (.*?)<\/div>/", $res, $matches);

foreach ($matches[1] as $value) {
    $arr = explode(" ", $value);
    $hour = $arr[0];
    $minute = $arr[2];
}

preg_match_all("/<span class=\"unit unit_temperature_c\">(.*?)<\/span>/", $res, $matches);
$temperature = array();
$count = 0;
foreach ($matches[1] as $key => $value) {
    if ($key > 5) {
        $temperature[$key] = $value;
    }
}

//image
$width = 700;
$height = 400;
$retreat = 45;
$font_file = 'BitterPro-Medium.ttf';

$im = imagecreatetruecolor($width, $height);
imageantialias($im, true);

// colors
$black = imagecolorallocate($im, 0x00, 0x00, 0x00);
$white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
$red = imagecolorallocate($im, 255, 0, 0);

// background
imagefilledrectangle($im, 0, 0, 499, 199, $black);

//background - images
$left = imagecreatefrompng('./images/left.png');
$right = imagecreatefrompng('./images/right.png');

$sunrise_seconds = (int)explode(":", $sunrise)[0] * 3600 + (int)explode(":", $sunrise)[1] * 60;

$sunset_seconds = (int)explode(":", $sunset)[0] * 3600 + (int)explode(":", $sunset)[1] * 60;

$left_percent = (int)($sunrise_seconds * 100 / (24 * 3600));
$left_point = (int)($left_percent * 700 / 100);

$right_percent = (int)($sunset_seconds * 100 / (24 * 3600));
$right_point = (int)($right_percent * 640 / 100);

$center = imagecreatefrompng('./images/center.png');

$center_point = $right_point - $left_point - 50;

imagecopyresampled($im, $left, $left_point, 0, 0, 0, 50, 310, 100, 100);
imagecopyresampled($im, $right, $right_point, 0, 0, 0, 50, 310, 100, 100);
imagecopyresampled($im, $center, $left_point + 50, 0, 0, 0, $center_point, 310, 100, 100);

//sun & moon
$moon = imagecreatefrompng('./images/moon.png');
$sun = imagecreatefrompng('./images/sun.png');
imagecopyresampled($im, $moon, 45, 10, 0, 0, 130, 130, 100, 100);
imagecopyresampled($im, $sun, $width / 2 - 40, 0, 0, 0, 110, 110, 60, 60);
imagecopyresampled($im, $moon, $width - 125, 10, 0, 0, 130, 130, 100, 100);

//line
imageline($im, $retreat, $height - $retreat * 2, $width - $retreat, $height - $retreat * 2, $white);

//temperature
$start_point = 35;
$step = $width / count($temperature);
$points = array();

foreach ($temperature as $key => $value) {
    $x = $start_point;
    $y = ($height / 2 - $value * 10) + 140;
    imagefttext($im, 18, 0, $x, $y, $red, $font_file, $value);
    $start_point += $step;
    $points[] = array($x, $y);
}

for ($i = 0; $i < count($points) - 1; $i++) {
    $x1 = $points[$i][0] + 10;
    $y1 = $points[$i][1] + 15;
    $x2 = $points[$i + 1][0] + 10;
    $y2 = $points[$i + 1][1] + 15;
    imageline($im, $x1, $y1, $x2, $y2, $red);
}

//point
$x1 = $retreat;
$x2 = $retreat;
$y1 = $height - $retreat * 2;
$y2 = $height - $retreat * 2 + 10;
$r = ($width - $retreat * 2) / 8;
$s = 5;
$count = 0;
for ($i = 0; $i < 9; $i++) {
    imageline($im, $x1, $y1, $x2, $y2, $white);
    imagefttext($im, 15, 0, $x1 - $s, $y2 + 20, $white, $font_file, $count);
    $x1 = $x1 + $r;
    $x2 = $x2 + $r;
    $count = $count + 3;
    if ($i > 3) {
        $s = $s + 2;
    }
}

//city
$x = $retreat;
$y = $height - 10;
imagefttext($im, 20, 0, $x, $y, $white, $font_file, $cityName);
//date
$x = $width - 170;
imagefttext($im, 20, 0, $x, $y, $white, $font_file, $date);


header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
