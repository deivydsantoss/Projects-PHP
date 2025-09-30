<?php


require_once("../configDatabase.php");


if (isset($_POST)) {
    $id = mysqli_real_escape_string($conn, trim($_POST['id']));

    $sql = "DELETE FROM anotacoes WHERE id = '$id'";
    
    mysqli_query($conn, $sql);    
}
