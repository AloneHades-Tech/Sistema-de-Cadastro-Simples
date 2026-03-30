<?php
session_start();

// 1. SEGURANÇA: Se chegou aqui, já sabemos que é Admin
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../Tela_Login.php");
    exit();
}

include_once('../core/config.php');

$Logado = $_SESSION['email']; 

// 2. FILTRO: Busca os clientes
$sql = "SELECT * FROM usuarios WHERE nivel_acesso != 'admin' ORDER BY id DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SISTEMA | Gestão de Clientes</title>
    <style>
        /* CSS ORIGINAL DA FOTO */
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 78, 96));
            color: white;
            text-align: center;
        }
        .navbar { background-color: #063ae5; }
        .table-bg {
            background: rgba(0, 0, 0, 0.3) !important;
            border-radius: 15px !important;
            border-collapse: separate;
            overflow: hidden;
        }
        .table-bg td, .table-bg th {
            background-color: transparent !important;
            color: white !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema | Gestão de Clientes</a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-info me-2">Início</a>
                
                <a href="Formulario.php" class="btn btn-success me-2">Novo Cliente</a>
                <a href="../Sair.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Bem-vindo, <u><?php echo $Logado; ?></u> !</h3>
    </div>

    <div class="m-5">
        <table class="table table-borderless table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Cidade/UF</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // LOOP CORRIGIDO E LIMPO
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['cidade']."/".$user_data['estado']."</td>";
                        
                        echo "<td>";
                            echo "<a class='btn btn-sm btn-info me-1' href='../appss/index.php?cliente=".$user_data['id']."' title='Acessar Sistema'>Acessar</a>";
                            
                            echo "<a class='btn btn-sm btn-primary me-1' href='Edit.php?id=".$user_data['id']."' title='Editar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/></svg>
                                  </a>";

                            echo "<a class='btn btn-sm btn-danger' href='Delete.php?id=".$user_data['id']."' title='Excluir'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'><path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/></svg>
                                  </a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>