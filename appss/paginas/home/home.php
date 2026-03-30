<div class="mb-4">
    <div class="d-flex align-items-center mb-3">
        <span style="font-size: 1.5rem;" class="me-2">📊</span>
        <h4 class="mb-0 fw-bold">Visão Geral</h4>
    </div>
    <p class="opacity-75">Bem-vindo ao painel de controle da sua barbearia, <strong><?php echo explode('@', $_SESSION['email'])[0]; ?></strong>.</p>
</div>

<hr class="opacity-25 mb-4">

<h5 class="mb-3 opacity-75">⚡ Ações Rápidas</h5>
<div class="row g-3">
    <div class="col-md-4">
        <a href="index.php?menuop=servicos" class="btn btn-seletor w-100 p-4 text-center d-flex flex-column align-items-center h-100">
            <span style="font-size: 2rem;">✂️</span>
            <span class="mt-2 fw-bold">Configurar Serviços</span>
            <small class="opacity-50">Preços e durações</small>
        </a>
    </div>

    <div class="col-md-4">
        <div class="glass-panel text-center p-4 h-100 border-start border-success border-4" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalLancamento">
            <span style="font-size: 2rem;">💰</span>
            <h5 class="mt-2 fw-bold text-success">Adicionar Ganho</h5>
            <small class="opacity-50">Receita de serviço</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="glass-panel text-center p-4 h-100 border-start border-danger border-4" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalDespesa">
            <span style="font-size: 2rem;">💸</span>
            <h5 class="mt-2 fw-bold text-danger">Adicionar Despesa</h5>
            <small class="opacity-50">Gastos e materiais</small>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLancamento" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content bg-dark text-white border-secondary shadow-lg">
        <div class="modal-header border-secondary">
            <h5 class="modal-title">🚀 Registrar Ganho</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="paginas/home/financeiro/processa_financeiro.php" method="POST">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Data</label>
                    <input type="date" name="data_lancamento" class="form-control bg-dark text-white border-info" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Código do Serviço (Busca Rápida)</label>
                    <input type="text" id="codigo_busca" class="form-control bg-dark text-white border-info" onblur="buscarDadosHome()">
                </div>
                <div class="mb-3">
                    <label>Descrição</label>
                    <input type="text" name="descricao" id="home_fin_desc" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <div class="mb-3">
                    <label>Valor R$</label>
                    <input type="number" step="0.01" name="valor" id="home_fin_valor" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <input type="hidden" name="tipo" value="entrada">
            </div>
            <div class="modal-footer border-secondary">
                <button type="submit" name="submit" class="btn btn-success w-100">Confirmar Ganho</button>
            </div>
        </form>
    </div></div>
</div>

<div class="modal fade" id="modalDespesa" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content bg-dark text-white border-danger shadow-lg">
        <div class="modal-header border-danger">
            <h5 class="modal-title text-danger">💸 Registrar Despesa</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="paginas/home/financeiro/processa_financeiro.php" method="POST">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Data do Gasto</label>
                    <input type="date" name="data_lancamento" class="form-control bg-dark text-white border-danger" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label>Descrição da Despesa</label>
                    <input type="text" name="descricao" class="form-control bg-dark text-white border-secondary" placeholder="Ex: Aluguel, Pomadas..." required>
                </div>
                <div class="mb-3">
                    <label>Valor Pago R$</label>
                    <input type="number" step="0.01" name="valor" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <input type="hidden" name="tipo" value="saida">
            </div>
            <div class="modal-footer border-danger">
                <button type="submit" name="submit" class="btn btn-danger w-100">Confirmar Saída</button>
            </div>
        </form>
    </div></div>
</div>

<script>
function buscarDadosHome() {
    let cod = document.getElementById('codigo_busca').value;
    if(cod == "") return;
    fetch('paginas/home/financeiro/buscar_servico.php?codigo=' + cod)
        .then(response => response.json())
        .then(data => {
            if(data.nome_servico) {
                document.getElementById('home_fin_desc').value = data.nome_servico;
                document.getElementById('home_fin_valor').value = data.preco;
            }
        });
}
</script>