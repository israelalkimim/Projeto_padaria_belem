<!-- CÓDIGO PARA O CONTROLE DE ESTOQUE DA PADARIA -->
<!-- DESCRIÇÃO: Este código é um sistema de controle de estoque para uma padaria. Ele permite adicionar produtos ao estoque, visualizar os produtos cadastrados e realizar operações de edição e exclusão. O sistema utiliza PHP e MySQL para gerenciar os dados no HeidiSQL usando o XAMPP como servidor local. -->
<!-- AUTOR: Nome dos Autores: -->
<!-- INÍCIO DO CÓDIGO PHP/HTML/Bootstrap-->
<!-- CONEXÃO COM O BANCO DE DADOS -->	
<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Padaria Belém</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap & Template CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <!-- Header -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s" style="margin-bottom: 0px; position: sticky;
      top: 0;
      text-align: center;
      z-index: 100;">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-3">Produtos</h1>
        </div>
    </div>

    <!-- Formulário de Produto -->
    <div class="container-xxl bg-light my-6 py-6 pt-0" style="display:flex; justify-content: center; margin-top: 0px; max-width: 100vw; margin-bottom: 0px; padding: 0px;">
        <div class="container" style="max-width: 100vw; padding: 0px; margin-bottom: 15px;">
            <div class="bg-primary text-light rounded-bottom p-3 my-0 mt-0 wow fadeInUp" data-wow-delay="0.1s" style="display: flex; justify-content: center; align-items: center; padding: 0px; margin-bottom: 0px; max-width: 100vw; padding: 0px;">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-12 text-center">
                        <h1 class="display-4 text-light mb-0">Controle de Estoque da Padaria</h1>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.2s" style="margin-top:10px">
                <div class="col-lg-8" style="width: 92vw;">
                    <div class="bg-white rounded p-2 shadow">
                        <h3 class="mb-4 text-center" style="font-size: 40px;">Adicionar Produto ao Estoque</h3>
                        <div>
                        <form action="cadastrar_produto.php" method="POST" style="display: flex; justify-content: space-around; align-items: center; margin: 0px 20px 0px 20px; padding: 0px;">
                            <div class="mb-3" style="width: 200px;">
                                <label for="nomeProduto" class="form-label">Produtos</label>
                                <input type="text" class="form-control" id="nomeProduto" name="produto" placeholder="Ex: Pão Francês">
                            </div>
                            <div class="mb-3" style="width: 100px;">
                                <label for="codigoProduto" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigoProduto" name="codigo" placeholder="0123456789">
                            </div>
                            <div class="mb-3" style="width: 100px;">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Ex: 100">
                            </div>
                            <div class="mb-3" style="width: 150px;">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select class="form-select" id="categoria" name="categoria">
                                    <option selected>Selecione...</option>
                                    <option value="Pães">Pães</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Bolos">Bolos</option>
                                    <option value="Bebidas">Bebidas</option>
                                </select>
                            </div>
                            <div class="mb-3" style="width: 150px;">
                                <label for="validade" class="form-label">Data de Validade</label>
                                <input type="date" class="form-control" id="validade" name="validade">
                            </div>
                            <div class="mb-4" style="width: 400px;">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Observações sobre o produto..."></textarea>
                            </div>
                        </form>
                        </div>
                        <div style="margin: 10px 20px 20px 20px ;">             
                            <button type="submit" class="btn btn-primary w-100" >Adicionar ao Estoque</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEÇÃO DE RETORNO DOS DADOS PARA (TABELA) -->
            <div class="row justify-content-center mt-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-12" style="width: 92vw;">
                    <div class="bg-white rounded p-5 shadow">
                        <h3 class="text-center mb-4">Estoque Atual</h3>

                        <div class="table-resposive" style="max-height: 600px; overflow-y: auto;"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="white-space: nowrap;">ID</th>
                                        <th style="white-space: nowrap;">Produto</th>
                                        <th style="white-space: nowrap;">Código</th>
                                        <th style="white-space: nowrap;">Quantidade</th>
                                        <th style="white-space: nowrap;">Categoria</th>
                                        <th style="white-space: nowrap;">Validade</th>
                                        <th style="white-space: nowrap;">Descrição</th>
                                        <th style="min-width: 150px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelaProdutos">
                                    <?php
                                    // Conexão com o banco de dados
                                    $limite = 10; // Número de registros por página
                                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                    $offset = ($pagina - 1) * $limite;

                                    $sql = "SELECT * FROM produtos ORDER BY id ASC LIMIT $limite OFFSET $offset";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['produto'] . "</td>";
                                            echo "<td>" . $row['codigo'] . "</td>";
                                            echo "<td>" . $row['quantidade'] . "</td>";
                                            echo "<td>" . $row['categoria'] . "</td>";
                                            echo "<td>" . $row['validade'] . "</td>";
                                            echo "<td>" . $row['descricao'] . "</td>";
                                            echo "<td>
                                                <a href='editar_produto.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                                                <a href='excluir_produto.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir este produto?')\">Excluir</a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>Nenhum produto cadastrado.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            // Contar total de registros
                            $sql_total = "SELECT COUNT(*) as total FROM produtos";
                            $result_total = mysqli_query($conn, $sql_total);
                            $row_total = mysqli_fetch_assoc($result_total);
                            $total_registros = $row_total['total'];
                            $total_paginas = ceil($total_registros / $limite);
                            ?>

                            <!-- Paginação -->
                            <nav>
                                <ul class="pagination justify-content-center mt-3">
                                    <?php if ($pagina > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?pagina=<?= $pagina - 1; ?>">Anterior</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                        <li class="page-item <?= ($pagina == $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="?pagina=<?= $i; ?>"><?= $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($pagina < $total_paginas): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?pagina=<?= $pagina + 1; ?>">Próxima</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
            <!-- FIM DA TABELA -->
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn">
        <div class="container text-center">
            &copy; <a href="#">Padaria Belém</a>, Todos os direitos reservados.
            <br>Design por <a href="https://htmlcodex.com">HTML Codex</a> | Distribuído por <a href="https://themewagon.com">ThemeWagon</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>