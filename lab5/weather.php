<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab5</title>
</head>
<body>
<?php

curl_get('https://www.gismeteo.ua/ua/weather-kharkiv-5053/');

 function curl_get($url): void
 {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $res = curl_exec($ch);
    curl_close($ch);

    preg_match("/<input type=\"search\" class=\"input js-input\" placeholder=\"(.*)\" autocomplete=\"off\"/", $res, $matches);
    echo $matches[1];
    echo "<br/>";

    echo date("m.d.Y");
    echo "<br/>";
    echo "<br/>";

    echo "<span>Схід сонця: </span>";
    preg_match("/<div>Схід — (.*?)<\/div>/", $res, $matches);
    echo $matches[1];
    echo "<br/>";

    echo "<span>Захід сонця: </span>";
    preg_match("/<div>Захід — (.*?)<\/div>/", $res, $matches);
    echo $matches[1];
    echo "<br/>";

    echo "<span>Тривалість дня: </span>";
    preg_match_all("/<div [^>]*?>Тривалість дня: (.*?)<\/div>/", $res, $matches);

    foreach ($matches[1] as $value) {
        $arr = explode(" ", $value);
        $lastNumber = $arr[0] % 10;
        $lastTwoNumber = $arr[0] % 100;
        if ($lastNumber == 1 && $lastTwoNumber != 11) {
            echo $arr[0] . "година " . $arr[2] . $arr[3];
        }
        if ($lastNumber >= 2 && $lastNumber <= 4 && ($lastTwoNumber < 12 || $lastTwoNumber > 14)) {
            echo $arr[0] . "години " . $arr[2] . $arr[3];
        } else {
            echo $arr[0] . "годин " . $arr[2] . $arr[3];
        }
    }
    echo "<br/>";
    echo "<br/>";

    echo "<span>Температура за день: </span>";
    preg_match_all("/<span class=\"unit unit_temperature_c\">(.*?)<\/span>/", $res, $matches);
    $count = 0;
    foreach ($matches[1] as $key => $value) {
        if ($key > 5) {
            echo $count . "год: ";
            echo $value . "<span>&#8451;</span>" . " ";
            $count = $count + 3;
        }
    }
    echo "<br/>";
}
?>
</body>
</html>