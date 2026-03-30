<?php
session_start();
include_once('../../../core/config.php');

if(isset($_POST['submit'])) {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']); // Novo campo
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $preco = $_POST['preco'];
    $duracao = $_POST['duracao'];

    $sql = "INSERT INTO servicos (codigo, nome_servico, preco, duracao_minutos) 
            VALUES ('$codigo', '$nome', '$preco', '$duracao')";
            
    // DEBUG: Se falhar, ele vai parar a página e mostrar o erro do MySQL
    if($conexao->query($sql)) {
        header("Location: ../../index.php?menuop=servicos&status=sucesso");
    } else {
        // Isso aqui vai te dizer exatamente qual coluna está errada
        die("Erro no Banco de Dados: " . mysqli_error($conexao));
    }
} else {
    die("O formulário não enviou o botão 'submit'. Verifique o name do botão.");
}
?>