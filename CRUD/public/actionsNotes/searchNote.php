<?php

require_once("../configDatabase.php");

#var_dump($_GET['busca']);


#echo"oi";

$busca = mysqli_real_escape_string($conn, $_GET['busca']);

#$busca = $_GET['busca'];

$sth = $conn->query("SELECT * FROM anotacoes WHERE titulo LIKE '%$busca%' OR autor LIKE '%$busca%' OR autor LIKE '%$busca%'");
#$sth = $conn->prepare("SELECT * FROM  anotacoes WHERE titulo LIKE '%$busca%' OR autor LIKE '%$busca%' OR autor LIKE '%$busca%'");

#$sql_query = $conn->query($sth) or die("Erro ao consultar".$conn->error);

echo '<pre>';
var_dump($sth->fetch_all(MYSQLI_ASSOC));
echo 'szdfsadfsdfsdf';