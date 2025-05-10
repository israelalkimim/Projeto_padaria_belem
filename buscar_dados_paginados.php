<?php
// 1. Incluir conexão e configurar cabeçalho para JSON
header('Content-Type: application/json');
include 'conexao.php'; // Assume que $conn está aqui

// 2. Definir limite de itens por página (deve ser o mesmo da index.php)
$limite = 10;

// 3. Obter a página solicitada via GET (com validação)
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina = max(1, $pagina); // Garante que a página seja pelo menos 1

// 4. Calcular o OFFSET para a consulta SQL
$offset = ($pagina - 1) * $limite;

// --- Lógica para buscar os dados da tabela ---
$html_tabela = '';
$sql_tabela = "SELECT * FROM produtos ORDER BY id ASC LIMIT ?, ?";
$stmt_tabela = $conn->prepare($sql_tabela);

if ($stmt_tabela) {
    $stmt_tabela->bind_param("ii", $offset, $limite);
    $stmt_tabela->execute();
    $result_tabela = $stmt_tabela->get_result();

    if ($result_tabela->num_rows > 0) {
        while ($row = $result_tabela->fetch_assoc()) {
            // Monta a linha da tabela (TR) exatamente como na index.php
            // Foi usado htmlspecialchars para segurança!
            $html_tabela .= "<tr data-id='" . htmlspecialchars($row['id']) . "' data-produto='" . htmlspecialchars($row['produto']) . "' data-preco='" . htmlspecialchars($row['preco']) . "' data-codigo='" . htmlspecialchars($row['codigo']) . "' data-quantidade='" . htmlspecialchars($row['quantidade']) . "' data-categoria='" . htmlspecialchars($row['categoria']) . "' data-validade='" . htmlspecialchars($row['validade']) . "'>";
            $html_tabela .= "<td>" . htmlspecialchars($row['id']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['produto']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['preco']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['codigo']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['categoria']) . "</td>";
            $html_tabela .= "<td>" . htmlspecialchars($row['validade']) . "</td>";
            $html_tabela .= "<td>
                                <button type='button' class='btn btn-warning btn-sm btn-editar' data-bs-toggle='modal' data-bs-target='#modalEditar'>Editar</button>
                                <button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='" . htmlspecialchars($row['id']) . "'>Excluir</button>
                             </td>";
            $html_tabela .= "</tr>";
        }
    } else {
        // Mensagem se não houver produtos na página (importante!)
        $html_tabela = "<tr><td colspan='8' class='text-center'>Nenhum produto encontrado nesta página.</td></tr>"; // Colspan 8
    }
    $stmt_tabela->close();
} else {
    // Erro ao preparar a consulta da tabela
     $html_tabela = "<tr><td colspan='8' class='text-center text-danger'>Erro ao buscar dados dos produtos.</td></tr>";
     // Logar o erro real $conn->error para depuração no servidor
}


// --- Lógica para a paginação ---
$html_paginacao = '';
$total_paginas = 0;

$sql_total = "SELECT COUNT(*) as total FROM produtos";
$result_total = $conn->query($sql_total); 

if ($result_total && $result_total->num_rows > 0) {
    $total_items = $result_total->fetch_assoc()['total'];
    $total_paginas = ceil($total_items / $limite);
}


if ($pagina > $total_paginas && $total_paginas > 0) {
     $pagina = $total_paginas; // Ajusta para a última página válida
     
} elseif ($total_paginas == 0) {
    $pagina = 1;
}


if ($total_paginas > 1) { // Só mostra paginação se houver mais de uma página
    // Botão Anterior
    if ($pagina > 1) {
        $html_paginacao .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($pagina - 1) . '">Anterior</a></li>';
    } else {
        $html_paginacao .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a></li>';
    }

    // Links das Páginas
    for ($i = 1; $i <= $total_paginas; $i++) {
        $activeClass = ($pagina == $i) ? 'active' : '';
        $html_paginacao .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }

    // Botão Próxima
    if ($pagina < $total_paginas) {
        $html_paginacao .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($pagina + 1) . '">Próxima</a></li>';
    } else {
        $html_paginacao .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Próxima</a></li>';
    }
} else {
    // Pode retornar vazio ou uma mensagem se não houver paginação
    $html_paginacao = '';
}


// 5. Montando a resposta em JSON
$response = [
    'status' => (!empty($html_tabela) || $result_tabela->num_rows === 0) ? 'success' : 'error', // Sucesso mesmo se vazio, erro só se a query falhar feio
    'html_tabela' => $html_tabela,
    'html_paginacao' => $html_paginacao,
    'debug_page' => $pagina, // para depuração
    'debug_total_pages' => $total_paginas // para depuração
];

// 6. Enviar a resposta JSON
echo json_encode($response);

// 7. Fechar a conexão (se não for persistente)
$conn->close();

?>