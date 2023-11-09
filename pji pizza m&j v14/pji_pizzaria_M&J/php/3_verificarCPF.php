<?php
/*
    include("1_conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $CPFCliente = $_POST['cpf_usu'];
        $sql = "SELECT c.CPF_cliente FROM Cliente AS c WHERE c.CPF_cliente = '$CPFCliente'";
        
        $result = $conexao->query($sql);
        
        if ($result) {
            if ($result->num_rows > 0) {
                echo json_encode(array('cpfEncontrado' => true));
            } else {
                echo json_encode(array('cpfEncontrado' => false));
            }
        } else {
            echo json_encode(array('error' => 'Erro na consulta: ' . $conexao->error));
        }
    }
*/
include("1_conexao.php");
// Verificar se a requisição é um POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Receber os dados como JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Verificar se o JSON foi decodificado com sucesso
    if ($data) {
        // Verificar se o JSON contém o campo "cpf"
        if (isset($data->cpf)) {
            // Extrair o CPF do JSON
            $cpf = $data->cpf;
            $sql = "SELECT c.CPF_cliente FROM Cliente AS c WHERE c.CPF_cliente = '$cpf'";
        
            $result = $conexao->query($sql);
            
            if ($result) {
                if ($result->num_rows > 0) {
                    $response = ["message" => true];
                } else {
                    $response = ["message" => false];
                }
            } else {
                $response = ["error" => "Erro na consulta"];
            }

        } else {
            // Se o JSON não contém o campo "cpf", retorna uma mensagem de erro
            $response = ["error" => "Campo 'cpf' não encontrado no JSON"];
        }
    } else {
        // Se o JSON não pôde ser decodificado, retorna uma mensagem de erro
        $response = ["error" => "Erro ao decodificar o JSON"];
    }

    // Definir cabeçalhos para indicar que a resposta é em JSON
    header('Content-Type: application/json');

    // Enviar a resposta em JSON de volta ao cliente
    echo json_encode($response);
} else {
    // Se a requisição não for um POST, retorne um erro
    http_response_code(405); // Método não permitido
    echo json_encode(["error" => "Método não permitido"]);
}
?>