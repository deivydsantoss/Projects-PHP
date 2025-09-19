<?php

    if(isset($_POST["submit"])){

        include_once('config.php');

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone = $_POST["telefone"];
        $sexo = $_POST["genero"];
        $data_nasc = $_POST["data_nascimento"];
        $estado = $_POST["estado"];
        $cidade = $_POST["cidade"];
        $endereco = $_POST["endereco"];

        $result = mysqli_query($conn,"INSERT INTO usuarios(nome, email, senha, telefone, sexo, data_nasc, estado, cidade, endereco)
        VALUES ('$nome','$email','$senha','$telefone','$sexo','$data_nasc','$estado','$cidade','$endereco')");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
            color: #fff;
        }

        fieldset{
            border: 3px solid dodgerblue;
            border-radius: 5px;
        }

        legend{
            background-color: dodgerblue;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .inputBox{
            position: relative;
        }

        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 15px;
            color: rgb(20, 147, 220);
        }

        #data_nascimento{
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 10px;
            font-size: 15px;
        }

        #submit{
            width: 100%;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(154, 43, 206));
            padding: 15px;
            font-size: 15px;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            color: #fff;
            transition: all 0.6s ease;
        }
        #submit:hover{
            background-image: linear-gradient(to right, rgb(25, 62, 139),rgb(102, 13, 143));
        }
    </style>
</head>
<body>
    <a href="home.php">Voltar</a>
    <div class="box">
        <form action="index.php" method="POST">
            <fieldset>
                <legend><b>Formulário Cliente</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser " required>
                    <label class="labelInput" for="nome">Nome Completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser " required>
                    <label class="labelInput" for="email">E-mail</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser " required>
                    <label class="labelInput" for="senha">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser " required>
                    <label class="labelInput" for="telefone">Telefone</label>
                </div>
                <br><br>

                <p>Sexo:</p>
                <input type="radio" name="genero" id="feminino" value="feminino" required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" name="genero" id="masculino" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br><br>


                <label for="data-nascimento"><b>Data de nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento"  required>

                <br><br>

                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser " required>
                    <label class="labelInput" for="estado">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser " required>
                    <label class="labelInput" for="cidade">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser " required>
                    <label class="labelInput" for="endereco">Endereço</label>
                </div>
                <br><br>

                <input type="submit" id="submit" name="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>