<?php
session_start();
include("1_conexao.php");

$formaPagamento = $_POST['form-de-pagto'];
$formaEntrega = $_POST['form-de-entrega'];

echo "aaa"; 
//var_dump($formaEntrega, $formaPagamento); //pra ver o valor de dentro das variáveis.

if (isset($_POST['form-de-pagto'], $_POST['form-de-entrega'])) {
    echo "Variáveis de pagamento e entrega estão definidas."; // Mensagem de depuração

    
        // Tem que preparar a consulta SQL antes
        $sql = "UPDATE Pedido SET formaDePagamento = ?, formaDeEntrega = ? WHERE clientePedido_fk = ?";

    if (isset($_SESSION['idCliente'])) {
        echo "ID do cliente na sessão: " . $_SESSION['idCliente']; // Mensagem de depuração

        $idCliente_fk = $_SESSION['idCliente'];

        if ($stmt = mysqli_prepare($conexao, $sql)) {
            // Vincule os parâmetros da consulta
            mysqli_stmt_bind_param($stmt, 'sss', $formaPagamento, $formaEntrega, $idCliente_fk);

            if (mysqli_stmt_execute($stmt)) {
                echo "Dados de forma de pagamento e entrega atualizados com sucesso!";
                //header("Location: http://127.0.0.1:5500/html/6_nota_fiscal.html");
                exit;
            } else {
                echo "Erro ao atualizar os dados: " . mysqli_error($conexao);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao passar o ID do cliente para este ponto.";
    }
} else {
    echo "Erro nos isset das variáveis.";
}
?>
