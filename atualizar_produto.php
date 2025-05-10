<?php 

// Função para atualizar produtos
// Este arquivo deve ser chamado quando o formulário de atualização for enviado
 
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID do produto foi enviado
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $produto = $_POST['produto'];
        $codigo = $_POST['codigo'];
        $quantidade = $_POST['quantidade'];
        $categoria = $_POST['categoria'];
        $validade = $_POST['validade'];
        $descricao = $_POST['descricao'];

        // Prepara a consulta SQL para atualizar o produto
        $sql = "UPDATE produtos SET produto='$produto', codigo='$codigo', quantidade='$quantidade', categoria='$categoria', validade='$validade', descricao='$descricao' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?mensagem=Produto atualizado com sucesso!");
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conn);
        }
    } 
}

?>
