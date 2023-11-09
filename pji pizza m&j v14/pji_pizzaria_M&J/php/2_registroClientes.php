<?php
// Incluindo as informações do cliente na tabela do banco de dados
session_start();
include("1_conexao.php");

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $CPFCliente = $_POST['cpf_usu'];
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

    // Verifica se todas as variáveis estão definidas
    if (
        isset($CPFCliente) && isset($nomeCliente) && isset($logradouroCliente) && isset($numLogCliente) &&
        isset($CEPCliente) && isset($bairroCliente) && isset($cidadeCliente) && isset($estadoLogCliente) &&
        isset($complementoLogCliente) && isset($DDDCliente) && isset($telefoneCliente)
    ) {
        // Verificar se o CPF já existe no banco de dados
        $consultaCPF = "SELECT idCliente FROM Cliente WHERE CPF_cliente = '$CPFCliente'";
        $resultado = $conexao->query($consultaCPF);

        if ($resultado->num_rows > 0) {
            // O CPF já existe no banco de dados
            $row = $resultado->fetch_assoc();
            $idCliente = $row["idCliente"];
            $_SESSION['idCliente'] = $idCliente;
            header("Location: http://127.0.0.1:5500/html/4_cardapio.html");
            exit;
        } else {
            // O CPF não existe, insira o novo cliente no banco de dados
            $inserirCliente = "INSERT INTO Cliente (CPF_cliente, nomeCliente, logradouro, numero, CEP_endereco, bairro, cidade, estado, complemento, DDD_telefoneCliente, numero_telefoneCliente)
                VALUES ('$CPFCliente', '$nomeCliente', '$logradouroCliente', '$numLogCliente', '$CEPCliente', '$bairroCliente', '$cidadeCliente', '$estadoLogCliente', '$complementoLogCliente', '$DDDCliente', '$telefoneCliente')";
    
            if (mysqli_query($conexao, $inserirCliente)) {
                $idCliente = mysqli_insert_id($conexao);
                $_SESSION['idCliente'] = $idCliente;
                header("Location: http://127.0.0.1:5500/html/4_cardapio.html");
                exit;
            } else {
                echo "Erro ao inserir os dados do cliente no banco: " . $conexao->error;
            }
        }
    } else {
        echo "Alguns campos não foram preenchidos no formulário.";
    }
} else {
    echo "O formulário não foi submetido.";
}
?>
