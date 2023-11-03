<?php

    include("1_conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $CPFCliente = $_POST['cpf_usu'];
        $sql = "SELECT c.CPF_cliente FROM Cliente AS c WHERE c.CPF_cliente = '$CPFCliente'";
        
        $result = $conexao->query($sql);
        
        if ($result) {
            if ($result->num_rows > 0) {
                echo json_encode(array('cpfEncontrado' => true));
                header("Location: http://127.0.0.1:5500/pji_pizzaria_M&J/html/4_cardapio.html");
            } else {
                echo json_encode(array('cpfEncontrado' => false));
            }
        } else {
            echo json_encode(array('error' => 'Erro na consulta: ' . $conexao->error));
        }
    }


?>
