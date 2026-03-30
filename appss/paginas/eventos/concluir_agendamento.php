<?php
// paginas/eventos/concluir_agendamento.php
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);
    
    // Busca os dados para o financeiro
    $query = "SELECT a.cliente_nome, s.nome_servico, s.preco 
              FROM agendamentos a 
              INNER JOIN servicos s ON a.servico_codigo = s.codigo 
              WHERE a.id = '$id'";
    $res = $conexao->query($query);
    
    if($res && $res->num_rows > 0) {
        $dados = $res->fetch_assoc();
        $desc = "Serviço: " . $dados['nome_servico'] . " - " . $dados['cliente_nome'];
        $valor = $dados['preco'];

        // 1. Atualiza Status na Agenda
        $conexao->query("UPDATE agendamentos SET status = 'concluido' WHERE id = '$id'");
        
        // 2. Lança no Financeiro
        $conexao->query("INSERT INTO financeiro (descricao, valor, tipo, data_lancamento) 
                         VALUES ('$desc', '$valor', 'entrada', NOW())");
        
        // REDIRECIONAMENTO CORRETO: Sem os "../"
        echo "<script>window.location.href='index.php?menuop=eventos&status=sucesso';</script>";
    }
}
?>