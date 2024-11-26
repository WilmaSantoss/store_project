<?php 
    /* conexao com a base de dados */
    $hostname = "localhost";
    $usuario = "root";
    $senha = "root";
    $bancodedados = "hypertechpc";

    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);


    if ($mysqli->connect_errno) {
        die ("Falha do conectar ao banco de dados: " . $mysqli->error);
    }
        
?>  