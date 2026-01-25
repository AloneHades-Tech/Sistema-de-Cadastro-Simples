<?php


    session_start();
    include_once('config.php');
    // PROTEÇÃO: Verifica se há uma sessão ativa. Caso contrário, expulsa para a Home
    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: Home.php');  
    }
    $Logado = $_SESSION['email'];
    // TODO: No futuro, migrar para Prepared Statements para aumentar a segurança contra SQL Injection
    $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    $result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>SISTEMA | Gestão de Clientes</title>
<style>
   
    body {
        background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 78, 96));
        color: white;
        text-align: center;
    }

    .navbar {
        background-color: #063ae5;
    }

    /*CLASSE: .table-bg
       MOTIVO: Cria o efeito de transparência (Glassmorphism) sobre o fundo azul.
       NOTA: O !important é necessário para sobrescrever o background padrão do Bootstrap.*/ 

    .table-bg {
        background: rgba(0, 0, 0, 0.3) !important;
        border-radius: 15px 15px 0 0 !important;
        border-collapse: collapse; 
    }

    
    .table-bg > :not(caption) > * > * {
        border-width: 0;
        border-bottom-width: 1px !important; 
        border-style: solid !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        background-color: transparent !important;
    }

    
    .table-bg thead th {
        border-bottom-color: rgba(255, 255, 255, 0.5) !important;
        border-bottom-width: 2px !important;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema | Gestão de Clientes</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto"></ul>
                <div class="d-flex">
                    <a href="Sair.php" class="btn btn-danger me-5">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php echo "<h3>Bem-vindo, <u>$Logado</u> !</h3>"; ?>
    </div>

    <div class="m-5">
            
    
        <table class="table table-borderless table-bg">
             <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['senha']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['genero']."</td>";
                        echo "<td>".$user_data['data_nasc']."</td>";
                        echo "<td>".$user_data['cidade']."</td>";
                        echo "<td>".$user_data['estado']."</td>";
                        echo "<td>".$user_data['endereco']."</td>";
    
    
            // ACOES: Gera os botões de Editar e Excluir passando o ID via URL

                           echo "<td> <a class= 'btn btn-sm btn-primary' href ='Edit.php?id=$user_data[id] '>
                           
                           <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                            
                           <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                            </svg>

                            </a>

                           
                           <a class= 'btn btn-sm btn-danger' href ='Delete.php?id=$user_data[id] '>

                           <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                           <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                           </svg>

                           </a>
                           
                            </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>