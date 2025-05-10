<?php
// Função para excluir produtos
// Este arquivo deve ser chamado quando o formulário de exclusão for enviado
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Verifica se o ID do produto foi enviado
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepara a consulta SQL para excluir o produto
        $sql = "DELETE FROM produtos WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?mensagem=Produto excluído com sucesso!");
        } else {
            echo "Erro ao excluir: " . mysqli_error($conn);
        }
    } 
}

?>

