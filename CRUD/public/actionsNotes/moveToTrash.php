<?php

session_start();
require_once("../configDatabase.php");


if (isset($_POST)) {
    $autor = mysqli_real_escape_string($conn, trim($_POST['autor']));
    $titulo = mysqli_real_escape_string($conn, trim($_POST['titulo']));
    $text = mysqli_real_escape_string($conn, trim($_POST['text']));
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));

    $sql = "DELETE FROM anotacoes WHERE id = '$id'";
    
    mysqli_query($conn, $sql);    
}

header("Location: ../Home.php");
exit;