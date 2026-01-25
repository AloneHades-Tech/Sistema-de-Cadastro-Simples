<?php
    // ESSENCIAL: Sem isso, o $conexao não funciona neste arquivo
    include_once('config.php');

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $genero = $_POST['genero']; 
        $data_nasc = $_POST['data_nasc']; 
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        $sqlUpdate = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', telefone='$telefone', genero='$genero', data_nasc='$data_nasc', cidade='$cidade', estado='$estado', endereco='$endereco' WHERE id=$id";
        
        // Agora o $conexao estará definido e a query vai rodar
        $result = $conexao->query($sqlUpdate);
    }
    header('Location: Sistema.php');
?>