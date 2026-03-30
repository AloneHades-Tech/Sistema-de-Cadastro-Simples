<?php
// deletar_financeiro.php
include_once('../../../../core/config.php');

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Comando SQL para apagar o lançamento específico
    $sql = "DELETE FROM financeiro WHERE id = '$id'";

    if($conexao->query($sql)) {
        // Redireciona de volta com a mensagem de sucesso que configuramos no index
        header("Location: index.php?menuop=financeiro&status=excluido");
    } else {
        echo "Erro ao excluir lançamento: " . $conexao->error;
    }
}
?>