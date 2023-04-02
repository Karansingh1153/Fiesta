<!DOCTYPE html>
<html>

<head>
    <title>404 Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --orange: rgb(255, 165, 2);
            --orangeDark: rgba(255, 165, 2, 0.65);
            --orangeExtraDark: rgba(255, 165, 2, 0.85);
            --orangeLight: rgba(255, 165, 2, 0.5);
            --orangeExtraLight: rgba(255, 165, 2, 0.3);
        }

        body {
            width: 100%;
            height: 100%;
            background-color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .btn {
            color: white;
            background-color: var(--orange);
            padding: 0.5rem 3rem;
            border-radius: 5px;
            letter-spacing: 0.1rem;
            font-weight: 600;
            transition: ease all 0.5s;
            border: solid 2px #f7f7f7;
            position: relative;
            text-decoration: none;
        }

        .btn:hover {
            background-color: white;
            color: var(--orangeExtraDark);
            border: solid 2px var(--orangeDark);
            cursor: pointer;
            box-shadow: 5px 5px 2px #d5d5d5, -5px -5px 2px #ebebeb;
        }


        img {
            width: 500px;
            height: 550px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="../404.jpg" />
        <a href="../index.php" class="btn" type="submit">Goto Site</a>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 10000);
        window.history.replaceState({}, "", "index.php");
    </script>
</body>

</html>