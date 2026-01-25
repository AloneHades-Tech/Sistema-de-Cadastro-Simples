<?php   

//Ao clicar em sair na tela do sistema será redirecionado para a Home.
    
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header("Location: Home.php");
?>

