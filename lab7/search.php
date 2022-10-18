<?php
$query = $_GET["query"];
$query_encoded = urlencode($query);

if (empty($query)) {
    echo "<div style='font-size: 20px; text-align: center'>" . "За запитом $query нічого не знайдено" . "</div>";
    return;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.foxtrot.com.ua/uk/search?query={$query_encoded}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$html = curl_exec($ch);
curl_close($ch);

preg_match_all(
    "/<div class=\"listing__body-wrap image-switch\">(.*)<\/section>/s",
    $html,
    $matches
);

if (!empty($matches[0][0])) {
    echo $matches[0][0];
} else {
    echo "<div style='font-size: 20px; text-align: center'>" . "За запитом $query нічого не знайдено" . "</div>";
}