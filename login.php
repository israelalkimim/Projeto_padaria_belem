<?php
session_start();

// Se já estiver logado, redireciona para o painel
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Autenticação simples 
    if ($usuario === 'admin' && $senha === 'Euvouateofim2025') {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

  <!-- INÍCIO DOS NOVOS ESTILOS E AJUSTES -->
  <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1568254183919-78a4f43a2877?auto=format&fit=crop&q=80&w=1920'); /* Mantenha a URL da sua imagem de padaria */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 120;
            /* padding-bottom: 120px; /* Adicionar padding no final do body para o rodapé fixo e sobrepor conteúdo */
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

/* Nova caixa de login */

.login-box {
    background-color: rgba(33, 33, 33, 0.9); /* fundo grafite escuro */
    border: 1px solid rgba(255, 215, 0, 0.3); /* leve contorno dourado */
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    padding: 30px;
    color: #f0f0f0; /* texto claro */
}

/* Título */
.login-box h3 {
    color: #f5f5f5;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

/* Inputs */
.login-box .form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
}

.login-box .form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.login-box .form-control:focus {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #ffd700;
    color: #fff;
}

/* Botão */
.login-box .btn-primary {
    background-color: #ffd700;
    border: none;
    color: #1c1c1c;
    font-weight: bold;
}

.login-box .btn-primary:hover {
    background-color: #e6c200;
}

    </style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-4 login-box">
            <h3 class="text-center mb-4">Login</h3>
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
