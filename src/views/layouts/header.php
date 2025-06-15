<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual - Rock On</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font para Estilo Rock and Roll -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'New Rocker', cursive;
            background: linear-gradient(to right, black, #800020);
        }
        .navbar-brand, h1, h2, h5 {
            font-family: 'New Rocker', cursive;
        }

        /* Estilos de Botão Rock and Roll */
        .btn-primary {
            background-color: #8B0000; /* Vermelho Escuro */
            border-color: #000000;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #A52A2A; /* Marrom */
            border-color: #000000;
        }

        /* Estilos Personalizados para Alertas/Mensagens */
        .alert-success {
            background-color: #2E8B57; /* Verde Mar */
            color: #ffffff;
            border-color: #000000;
        }

        .alert-danger {
            background-color: #8B0000; /* Vermelho Escuro */
            color: #ffffff;
            border-color: #000000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('/'); ?>">Loja Virtual</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/'); ?>">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('products'); ?>">Produtos</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('cart'); ?>">Carrinho</a>
                </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/products'); ?>">Gerenciar Produtos</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('logout'); ?>">Sair</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('register'); ?>">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login'); ?>">Entrar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
