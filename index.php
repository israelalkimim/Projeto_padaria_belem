<?php include 'conexao.php'; ?>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Padaria Belém</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1568254183919-78a4f43a2877?auto=format&fit=crop&q=80&w=1920'); /* Mantém a URL da imagem de padaria */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 120;
            /* padding-bottom: 120px; /* rodapé e sobrepor conteúdo */
        }

        
        .stock-title-bar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            text-align: center; 
        }
        .stock-title-bar h1.display-4 { 
            font-size: 2.75rem;  
            font-weight: 600; 
            margin-bottom: 0; 
            color: white !important; 
        }

               .content-card {
            background-color: rgba(248, 244, 237, 0.94) !important; 
            border: 1px solid rgba(210, 190, 170, 0.4); 
            border-radius: 0.5rem; 
        }
        .content-card h3 {
            color: #6B4F40;
            font-weight: 500;
        }

        /* Modal */
        .modal-content {
            background-color: rgba(252, 250, 245, 0.98) !important; 
            border: 1px solid rgba(200, 180, 160, 0.5);
            border-radius: 0.5rem;
        }
        .modal-header {
            border-bottom: 1px solid rgba(200, 180, 160, 0.3);
        }
        .modal-title {
            color: #5c3d2e;
        }
        .modal-footer {
            border-top: 1px solid rgba(200, 180, 160, 0.3);
        }

               .custom-footer {
            text-align: center;
            padding: 25px 0;
            background-color: rgba(50, 35, 25, 0.9); 
            color: #f5e5d5; /* Cor de texto creme claro */
            width: 100%;
        }
        .custom-footer .footer-line {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .custom-footer .copyright-info {
            font-size: 0.9em;
            opacity: 0.9;
        }
    </style>

</head>

<body>

    <div class="container-fluid page-header py-6 wow fadeIn">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Padaria Belém</h1>
            <div style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
                <a href="logout.php" class="btn btn-warning btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Sair
                </a>
            </div>
        </div>
    </div>

    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <!-- TARJA "Estoque da Padaria" -->
            <div class="bg-primary text-light rounded-bottom p-3 mt-0 wow fadeInUp stock-title-bar mb-4"> 
                <div class="row g-4 align-items-center">
                    <div class="col-lg-12 text-center"> 
                        <h1 class="display-4 text-light mb-0">Estoque da Padaria</h1> 
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                   
                    <div class="rounded p-5 shadow content-card"> 
                        <h3 class="mb-4 text-center">Adicionar Produto ao Estoque</h3>
                        <form action="cadastrar_produto.php" method="POST">
                           
                             <div class="mb-3"><label class="form-label">Produto</label><input type="text"
                                    class="form-control" name="produto"></div>
                            <div class="mb-3"><label class="form-label">Preço</label><input type="text"
                                    class="form-control" name="preco"></div>
                            <div class="mb-3"><label class="form-label">Código</label><input type="number"
                                    class="form-control" name="codigo"></div>
                            <div class="mb-3"><label class="form-label">Quantidade</label><input type="number"
                                    class="form-control" name="quantidade"></div>
                            <div class="mb-3">
                                <label class="form-label">Categoria</label>
                                <select class="form-select" name="categoria">
                                    <option selected>Selecione...</option>
                                    <option value="Pães">Pães</option>
                                    <option value="Doces">Doces</option>
                                    <option value="Bolos">Bolos</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Frios">Frios</option>
                                    <option value="Sucos">Sucos</option>
                                    <option value="Salgados">Salgados</option>
                                    <option value="Manteigas">Manteigas</option>
                                    <option value="Café">Café</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>
                            <div class="mb-3"><label class="form-label">Data de Validade</label><input type="date"
                                    class="form-control" name="validade"></div>
                            <button type="submit" class="btn btn-primary w-100">Adicionar ao Estoque</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-lg-12">
                    
                    <div class="rounded p-5 shadow content-card"> 
                        <div class="table-responsive">
                          
                            <table class="table table-striped table-bordered text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                        <th>Código</th>
                                        <th>Quantidade</th>
                                        <th>Categoria</th>
                                        <th>Validade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelaProdutos">
                                    <?php
                                    $limite = 10;
                                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                    $pagina = max(1, $pagina);
                                    $offset = ($pagina - 1) * $limite;

                                    $sql = "SELECT * FROM produtos ORDER BY id ASC LIMIT ?, ?";
                                    $stmt = $conn->prepare($sql);
                                    if ($stmt) {
                                        $stmt->bind_param("ii", $offset, $limite);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='" . htmlspecialchars($row['id']) . "' data-produto='" . htmlspecialchars($row['produto']) . " 'data-preco='" . htmlspecialchars($row['preco']) . "' data-codigo='" . htmlspecialchars($row['codigo']) . "' data-quantidade='" . htmlspecialchars($row['quantidade']) . "' data-categoria='" . htmlspecialchars($row['categoria']) . "' data-validade='" . htmlspecialchars($row['validade']) . "'>";
                                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['produto']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['codigo']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['validade']) . "</td>";;
                                            echo "<td>
                                                    <button type='button' class='btn btn-warning btn-sm btn-editar' data-bs-toggle='modal' data-bs-target='#modalEditar'>Editar</button>
                                                    <button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='" . htmlspecialchars($row['id']) . "'>Excluir</button> </td>";
                                            echo "</tr>";
                                        }
                                        $stmt->close();
                                    } else {
                                        echo "<tr><td colspan='8'>Erro ao preparar a consulta inicial.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $sql_total = "SELECT COUNT(*) as total FROM produtos";
                            $result_total = mysqli_query($conn, $sql_total);
                            $total_items = 0;
                            if ($result_total) {
                                $row_total = mysqli_fetch_assoc($result_total);
                                $total_items = $row_total['total'];
                            }
                            $total_paginas = ceil($total_items / $limite);
                            if ($pagina > $total_paginas && $total_paginas > 0) {
                                 $pagina = $total_paginas;
                            } elseif ($total_paginas == 0) {
                                 $pagina = 1;
                            }
                            ?>
                            <nav>
                                <ul class="pagination justify-content-center mt-3" id="paginacao-container">
                                    <?php if ($pagina > 1 && $total_paginas > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina - 1; ?>"
                                            data-page="<?= $pagina - 1; ?>">Anterior</a></li>
                                    <?php else: ?>
                                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                            aria-disabled="true">Anterior</a></li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                    <li class="page-item <?= ($pagina == $i) ? 'active' : ''; ?>"><a class="page-link"
                                            href="?pagina=<?= $i; ?>" data-page="<?= $i; ?>"><?= $i; ?></a></li>
                                    <?php endfor; ?>

                                    <?php if ($pagina < $total_paginas && $total_paginas > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina + 1; ?>"
                                            data-page="<?= $pagina + 1; ?>">Próxima</a></li>
                                    <?php else: ?>
                                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                            aria-disabled="true">Próxima</a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEditar" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="atualizar_produto.php" method="POST">
                           
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editId" name="id">
                                <div class="mb-3"><label class="form-label">Produto</label><input type="text"
                                        class="form-control" id="editProduto" name="produto"></div>
                                <div class="mb-3"><label class="form-label">Preço</label><input type="text"
                                        class="form-control" id="editPreco" name="preco"></div>
                                <div class="mb-3"><label class="form-label">Código</label><input type="text"
                                        class="form-control" id="editCodigo" name="codigo"></div>
                                <div class="mb-3"><label class="form-label">Quantidade</label><input type="number"
                                        class="form-control" id="editQuantidade" name="quantidade"></div>
                                <div class="mb-3">
                                    <label class="form-label">Categoria</label>
                                    <select class="form-select" id="editCategoria" name="categoria">
                                        <option value="Pães">Pães</option>
                                        <option value="Doces">Doces</option>
                                        <option value="Bolos">Bolos</option>
                                        <option value="Bebidas">Bebidas</option>
                                        <option value="Frios">Frios</option>
                                        <option value="Sucos">Sucos</option>
                                        <option value="Salgados">Salgados</option>
                                        <option value="Manteigas">Manteigas</option>
                                        <option value="Café">Café</option>
                                        <option value="Outros">Outros</option>
                                    </select>
                                </div>
                                <div class="mb-3"><label class="form-label">Data de Validade</label><input type="date"
                                        class="form-control" id="editValidade" name="validade"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="custom-footer">
        <div class="container">
            <div class="footer-line">
                Desenvolvido por: Israel Alkimim, Vinicius Felgueiras Lindoso, Winicius Ferreira Pichirillo, Iara Pereira De Almeida, Jonathan Pirote Da Silva, João Vitor De Vasconcelos Torres
            </div>
            <div class="footer-line">
                Projeto Integrador UNIVESP - Engenharia da Computação/BTI
            </div>
            <div class="footer-line copyright-info">
                Todos os direitos reservados © Universidade Virtual do Estado de São Paulo (UNIVESP) 2025 - Padaria Belém
            </div>
        </div>
    </footer>

    <script>
    // SCRIPTS JavaScript 
    $(document).ready(function() {
        $('#tabelaProdutos').on('click', '.btn-editar', function() {
            const row = $(this).closest('tr');
            $('#editId').val(row.data('id'));
            $('#editProduto').val(row.data('produto'));
            $('#editPreco').val(row.data('preco'));
            $('#editCodigo').val(row.data('codigo'));
            $('#editQuantidade').val(row.data('quantidade'));
            $('#editCategoria').val(row.data('categoria'));
            $('#editValidade').val(row.data('validade'));
        });
    });
    
    $(document).ready(function() {
        let currentPage = <?= $pagina ?>; 

        function loadPage(page) {
            if (page < 1) page = 1;
            $('#tabelaProdutos').html(
                '<tr><td colspan="8" class="text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Carregando...</span></div> Carregando dados...</td></tr>'
                );
            $('#paginacao-container').addClass('disabled-pagination');
            $('.btn-editar, .btn-excluir, form button[type="submit"]').prop('disabled', true);
            $('form input, form select, form textarea').prop('disabled', true);

            $.ajax({
                url: 'buscar_dados_paginados.php',
                type: 'GET',
                data: {
                    pagina: page
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#tabelaProdutos').html(response.html_tabela); 
                        $('#paginacao-container').html(response.html_paginacao); 
                        currentPage = page; 
                    } else {
                        alert('Erro ao carregar dados: ' + (response.message || 'Erro desconhecido do servidor.'));
                        $('#tabelaProdutos').html(
                            '<tr><td colspan="8" class="text-center text-danger">Falha ao carregar dados. Tente novamente.</td></tr>'
                            );
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Erro na requisição AJAX de paginação: ' + textStatus);
                    $('#tabelaProdutos').html(
                        '<tr><td colspan="8" class="text-center text-danger">Falha na comunicação com o servidor ao carregar dados.</td></tr>'
                        );
                    console.error("AJAX Pagination Error:", textStatus, errorThrown, jqXHR.responseText);
                },
                complete: function() {
                    $('#paginacao-container').removeClass('disabled-pagination');
                    $('.btn-editar, .btn-excluir, form button[type="submit"]').prop('disabled', false);
                    $('form input, form select, form textarea').prop('disabled', false);
                }
            });
        }

        $('#paginacao-container').on('click', '.page-link', function(event) {
            if ($(this).closest('.page-item').hasClass('disabled') || $(this).closest('.page-item').hasClass('active')) {
                event.preventDefault();
                return;
            }
            event.preventDefault();
            var page = $(this).data('page');
            loadPage(page); 
        });

        $('form[action="cadastrar_produto.php"]').on('submit', function(event) {
            event.preventDefault(); 
            var formData = $(this).serialize(); 
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adicionando...'
                );

            $.ajax({
                url: 'cadastrar_produto_ajax.php', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message); 
                        $('form[action="cadastrar_produto.php"]')[0].reset(); 
                        loadPage(currentPage); 
                    } else {
                        alert('Erro ao cadastrar: ' + (response.message || 'Erro desconhecido.'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Erro na requisição AJAX de cadastro: ' + textStatus);
                    console.error("AJAX Add Error:", textStatus, errorThrown, jqXHR.responseText);
                },
                complete: function() {
                    submitButton.prop('disabled', false).html('Adicionar ao Estoque'); 
                }
            });
        });

        $('form[action="atualizar_produto.php"]').on('submit', function(event) {
            event.preventDefault(); 
            var formData = $(this).serialize(); 
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvando...'
                );

            $.ajax({
                url: 'atualizar_produto_ajax.php', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message); 
                        $('#modalEditar').modal('hide'); 
                        loadPage(currentPage);
                    } else {
                        alert('Erro ao atualizar: ' + (response.message || 'Erro desconhecido.'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Erro na requisição AJAX de atualização: ' + textStatus);
                    console.error("AJAX Edit Error:", textStatus, errorThrown, jqXHR.responseText);
                },
                complete: function() {
                    submitButton.prop('disabled', false).html('Salvar Alterações'); 
                }
            });
        });

        $('#tabelaProdutos').on('click', '.btn-excluir', function(event) {
            event.preventDefault(); 
            const productId = $(this).data('id'); 
            const row = $(this).closest('tr'); 
            if (confirm('Tem certeza que deseja excluir este produto (ID: ' + productId + ')?')) {
                const deleteButton = $(this);
                deleteButton.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    );

                $.ajax({
                    url: 'excluir_produto_ajax.php', 
                    type: 'POST', 
                    data: {
                        id: productId
                    }, 
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message); 
                            loadPage(currentPage); 
                        } else {
                            alert('Erro ao excluir: ' + (response.message || 'Erro desconhecido.'));
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Erro na requisição AJAX de exclusão: ' + textStatus);
                        console.error("AJAX Delete Error:", textStatus, errorThrown, jqXHR.responseText);
                    },
                    complete: function() {
                        deleteButton.prop('disabled', false).html('Excluir'); 
                    }
                });
            }
        });
    });
    </script>

</body>
</html>