

// Inicia a sessão para acessar a variável que tá lá no outro arquivo
session_start();

// incluindo as informações do pedido do cliente nas tabelas Pedido e PedidoProduto
include("1_conexao.php");

// essas variáveis recebem a quantidade de pizzas selecionada.
$total = str_replace(',', '.', $_POST['total']); // Formatando $total para usar um ponto como separador decimal
$qtdMussarela = $_POST['pizza-mussarela'];
$qtdCalabresa = $_POST['pizza-calabresa'];
$qtdFrangoCatupiry = $_POST['pizza-frango-catupiry'];
$qtdDoisQueijos = $_POST['pizza-dois-queijos'];
$qtdTresQueijos = $_POST['pizza-três-queijos'];
$qtdQuatroQueijos = $_POST['pizza-quatro-queijos'];
$qtdBacon = $_POST['pizza-bacon'];
$qtdPortuguesa = $_POST['pizza-portuguesa'];
$qtdMarguerita = $_POST['pizza-marguerita'];
$qtdVegetariana = $_POST['pizza-vegetariana-brócolis-queijo'];
$qtdVegana = $_POST['pizza-vegana-cogumelos-frango-soja'];
$qtdDoce = $_POST['pizza-doce-nutella-morango'];
$qtdAgua = $_POST['bebida-água'];
$qtdCocaCola = $_POST['bebida-coca-cola'];
$qtdFantaLaranja = $_POST['bebida-fanta-laranja'];
$qtdFantaUva = $_POST['bebida-fanta-uva'];
$qtdGuarana = $_POST['bebida-guarana'];
$qtdSucoLaranja = $_POST['suco-laranja'];
$qtdSucoAbacaxi = $_POST['suco-abacaxi'];
$qtdSucoMaracuja = $_POST['suco-maracujá'];
$observacoes = $_POST['observacoes'];
$idPedido_fk = null;

if (isset(
    $_POST['pizza-mussarela'], $_POST['pizza-calabresa'],
    $_POST['pizza-frango-catupiry'], $_POST['pizza-dois-queijos'], $_POST['pizza-três-queijos'],
    $_POST['pizza-quatro-queijos'], $_POST['pizza-bacon'], $_POST['pizza-portuguesa'],
    $_POST['pizza-marguerita'], $_POST['pizza-vegetariana-brócolis-queijo'],
    $_POST['pizza-vegana-cogumelos-frango-soja'], $_POST['pizza-doce-nutella-morango'],
    $_POST['bebida-água'], $_POST['bebida-coca-cola'], $_POST['bebida-fanta-laranja'],
    $_POST['bebida-fanta-uva'], $_POST['bebida-guarana'], $_POST['suco-laranja'],
    $_POST['suco-abacaxi'], $_POST['suco-maracujá'], $_POST['observacoes'], $_POST['total'])) {

    // Prepara a consulta para inserir na tabela Pedido
    $sqlPedido = "INSERT INTO Pedido (observacaoPedido, clientePedido_fk, total) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($conexao, $sqlPedido)) {
        if(isset ($_SESSION['idCliente'])){
            $idCliente_fk = $_SESSION['idCliente'];
            $observacoes = $_POST['observacoes'];
            $total = str_replace(',', '.', $_POST['total']); // Formate o valor para usar ponto como separador decimal
            mysqli_stmt_bind_param($stmt, 'sds', $observacoes, $idCliente_fk, $total);

            if (mysqli_stmt_execute($stmt)) {
                $idPedido_fk = mysqli_insert_id($conexao);
                echo "Dados do pedido inseridos com sucesso!";
            } else {
                echo "Erro ao inserir dados do pedido: " . mysqli_error($conexao);
            }
        } else {
            echo "ID do cliente inválido ou ausente.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }
    

    $qtdProdutos = array(
        $qtdMussarela, $qtdCalabresa, $qtdFrangoCatupiry, $qtdDoisQueijos,
        $qtdTresQueijos, $qtdQuatroQueijos, $qtdBacon, $qtdPortuguesa, $qtdMarguerita, $qtdVegetariana,
        $qtdVegana, $qtdDoce, $qtdAgua, $qtdCocaCola, $qtdFantaLaranja, $qtdFantaUva,
        $qtdGuarana, $qtdSucoLaranja, $qtdSucoAbacaxi, $qtdSucoMaracuja
    );

    for ($i = 0; $i < count($qtdProdutos); $i++) {
        $quantidade = $qtdProdutos[$i];
        $idProduto = $i + 1;

        if ($quantidade > 0) {
            // Prepara a consulta para inserir na tabela PedidoProduto
            $sqlPedidoProduto = "INSERT INTO PedidoProduto (quantidade, pedido_fk, produto_fk) VALUES (?, ?, ?)";

            if ($stmt = mysqli_prepare($conexao, $sqlPedidoProduto)) {
                $quantidade = $qtdProdutos[$i]; 
                $idProduto = $i + 1; 

                mysqli_stmt_bind_param($stmt, 'ddd', $quantidade, $idPedido_fk, $idProduto);
            
        
                if (mysqli_stmt_execute($stmt)) {
                    echo "Dados PedidoProduto inseridos com sucesso!";
                    header("Location:http://127.0.0.1:5500/html/5_finalizar.html");//ai pode ir pra próxima página.
                } else {
                    echo "Erro ao inserir dados PedidoProduto: " . mysqli_error($conexao);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Erro na preparação da consulta: " . mysqli_error($conexao);
            }
        }
    }
} else {
    echo "erro no isset das var"; // Se os dados do pedido não foram enviados corretamente
}
?>
