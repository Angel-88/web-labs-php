<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab3</title>
</head>
<body>
<?php
if (!file_exists("napr.txt")) {
    echo "The file from above cannot be found!";
    exit;
}

$arr = file("napr.txt");
array_multisort($arr);

if (!$arr) {
    echo "File cannot be opened";
    exit;
}

?>

<h2>PHP Form Validation</h2>
<form method="get"  action="data.php">
    <?php foreach ($arr as $id => $item) { ?>
        <input type="radio" name="radio" value="<?php echo $item; ?>">
        <?php echo $item;
        echo "<br />";
    } ?>
    <br><br>
    <input type="submit" name="submit" value="Відправити запит">
</form>

</body>
</html>
