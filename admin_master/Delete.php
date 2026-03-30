<?php
// 1. SEGURANÇA: Inicia a sessão e valida se é o ADMIN
session_start();

if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../Tela_Login.php");
    exit();
}

// 2. CONEXÃO: Sobe um nível para achar a pasta core
include_once('../core/config.php');

// 3. LÓGICA DE EXCLUSÃO
if(!empty($_GET['id'])) {
    
    $id = $_GET['id'];

    // Confirmamos se o registro existe
    $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0) {
        // Deleta o usuário do banco de dados
        $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
        $resultDelete = $conexao->query($sqlDelete);
    }
}

// 4. REDIRECIONAMENTO: Volta para a tabela azul
header('Location: Sistema.php');
exit();
?>