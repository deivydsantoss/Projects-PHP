<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "cadastroUser";


$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
