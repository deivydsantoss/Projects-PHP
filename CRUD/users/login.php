<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

        body{
            font-family: Georgia, 'Times New Roman', Times, serif;
            color: white;
            background-image: linear-gradient(45deg,  rgb(20, 147, 220), rgb(17, 54, 71));

            height: 100vh;
            overflow-y: hidden;
        }

        .login{
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            display: flex;
            flex-direction: column;

            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);

            padding-block: 60px;
            padding-inline: 40px;

            border-radius: 15px;
        }

        form{
            display: flex;
            flex-direction:column;
        }

        input{
            margin-top: 10px;

            outline: none;
            border: none;

            padding: 8px 12px;
        }

        .btn{
            margin-top: 10px;
            text-align:center;
            border: none;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(154, 43, 206));
            color: #fff;
            padding:12px;
            border-radius: 10px;

            transition: all 0.6s ease;
            cursor: pointer;
        }

        .btn:hover{
            background-image: linear-gradient(to right, rgb(25, 62, 139),rgb(102, 13, 143));
            color: #fff;
        }
    </style>
</head>
<body>
    <a href="home.php">Voltar</a>
    <div class="login">
        <form action="" method="POST">
            <h1>Login</h1>
            <input type="email" placeholder="E-mail">
            <br>
            <input type="password" placeholder="Senha">
            <br>
            <input type="submit" name="submit" class="btn" value="Enviar">
        </form>
    </div>
</body>
</html>
</html>