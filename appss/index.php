<?php
session_start();
include_once('../core/config.php');

// Trava de Segurança: Aceita Admin e Cliente
if (!isset($_SESSION['email']) || ($_SESSION['nivel'] != 'admin' && $_SESSION['nivel'] != 'cliente')) {
    header('Location: ../Tela_Login.php');
    exit();
}

$menuop = isset($_GET['menuop']) ? $_GET['menuop'] : 'home';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SGCF | Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 78, 96)); 
            color: white; 
            min-height: 100vh;
            margin: 0;
        }
        .sidebar { 
            height: 100vh; 
            background: rgba(0, 0, 0, 0.5); 
            backdrop-filter: blur(10px);
            color: white; 
            padding-top: 20px; 
            position: fixed; 
            width: 250px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        .main-content { margin-left: 250px; padding: 40px; }
        .nav-link { color: rgba(255, 255, 255, 0.7); transition: 0.3s; padding: 12px 20px; margin: 5px 10px; border-radius: 10px; text-decoration: none; display: block; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(30, 144, 255, 0.4); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .glass-panel {
            background: rgba(0, 0, 0, 0.25) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        .btn-seletor { border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.3); color: white; transition: 0.3s; text-decoration: none; }
        .btn-seletor:hover { background: rgba(255, 255, 255, 0.1); color: white; }
    </style>
</head>
<body>

<nav class="sidebar">
    <div class="px-4 mb-4">
        <h5 class="fw-bold">BarberApp</h5> 
        <small class="opacity-50">Sistema de Gestão</small>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link <?php echo ($menuop=='home')?'active':''; ?>" href="index.php?menuop=home">🏠 Início</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($menuop=='eventos')?'active':''; ?>" href="index.php?menuop=eventos">📅 Agendamentos</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($menuop=='financeiro')?'active':''; ?>" href="index.php?menuop=financeiro">💰 Financeiro</a></li>
        <li class="nav-item"><a class="nav-link <?php echo ($menuop=='estoque')?'active':''; ?>" href="index.php?menuop=estoque">📦 Estoque</a></li>
        <hr class="mx-3 opacity-25">
        <li class="nav-item"><a class="nav-link text-danger" href="../Sair.php">🚪 Sair</a></li>
    </ul>
</nav>

<main class="main-content">
    <?php if(isset($_GET['status'])): ?>
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 mb-4" role="alert">
            <?php 
                if($_GET['status'] == 'sucesso') echo "✅ Operação realizada com sucesso!";
                if($_GET['status'] == 'excluido') echo "🗑️ Registro removido permanentemente.";
                if($_GET['status'] == 'atualizado') echo "✏️ Alterações salvas com sucesso!";
            ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-light">Olá, <span class="fw-bold"><?php echo explode('@', $_SESSION['email'])[0]; ?></span></h2>
        <a href="../dashboard.php" class="btn btn-seletor px-4 py-2">Voltar ao Seletor</a>
    </div>

    <div class="glass-panel">
        <?php

// Roteamento centralizado
                switch($menuop) {
                    case 'home': include("paginas/home/home.php"); break;
                    case 'eventos': include("paginas/eventos/eventos.php"); break;
                    case 'financeiro': include("paginas/home/financeiro/financeiro_novo.php"); break;
                    case 'estoque': include("paginas/estoque/estoque.php"); break;
                    case 'servicos': include("paginas/servicos/servicos.php"); break;
                    
                    // Ações de Processamento (Sem tela)
                    case 'salvar_agendamento': include("paginas/eventos/salvar_agendamento.php"); break;
                    case 'concluir_agendamento': include("paginas/eventos/concluir_agendamento.php"); break;
                    case 'deletar_agendamento': include("paginas/eventos/deletar_agendamento.php"); break;
                    case 'deletar_financeiro': include("paginas/home/financeiro/deletar_financeiro.php"); break;
                    
                    default: include("paginas/home/home.php"); break;
                }
 ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>