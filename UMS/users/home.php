<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site | DL</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            color:#fff;
            text-align: center;
            background-image:linear-gradient(to left, rgb(20, 147, 220), rgb(17, 54, 71))
        }

        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0,0,0,0.5);
            padding: 50px;
            border-radius: 10px;
        }

        .box a{
            text-decoration: none;
            color: #fff;
            border: 1px solid dodgerblue;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.6s ease;
        }
        .box a:hover{
            border: #fff;
            background-color: dodgerblue;

        }

    </style>
</head>
<body>
    <h1>Bem vindo ao nosso Site;)</h1>

    <div class="box">
        <a href="login.php">Login</a>
        <a href="form.php">Cadastre-se</a>
    </div>
</body>
</html>