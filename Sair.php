<?php
session_start();

// 1. CAPTURA: Guardamos o nível antes de apagar a memória
$nivel_saida = $_SESSION['nivel'];

// 2. LIMPEZA TOTAL
session_unset();
session_destroy();

// 3. ROTEAMENTO DE SAÍDA
if ($nivel_saida == 'admin') {
    header("Location: Tela_Login.php"); // Caminho direto, são vizinhos.
} 
else {
    // Cliente/Barbearia volta para o início de tudo
    header("Location: Tela_Login.php");
}
exit();
?>