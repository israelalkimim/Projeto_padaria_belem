<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'projeto_pi'; // ou o nome do seu banco

// Cria a conexão
$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se deu certo
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
