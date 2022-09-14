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

$fp = fopen("oblinfo.txt", "r");
$arr = file("oblinfo.txt");
$elm = array_shift($arr);
$array = array_chunk($arr, 3);

if (!$fp) {
    echo "File cannot be opened";
    exit;
}
?>

<table class="city_list">
    <tr>
        <td class="column__title">№</td>
        <td class="column__title">Область</td>
        <td class="column__title">Насел, тис</td>
        <td class="column__title">Кількість університетів</td>
        <td class="column__title">Кількість унів. на 100 тис населення</td>
    </tr>
    <?php
    $count = 1;
    foreach ($array as $row) {
        echo "<tr>";
        array_unshift($row, $count);
        $universitiesNumber = round($row[3] * 100 / $row[2], 2);
        $row[] = $universitiesNumber;
        foreach ($row as $col) {
            echo "<td>{$col}</td>";
        }
        echo "</tr>";
        $count++;
    }
    ?>
</table>
<?php
fclose($fp);
?>
</body>
</html>