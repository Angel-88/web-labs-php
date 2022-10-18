<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab7</title>
    <style>
        html {
            box-sizing: border-box;
            font-size: 10px;
        }

        .body {
            padding: 0;
            width: 100%;
            background: #f66222;

        }

        .container {
            width: 60%;
            margin: 15px auto;
        }

        .search {
            width: 400px;
            margin: 15px auto;
        }

        .title {
            font-size: 28px;
        }

        .search-input {
            margin: 10px 0;
            padding: 10px;
            font-size: 30px;
            box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        }

        <?php include './dist/css/index.css' ?>


    </style>
    <script>
        function handleKeyPress(event) {
            document.getElementById("search_results").innerHTML = "";

            const searchTerm = event.target.value;
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("search_results").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", `./search.php?query=${searchTerm}`);
            xmlhttp.send();
        }
    </script>
</head>
<body class="body">
<div class="container">
    <div class="search">
        <label for="fname" class="title">Пошук товару:</label>
        <input type="text" id="fname" name="fname" class="search-input" onkeyup="handleKeyPress(event)"
               onchange="handleKeyPress(event)">
    </div>
    <div id="search_results"></div>
</div>
</body>
</html>
