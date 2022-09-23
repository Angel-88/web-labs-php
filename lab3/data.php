<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab3</title>
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
</head>
<body>

<?php

$file = file("data.txt");
$napr = $_GET["radio"];
echo "<a href='napr.php'>Повернутись до вибору напрямку</a>";
echo "<br />";

foreach ($file

         as $key => $line) {
    if (trim($line) === trim($napr)) {
        $universityCount = $file[$key + 1];
        echo "<table>";
        echo $line;
        ?>
        <tr>
            <td class="column__title">Середній бал бюджетників</td>
            <td class="column__title">Кількість бюджетників</td>
            <td class="column__title">Недобір</td>
            <td class="column__title">Кількість контрактників</td>
            <td class="column__title">Університет</td>
        </tr>
        <?php
        for ($i = 0; $i < $universityCount; $i++) {
            echo "
<tr>";
            $indexOfFirstCol = 2 + $i * 4;
            $indexOfLastCol = $indexOfFirstCol + 3;
            for ($j = $indexOfFirstCol; $j <= $indexOfLastCol; $j++) {
                $colValue = $file[$key + $j];
                $ned = "-";
                $indexOfThirdCol = $indexOfFirstCol + 2;
                if ($j === $indexOfThirdCol && (int)$colValue <= 0) {
                    $ned = (int)$colValue < 0 ? (int)$colValue * -1 : "-";
                    $colValue = "-";
                }
                if ($j === $indexOfThirdCol) {
                    echo "
    <td>$ned</td>
    ";
                    echo "
    <td>$colValue</td>
    ";
                } else {
                    echo "
    <td>$colValue</td>
    ";
                }
            }
            echo "
</tr>
";
        }

        echo " </table >";
    }
}
?>
</body>
</html>
