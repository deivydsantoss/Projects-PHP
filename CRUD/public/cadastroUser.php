<?php
session_start();
require "configUser.php";

// LOGIN ou CADASTRO
if (isset($_POST['action']) && $_POST['action'] === "login") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se já existe usuário
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        // Já existe → verifica senha
        $row = $res->fetch_assoc();
        if ($row['senha'] === $senha) {
            $_SESSION['usuario'] = $email;
            echo "ok";
        } else {
            echo "senha_invalida";
        }
    } else {
        // Não existe → cadastra
        $sqlInsert = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
        if ($conn->query($sqlInsert)) {
            $_SESSION['usuario'] = $email;
            echo "ok";
        } else {
            echo "erro";
        }
    }
}

// LOGOUT
if (isset($_POST['action']) && $_POST['action'] === "logout") {
    session_destroy();
    echo "ok";
}
?>