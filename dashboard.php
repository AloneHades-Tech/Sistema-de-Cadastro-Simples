<?php
session_start();
include_once('core/config.php');

// Proteção: Só entra se estiver logado
if (!isset($_SESSION['email'])) { 
    header("Location: Tela_Login.php"); 
    exit(); 
}

// O nível vem do banco como 'nivel_acesso', mas salvamos na sessão como 'nivel'
$nivel = $_SESSION['nivel']; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGCF | Seletor de Aplicativos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71)); 
            color: white; 
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card-app { 
            background: rgba(0, 0, 0, 0.4); 
            border: 2px solid rgba(255, 255, 255, 0.2); 
            border-radius: 20px; 
            padding: 40px 20px; 
            transition: 0.4s; 
            text-decoration: none; 
            color: white; 
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }
        .card-app:hover { 
            transform: translateY(-10px); 
            background: rgba(30, 144, 255, 0.3); 
            border-color: dodgerblue;
            color: white;
        }
        .master-card { border-color: gold; }
        .master-card:hover { border-color: #ffd700; background: rgba(255, 215, 0, 0.1); }
        .icon-lg { font-size: 3rem; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container text-center">
    <div class="mb-5">
        <h1 class="display-4 fw-bold">Bem-vindo, <?php echo $_SESSION['email']; ?></h1>
        <p class="lead">Escolha o sistema que deseja acessar:</p>
    </div>

    <div class="row justify-content-center g-4">
        
        <?php if ($nivel == 'admin'): ?>
        <div class="col-12 col-md-4 col-lg-3">
            <a href="admin_master/Sistema.php" class="card-app master-card">
                <div class="icon-lg">👑</div>
                <h4 class="fw-bold">Gestão Master</h4>
                <p class="small opacity-75">Controle de Clientes e Sistemas</p>
            </a>
        </div>
        <?php endif; ?>

        <div class="col-12 col-md-4 col-lg-3">
            <a href="appss/index.php" class="card-app">
                <div class="icon-lg">✂️</div>
                <h4 class="fw-bold">BarberApp</h4> 
                <p class="small opacity-75">Sistema de Gestão</p>
            </a>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <div class="card-app opacity-50" style="cursor: not-allowed;">
                <div class="icon-lg">🚚</div>
                <h4 class="fw-bold">Logística</h4>
                <p class="small opacity-75">Módulo em desenvolvimento</p>
            </div>
        </div>

    </div>

    <div class="mt-5">
        <a href="Sair.php" class="btn btn-outline-light px-4 py-2">Sair do Sistema</a>
    </div>
</div>

</body>
</html>