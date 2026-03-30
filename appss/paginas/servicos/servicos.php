<?php
    
    $sql = "SELECT * FROM servicos ORDER BY nome_servico ASC";
    $result = $conexao->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
        <span style="font-size: 1.8rem;" class="me-2">✂️</span>
        <h3 class="fw-bold mb-0">Meus Serviços</h3>
    </div>
    <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#modalNovoServico">
        + Adicionar Novo
    </button>
</div>

<div class="mb-4">
    <div class="input-group glass-panel p-1" style="border-radius: 12px; background: rgba(0,0,0,0.15) !important;">
        <span class="input-group-text bg-transparent border-0 text-white opacity-50">🔍</span>
        <input type="text" id="inputBusca" class="form-control bg-transparent border-0 text-white" 
               placeholder="Consultar serviço, código ou valor..." onkeyup="filtrarServicos()">
    </div>
</div>

<div id="containerServicos">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="servico-item glass-panel mb-3 p-3 d-flex align-items-center justify-content-between" 
         style="background: rgba(255, 255, 255, 0.05) !important; border: 1px solid rgba(255, 255, 255, 0.1);">
        
        <div class="d-flex align-items-center">
            <div class="me-3 text-center" style="min-width: 50px;">
                <span class="badge bg-info text-dark fw-bold p-2" style="border-radius: 8px;">#<?php echo $row['codigo']; ?></span>
            </div>
            
            <div>
                <h5 class="mb-0 fw-bold"><?php echo $row['nome_servico']; ?></h5>
                <small class="opacity-50">⏱️ Duração: <?php echo $row['duracao_minutos']; ?> min</small>
            </div>
        </div>

        <div class="d-flex align-items-center text-end">
            <div class="me-4">
                <h4 class="mb-0 fw-bold text-success">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></h4>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-info border-0 p-2" 
                        onclick="preencherEdicao('<?php echo $row['id']; ?>', '<?php echo $row['codigo']; ?>', '<?php echo $row['nome_servico']; ?>', '<?php echo $row['preco']; ?>', '<?php echo $row['duracao_minutos']; ?>')"
                        data-bs-toggle="modal" data-bs-target="#modalEditarServico">
                    ✏️
                </button>
                <a href="index.php?menuop=deletar_servico&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0 p-2">
                    🗑️
                </a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<div class="modal fade" id="modalNovoServico" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Cadastrar Novo Serviço</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="paginas/servicos/salvar_servico.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-info">Código (Ex: 101)</label>
                        <input type="text" name="codigo" class="form-control bg-dark text-white border-info" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nome do Serviço</label>
                        <input type="text" name="nome" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duração (minutos)</label>
                            <input type="number" name="duracao" class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Salvar no BarberApp</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditarServico" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">✏️ Editar Serviço</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="paginas/servicos/atualizar_servico.php" method="POST">
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-info">Código do Serviço</label>
                        <input type="text" name="codigo" id="edit_codigo" class="form-control bg-dark text-white border-info" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nome do Serviço</label>
                        <input type="text" name="nome" id="edit_nome" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" id="edit_preco" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duração (minutos)</label>
                            <input type="number" name="duracao" id="edit_duracao" class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="submit" name="update" class="btn btn-info w-100">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function preencherEdicao(id, codigo, nome, preco, duracao) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_codigo').value = codigo;
        document.getElementById('edit_nome').value = nome;
        document.getElementById('edit_preco').value = preco;
        document.getElementById('edit_duracao').value = duracao;
    }
    function filtrarTabela() {
    let input = document.getElementById("inputBusca").value.toLowerCase();
    let rows = document.querySelector("table tbody").rows;
    
    for (let i = 0; i < rows.length; i++) {
        let text = rows[i].innerText.toLowerCase();
        rows[i].style.display = text.includes(input) ? "" : "none";
    }
}
</script>