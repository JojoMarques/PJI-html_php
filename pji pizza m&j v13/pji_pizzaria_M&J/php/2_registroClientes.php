<?php
// incluindo as informações do cliente na tabela do banco de dados

include("1_conexao.php");

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $CPFCliente = $_POST['cpf_usu'];
    $sql = "SELECT c.CPF_cliente FROM Cliente AS c WHERE c.CPF_cliente = $CPFCliente";


    $result = $conexao->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // CPF encontrado, exiba-o
            $row = $result->fetch_assoc();
            $cpfEncontrado = $row["CPF_cliente"];
            echo "CPF encontrado: " . $cpfEncontrado;
        } else {
            echo "CPF não encontrado";
        }
    } else {
        echo "Erro na consulta: " . $conexao->error;
    }

    $nomeCliente = $_POST['nome_usu'];
    $logradouroCliente = $_POST['logradouro_usu'];
    $numLogCliente = $_POST['nro_usu'];
    $CEPCliente = $_POST['cep_usu'];
    $bairroCliente = $_POST['bairro_usu'];
    $cidadeCliente = $_POST['cidade_usu'];
    $estadoLogCliente = $_POST['estado_usu'];
    $complementoLogCliente = $_POST['complemento_usu'];
    $DDDCliente = $_POST['ddd_usu'];
    $telefoneCliente = $_POST['tel_usu'];

    // verifica se todas as variáveis estão definidas
    if (
        isset($CPFCliente) && isset($nomeCliente) && isset($logradouroCliente) && isset($numLogCliente) &&
        isset($CEPCliente) && isset($bairroCliente) && isset($cidadeCliente) && isset($estadoLogCliente) &&
        isset($complementoLogCliente) && isset($DDDCliente) && isset($telefoneCliente)
    ) {
        // Inserindo no banco de dados
        $sql = "INSERT INTO Cliente(CPF_cliente, nomeCliente, logradouro, numero, CEP_endereco, bairro, cidade, estado, complemento, DDD_telefoneCliente, numero_telefoneCliente)
                VALUES ('$CPFCliente', '$nomeCliente', '$logradouroCliente', '$numLogCliente', '$CEPCliente', '$bairroCliente', '$cidadeCliente', '$estadoLogCliente', '$complementoLogCliente', '$DDDCliente', '$telefoneCliente')";

      
        if ($conexao->query($sql) === TRUE) {
            header("Location: http://127.0.0.1:5500/pji_pizzaria_M&J/html/4_cardapio.html");
            echo "Os dados foram inseridos no banco com sucesso!";
        } else {
            echo "Erro ao inserir os dados no banco: " . $conexao->error;
        }

        // Fechar conexão com o banco
        $conexao->close();
    } else {
        echo "Alguns campos não foram preenchidos no formulário.";
    }
} else {
    echo "O formulário não foi submetido.";
}
?>