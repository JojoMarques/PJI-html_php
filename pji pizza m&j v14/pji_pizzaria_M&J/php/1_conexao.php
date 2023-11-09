<?php
//nesse docs, estamos conectando o banco de dados com PHP

    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "Jojo_dev0308";
    $dbName = "mjpizzas_bdd";

    //variável de conexão
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    //verificação se a conexão foi efetuada
 /*   if($conexao -> connect_errno){
        echo "Erro :(";
    }
    else{
        echo "Conexão efetuada com sucesso :)";
    }*/

?>