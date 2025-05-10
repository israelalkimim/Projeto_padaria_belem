<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

header('Content-Type: application/json'); // Define o cabeçalho de resposta como JSON

$response = ['status' => 'error', 'message' => 'Requisição inválida.']; // Resposta padrão de erro

// É mais seguro usar POST para exclusão, mesmo que esteja vindo de um "link" no front-end através do AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o ID foi enviado
    if (isset($_POST['id'])) {

        $id = (int)$_POST['id']; // Converte para inteiro

        // Validação básica do ID
        if ($id <= 0) {
             $response['message'] = 'ID do produto inválido para exclusão.';
        } else {
            // Prepara a query SQL com prepared statement para segurança
            $sql = "DELETE FROM produtos WHERE id = ?";

            if ($stmt = $conn->prepare($sql)) {
                // Vincula o parâmetro
                $stmt->bind_param("i", $id);

                // Executa a query
                if ($stmt->execute()) {
                    // Sucesso na exclusão
                    if ($stmt->affected_rows > 0) {
                        $response['status'] = 'success';
                        $response['message'] = 'Produto excluído com sucesso!';
                    } else {
                        // Nenhum produto encontrado com esse ID
                        $response['status'] = 'error';
                        $response['message'] = 'Nenhum produto encontrado com o ID fornecido.';
                    }
                } else {
                    // Erro na execução da query
                    $response['message'] = 'Erro ao excluir produto: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                // Erro na preparação da query
                $response['message'] = 'Erro ao preparar a query de exclusão: ' . $conn->error;
            }
        }
    } else {
        $response['message'] = 'ID do produto não fornecido para exclusão.';
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