<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: ../Tela_Login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Lançamento | SGCF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h4 class="card-title mb-4">Registrar Movimentação</h4>
                
                <form action="processa_financeiro.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Ex: Corte de Cabelo - Cliente X" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Valor (R$)</label>
                        <input type="number" step="0.01" name="valor" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de Movimentação</label>
                        <select name="tipo" class="form-select" required>
                            <option value="entrada">Entrada (Ganho)</option>
                            <option value="saida">Saída (Gasto)</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success w-100">Salvar Lançamento</button>
                    <a href="index.php" class="btn btn-link w-100 mt-2 text-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>