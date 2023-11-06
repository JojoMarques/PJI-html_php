<?php
//incluindo as informações do pedido do cliente na sua tabela []

include("1_conexao.php");   

$Total = $_POST['total'];
$qtdMussarela = $_POST['inputPizza_1'];

//subtotalMussarela = valorMussarela * $qtdMussarela
/*
a maris disse que é pra pegar o input da qtd de pizzas (cada piza tem um específico) --> usar as coisas 
do próprio html

//verifica se o botão de enviar está funcionando
if(isset($_POST['nomedoBotãoInputHidden']) && $POST['nomedoBotãoInputHidden'] == "valuedoBotãoInputHidden"){
    $campo = $_POST['nomeDaCheckBox'];
    foreach($campo as $value){
        echo $value; --> pra testar
        ai, cria o INSERT aqui dentro:

    if(isset ($conexao) || isset($sql)){
    //inserindo no banco
    $sql = "INSERT INTO Pedido(Produto) VALUES ('$value'); --> mas como eu vou adicionar o campo "produto", dentro de pedido?

    if(mysqli_query($conexao, $sql)){
        echo "foi :)";
    }else{
        echo "não foi :(";
    }
    mysqli_close($conexao);//fechando a conexão
    }
}
    }
}
*/