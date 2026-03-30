<?php
include_once('../../../../core/config.php');

$codigo = $_GET['codigo'];
// Busca o serviço pelo código fornecido
$sql = "SELECT nome_servico, preco FROM servicos WHERE codigo = '$codigo' LIMIT 1";
$result = $conexao->query($sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row); // Devolve o nome e o preço como um "pacote" JSON
} else {
    echo json_encode(['erro' => 'Não encontrado']);
}
?>