<?php
// 1. LÓGICA DE DATA
// Captura a data selecionada ou define como hoje por padrão
$data_view = isset($_GET['data_custom']) ? $_GET['data_custom'] : date('Y-m-d');

// 2. BUSCA NO BANCO DE DADOS
// Busca apenas os agendamentos do dia selecionado que não foram cancelados
$sql = "SELECT a.*, s.nome_servico 
        FROM agendamentos a 
        LEFT JOIN servicos s ON a.servico_codigo = s.codigo 
        WHERE DATE(a.data_hora_inicio) = '$data_view' 
        AND a.status != 'cancelado' 
        ORDER BY a.data_hora_inicio ASC";
$result = $conexao->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📅 Agenda de Clientes</h3>
    <button class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNovoAgendamento">
        + Novo Horário
    </button>
</div>

<div class="glass-panel mb-4 p-2">
    <form method="GET" action="index.php" class="d-flex gap-2">
        <input type="hidden" name="menuop" value="eventos">
        <input type="date" name="data_custom" class="form-control bg-dark text-white border-secondary" value="<?php echo $data_view; ?>">
        <button type="submit" class="btn btn-info px-4 fw-bold">Ver Dia</button>
    </form>
</div>

<div id="listaAgendamentos">
    <?php if($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="servico-item glass-panel mb-3 p-3 d-flex align-items-center justify-content-between border-start border-info border-4">
            <div class="d-flex align-items-center flex-grow-1">
                <div class="me-4 text-center" style="min-width: 80px;">
                    <h4 class="mb-0 fw-bold"><?php echo date('H:i', strtotime($row['data_hora_inicio'])); ?></h4>
                    <small class="opacity-50">Início</small>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold"><?php echo $row['cliente_nome']; ?></h5>
                    <span class="badge bg-info mt-1"><?php echo $row['nome_servico'] ?? 'Serviço'; ?></span>
                    <small class="d-block mt-1 opacity-50">📞 <?php echo $row['cliente_contato']; ?></small>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <a href="index.php?menuop=concluir_agendamento&id=<?php echo $row['id']; ?>" 
                   class="btn btn-sm btn-success px-3">✔️</a>
                
                <a href="index.php?menuop=deletar_agendamento&id=<?php echo $row['id']; ?>" 
                   class="btn btn-sm btn-outline-danger border-0" 
                   onclick="return confirm('⚠️ Você realmente deseja excluir o agendamento de <?php echo $row['cliente_nome']; ?>?')">
                   🗑️
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="text-center py-5 opacity-25">
            <span style="font-size: 3rem;">📬</span>
            <p>Nenhum agendamento para este dia.</p>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="modalNovoAgendamento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-primary shadow-lg">
            <div class="modal-header border-primary">
                <h5 class="modal-title">📅 Novo Horário</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?menuop=salvar_agendamento" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Cliente</label>
                        <input type="text" name="nome_cliente" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label>WhatsApp</label>
                        <input type="text" name="telefone_cliente" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Cód. Serviço</label>
                            <input type="text" name="servico_codigo" class="form-control bg-dark text-white border-info" required>
                        </div>
                        <div class="col-6">
                            <label>Data/Hora</label>
                            <input type="datetime-local" name="data_hora_inicio" class="form-control bg-dark text-white border-info" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-primary">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Agendar Agora</button>
                </div>
            </form>
        </div>
    </div>
</div>