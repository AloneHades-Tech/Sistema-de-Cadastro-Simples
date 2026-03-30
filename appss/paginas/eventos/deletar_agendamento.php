<?php
// deletar_agendamento.php
include_once('../../../core/config.php');

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Comando para remover o registro do banco
    $sql = "DELETE FROM agendamentos WHERE id = '$id'";

    if($conexao->query($sql)) {
        // CORREÇÃO: Redireciona de volta para a AGENDA, não para o financeiro
        header("Location: index.php?menuop=eventos&status=excluido");
    } else {
        echo "Erro ao deletar: " . $conexao->error;
    }
}
?>