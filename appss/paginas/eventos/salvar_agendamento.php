<?php
// paginas/eventos/salvar_agendamento.php
if(isset($_POST['submit'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome_cliente']);
    $tel  = mysqli_real_escape_string($conexao, $_POST['telefone_cliente']);
    $cod  = mysqli_real_escape_string($conexao, $_POST['servico_codigo']);
    $inicio = $_POST['data_hora_inicio'];

    $busca = $conexao->query("SELECT duracao_minutos FROM servicos WHERE codigo = '$cod'");
    $duracao = ($busca->num_rows > 0) ? $busca->fetch_assoc()['duracao_minutos'] : 30;
    $fim = date('Y-m-d H:i:s', strtotime("+$duracao minutes", strtotime($inicio)));

    $sql = "INSERT INTO agendamentos (cliente_nome, cliente_contato, servico_codigo, data_hora_inicio, data_hora_fim) 
            VALUES ('$nome', '$tel', '$cod', '$inicio', '$fim')";

    if($conexao->query($sql)) {
        echo "<script>window.location.href='index.php?menuop=eventos&status=sucesso';</script>";
    } else {
        echo "Erro: " . $conexao->error;
    }
}
?>