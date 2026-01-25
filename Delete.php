<?php
// IMPORTAÇÃO: Carrega a conexão com o banco de dados
include_once('config.php');

// VALIDAÇÃO INICIAL: Verifica se o ID foi enviado corretamente via URL
if(!empty($_GET['id'])) {
    
    $id = $_GET['id'];

    // VERIFICAÇÃO DE EXISTÊNCIA: Antes de deletar, confirmamos se o registro ainda existe no banco
    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conexao->query($sqlSelect);

    // Se o usuário for encontrado, prosseguimos com a exclusão
    if($result->num_rows > 0) {
        
        $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
        $resultDelete = $conexao->query($sqlDelete);
        
        // Dica de Debug: Em caso de erro na exclusão, use o comando abaixo para ver a falha do MySQL
        // $resultDelete = $conexao->query($sqlDelete) or die($conexao->error);
    }
}

// REDIRECIONAMENTO: Independente do resultado, volta para o painel principal
header('Location: Sistema.php');
?>