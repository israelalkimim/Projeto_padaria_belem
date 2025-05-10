<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

header('Content-Type: application/json'); // Define o cabeçalho de resposta como JSON

$response = ['status' => 'error', 'message' => 'Requisição inválida.']; // Resposta padrão de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados necessários foram enviados, incluindo o ID
    if (isset($_POST['id'], $_POST['produto'], $_POST['preco'], $_POST['codigo'], $_POST['quantidade'], $_POST['categoria'], $_POST['validade'])) {

        $id = (int)$_POST['id']; // Converte para inteiro
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
        } elseif ($id <= 0) {
             $response['message'] = 'ID do produto inválido.';
        }
         else {
            // Prepara a query SQL com prepared statement para segurança
            $sql = "UPDATE produtos SET produto = ?, preco = ?, codigo = ?, quantidade = ?, categoria = ?, validade = ? WHERE id = ?";

            if ($stmt = $conn->prepare($sql)) {
                // Vincula os parâmetros
                $stmt->bind_param("ssisssi", $produto, $preco, $codigo, $quantidade, $categoria, $validade, $id);

                // Executa a query
                if ($stmt->execute()) {
                    // Sucesso na atualização
                    // affected_rows pode ser 0 se nenhum dado mudou, mas a query foi bem sucedida
                    if ($stmt->affected_rows > 0) {
                         $response['status'] = 'success';
                         $response['message'] = 'Produto atualizado com sucesso!';
                    } else {
                         $response['status'] = 'success'; // sucesso se nenhum dado foi alterado (sem erro)
                         $response['message'] = 'Nenhum dado alterado para este produto.';
                    }

                } else {
                    // Erro na execução da query
                    $response['message'] = 'Erro ao atualizar produto: ' . $stmt->error;
                }
                 $stmt->close();
            } else {
                // Erro na preparação da query
                $response['message'] = 'Erro ao preparar a query de atualização: ' . $conn->error;
            }
        }
    } else {
        $response['message'] = 'Dados insuficientes para atualizar o produto.';
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