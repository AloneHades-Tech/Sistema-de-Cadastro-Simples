<?php
    // 1. Conecta ao banco (Saindo da pasta admin_master)
    include_once('../core/config.php');

    if(isset($_POST['update']))
    {
        // 2. Captura os dados do formulário
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

        // 3. Executa a atualização no SQL
        $sqlUpdate = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha', telefone='$telefone', genero='$genero', data_nasc='$data_nasc', cidade='$cidade', estado='$estado', endereco='$endereco' WHERE id='$id'";

        $result = $conexao->query($sqlUpdate);
    }
    // 4. Redireciona de volta para a tabela de gestão
    header('Location: Sistema.php');
?>