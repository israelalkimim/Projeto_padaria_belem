<?php 
// Função para cadastrar produtos
// Chamando quando o formulário de cadastro for enviado
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o dados foram enviados.
    $produto = $_POST['produto'];
    $preco = $_POST['preco'];
    $codigo = $_POST['codigo'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $sql = "INSERT INTO produtos (produto, preco, codigo, quantidade, categoria, validade) VALUES ('$produto', '$preco', '$codigo', '$quantidade', '$categoria', '$validade')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?mensagem=Produto cadastrado com sucesso!");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
    }
}

?>