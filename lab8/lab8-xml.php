<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab8</title>
    <style>
        p {
            font-size: 28px;
            font-weight: bold;
        }

        span {
            font-size: 20px;
        }

        p, form, span {
            text-align: center;
        }

        .container {
            font-size: 24px;
            margin: 25px;
            width: 60%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <p><strong>IP Lookup</strong></p>
    <form method="post" action="lab8-json.php">
        <input type="text" name="ip" id="ip-input" placeholder="IP" title="Enter IP Address here"/>
        <input type="submit" value="IP Lookup"/>
    </form>
    <br>
    <?php
    $resultXml = simplexml_load_file("http://ip-api.com/xml/" . $_SERVER['REMOTE_ADDR']);
    if ($resultXml === FALSE) {
        echo '<p>Помилка при запиті XML!</p>';
        return;
    }
    echo '<span>Details for ' . $resultXml->query . '</span>';
    echo '<br><br><p><strong>Geolocation Info</strong></p>';
    echo '<span>Country code: ' . $resultXml->country . '</span>';
    echo '<br><span>Flag:<img src="./src/flags_ISO_3166-1/' . strtolower($resultXml->countryCode) . '.png" /></span>';
    echo '<br><span>Region: ' . $resultXml->region . '</span>';
    echo '<br><span>Region Name: ' . $resultXml->regionName . '</span>';
    echo '<br><span>City: ' . $resultXml->city . '</span>';
    echo '<br><span>Postal Code: ' . $resultXml->zip . '</span>';
    echo '<br><span>Latitude: ' . $resultXml->lat . '</span>';
    echo '<br><span>Longitude: ' . $resultXml->lon . '</span>';
    ?>
</div>
</body>
</html>
