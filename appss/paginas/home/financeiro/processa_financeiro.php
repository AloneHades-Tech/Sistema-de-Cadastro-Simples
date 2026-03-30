<?php
session_start();
include_once('../../../../core/config.php'); 

if(isset($_POST['submit'])) {
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $data_manual = $_POST['data_lancamento']; // Captura a data escolhida

    // Agora incluímos a data no INSERT
    $query = "INSERT INTO financeiro (descricao, valor, tipo, data_lancamento) 
              VALUES ('$descricao', '$valor', '$tipo', '$data_manual')";

    if(mysqli_query($conexao, $query)) {
        header("Location: ../../../index.php?menuop=financeiro&status=sucesso");
    } else {
        echo "Erro ao gravar: " . mysqli_error($conexao);
    }
}
?>