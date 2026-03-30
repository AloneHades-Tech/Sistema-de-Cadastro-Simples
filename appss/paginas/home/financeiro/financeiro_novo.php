<?php
// 1. FILTRAGEM E CONSULTA
$data_inicio = isset($_GET['inicio']) ? $_GET['inicio'] : date('Y-m-01');
$data_fim = isset($_GET['fim']) ? $_GET['fim'] : date('Y-m-t');

$sql = "SELECT * FROM financeiro WHERE DATE(data_lancamento) BETWEEN '$data_inicio' AND '$data_fim' ORDER BY data_lancamento DESC";
$result = $conexao->query($sql);

// 2. CÁLCULO DO BALANÇO
$total_entrada = $conexao->query("SELECT SUM(valor) as total FROM financeiro WHERE tipo='entrada' AND DATE(data_lancamento) BETWEEN '$data_inicio' AND '$data_fim'")->fetch_assoc()['total'] ?? 0;
$total_saida = $conexao->query("SELECT SUM(valor) as total FROM financeiro WHERE tipo='saida' AND DATE(data_lancamento) BETWEEN '$data_inicio' AND '$data_fim'")->fetch_assoc()['total'] ?? 0;
$saldo = $total_entrada - $total_saida;
?>

<div class="mb-4">
    <h3 class="fw-bold">💰 Extrato Financeiro</h3>
    <p class="opacity-50">Confira e filtre todas as movimentações do período.</p>
</div>

<div class="glass-panel mb-4 p-3">
    <form method="GET" class="row g-2 align-items-end">
        <input type="hidden" name="menuop" value="financeiro">
        <div class="col-md-4">
            <label class="small opacity-50 fw-bold">Início</label>
            <input type="date" name="inicio" class="form-control bg-dark text-white border-secondary" value="<?php echo $data_inicio; ?>">
        </div>
        <div class="col-md-4">
            <label class="small opacity-50 fw-bold">Fim</label>
            <input type="date" name="fim" class="form-control bg-dark text-white border-secondary" value="<?php echo $data_fim; ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-info w-100 fw-bold">🔍 Filtrar Relatório</button>
        </div>
    </form>
</div>

<div class="row mb-4">
    <div class="col-md-4"><div class="glass-panel p-3 text-center border-start border-success border-4">Ganhos: <h4 class="text-success">R$ <?php echo number_format($total_entrada, 2, ',', '.'); ?></h4></div></div>
    <div class="col-md-4"><div class="glass-panel p-3 text-center border-start border-danger border-4">Despesas: <h4 class="text-danger">R$ <?php echo number_format($total_saida, 2, ',', '.'); ?></h4></div></div>
    <div class="col-md-4"><div class="glass-panel p-3 text-center border-start border-info border-4">Lucro Real: <h4>R$ <?php echo number_format($saldo, 2, ',', '.'); ?></h4></div></div>
</div>

<div class="px-3 mb-2 d-none d-md-flex opacity-50 small fw-bold text-uppercase">
    <div style="width: 100px;" class="me-3 text-center">Data</div>
    <div class="flex-grow-1">Descrição / Origem</div>
    <div class="text-end" style="width: 150px; padding-right: 40px;">Valor</div>
    <div class="text-center" style="width: 100px;">Ações</div>
</div>

<div id="listaFinanceira">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="servico-item glass-panel mb-3 p-3 d-flex align-items-center justify-content-between" style="background: rgba(255, 255, 255, 0.05) !important;">
        <div class="d-flex align-items-center flex-grow-1">
            <div class="me-3 text-center" style="width: 100px;">
                <span class="badge bg-secondary p-2 w-100"><?php echo date('d/m/Y', strtotime($row['data_lancamento'])); ?></span>
            </div>
            <div>
                <h5 class="mb-0 fw-bold"><?php echo $row['descricao']; ?></h5>
                <span class="badge <?php echo $row['tipo'] == 'entrada' ? 'bg-success' : 'bg-danger'; ?> mt-1" style="font-size: 0.7rem;">
                    <?php echo $row['tipo'] == 'entrada' ? '🟢 Ganho' : '🔴 Despesa'; ?>
                </span>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="text-end" style="width: 150px; padding-right: 40px;">
                <h4 class="mb-0 fw-bold <?php echo $row['tipo'] == 'entrada' ? 'text-success' : 'text-danger'; ?>">
                    <?php echo ($row['tipo'] == 'entrada' ? '+' : '-'); ?> R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?>
                </h4>
            </div>
            <div class="d-flex gap-2 justify-content-center" style="width: 100px;">
                <a href="index.php?menuop=deletar_financeiro&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0 p-2" onclick="return confirm('Apagar?')">🗑️</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>