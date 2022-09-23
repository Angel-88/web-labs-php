<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        width: 50%;
        border-collapse: collapse;
        border: 3px solid black;
        text-align: center;
        margin: 0 auto;
        font-size: 14px;
    }

    .column__title {
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }

    td {
        padding: 5px;
        border: 1px solid black;
    }
    }
</style>
<body>
<?php
if (!file_exists("oblinfo.txt")) {
    echo "The file from above cannot be found!";
    exit;
}

$arr = file("oblinfo.txt");

if (!$arr) {
    echo "File cannot be opened";
    exit;
}

$napr = $_GET["obl"];
echo "<a href='obl.php'>Повернутись до вибору </a>";
echo "<br />";

?>
<table>
    <tr>
        <td class="column__title">Область</td>
        <td class="column__title">Насел, тис</td>
        <td class="column__title">Кількість університетів</td>
        <td class="column__title">Кількість університетів на 100 тис населення</td>
    </tr>
    <?php
    foreach ($arr as $key => $line) {
        if (trim($line) === trim($napr)) {
            echo $line;
            echo "<tr>";
            for ($j = 0; $j < 3; $j++) {

                $colValue = $arr[$key + $j];
                echo "<td>$colValue</td>";

                if ($j == 1) {
                    $two = $colValue;
                }
                if ($j == 2) {
                    $three = $colValue;
                    $universitiesNumber = round($three * 100 / $two, 2);
                    echo "<td>$universitiesNumber</td>";
                }
            }
            echo "</tr>";
        }
    }
    ?>
</table>
</body>
</html>