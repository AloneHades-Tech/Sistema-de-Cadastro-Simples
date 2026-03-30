<?php
include_once('../../../core/config.php');

$id = mysqli_real_escape_string($conexao, $_GET['id']);

// Deleta o serviço baseado no ID que veio pela URL
$sql = "DELETE FROM servicos WHERE id = '$id'";

if($conexao->query($sql)) {
    header("Location: index.php?menuop=servicos&status=excluido");
} else {
    echo "Erro ao excluir: " . $conexao->error;
}
?>