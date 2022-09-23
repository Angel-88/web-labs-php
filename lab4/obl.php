<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab3</title>
    <style>
        .form {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 10px;
        }

        .label {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .select {
            font-size: 16px;
            padding: 5px;
        }

        .btn {
            margin-top: 10px;
            padding: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
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

$oblCount = reset($arr);
?>
<form method="get" action="detailObl.php" class="form">
    <label class="label" for="obl">Choose a oblast: </label>
    <select class="select" name="obl" id="obl">
        <?php
        for ($counter = 0; $counter < count($arr); $counter++) {
            if (($counter - 1) % 3 == 0) { ?>
                <option name="oblast" value="<?php echo $arr[$counter]; ?>">
                    <?php echo $arr[$counter] ?>
                </option>
                <?php echo "<p> $arr[$counter]</p>";
            }
        }
        ?>
        <input class="btn" type="submit" name="submit" value="Відправити запит">
</form>
</body>
</html>
