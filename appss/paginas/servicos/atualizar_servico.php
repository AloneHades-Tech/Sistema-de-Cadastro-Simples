<?php
session_start();
include_once('../../../core/config.php');

if(isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $preco = $_POST['preco'];
    $duracao = $_POST['duracao'];

    // Comando SQL para atualizar os dados
    $sql = "UPDATE servicos SET 
            codigo = '$codigo', 
            nome_servico = '$nome', 
            preco = '$preco', 
            duracao_minutos = '$duracao' 
            WHERE id = '$id'";

    if($conexao->query($sql)) {
        header("Location: index.php?menuop=servicos&status=atualizado");

    } else {
        echo "Erro ao atualizar: " . $conexao->error;
    }
}
?>