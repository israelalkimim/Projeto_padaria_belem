<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

header('Content-Type: application/json'); // Define o cabeçalho de resposta como JSON

$response = ['status' => 'error', 'message' => 'Requisição inválida.']; // Resposta padrão de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados necessários foram enviados
    if (isset($_POST['produto'], $_POST['preco'], $_POST['codigo'], $_POST['quantidade'], $_POST['categoria'], $_POST['validade'])) {

        $produto = trim($_POST['produto']);
        $preco = trim($_POST['preco']); 
        $codigo = trim($_POST['codigo']);
        $quantidade = (int)$_POST['quantidade']; // Converte para inteiro
        $categoria = trim($_POST['categoria']);
        $validade = trim($_POST['validade']);

        // Validação básica 
        if (empty($produto) || empty($codigo) || empty($categoria) || empty($validade)) {
            $response['message'] = 'Por favor, preencha todos os campos obrigatórios (Produto, Código, Categoria, Validade).';
        } elseif ($quantidade < 0) {
             $response['message'] = 'A quantidade não pode ser negativa.';
        } else {
            // Prepara a query SQL com prepared statement para segurança
            $sql = "INSERT INTO produtos (produto, preco, codigo, quantidade, categoria, validade) VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Vincula os parâmetros
                $stmt->bind_param("ssisss", $produto, $preco, $codigo, $quantidade, $categoria, $validade);

                // Executa a query
                if ($stmt->execute()) {
                    // Sucesso na inserção
                    $response['status'] = 'success';
                    $response['message'] = 'Produto adicionado ao estoque com sucesso!';
                    // Opcional: retorna o ID do novo produto se necessário
                    $response['insert_id'] = $conn->insert_id;
                } else {
                    // Erro na execução da query
                    $response['message'] = 'Erro ao adicionar produto: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                // Erro na preparação da query
                $response['message'] = 'Erro ao preparar a query de inserção: ' . $conn->error;
            }
        }
    } else {
        $response['message'] = 'Dados insuficientes para adicionar o produto.';
    }
} else {
    $response['message'] = 'Método de requisição não permitido.';
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna a resposta em formato JSON
echo json_encode($response);
exit; // Termina a execução do script
?>