<?php
session_start();
require "configDatabase.php";

if (!isset($_SESSION['usuario'])) {
    echo "nao_logado";
    exit;
}

$user = $_SESSION['usuario'];

// Salvar nova anotação
if (isset($_POST['action']) && $_POST['action'] === "salvar") {
    $texto = $_POST['texto'];
    $sql = "INSERT INTO anotacoes (titulo,autor, texto) VALUES ('$titulo','$autor', '$anotacao')";
    $conn->query($sql);
    echo "ok";
}

// Listar anotações
if (isset($_POST['action']) && $_POST['action'] === "listar") {
    $sql = "SELECT * FROM anotacoes WHERE usuario='$autor' ORDER BY id DESC";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        echo "<p>{$row['texto']}</p>";
    }
}