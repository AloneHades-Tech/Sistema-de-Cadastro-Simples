<?php
session_start();
include_once('config.php');

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) 
{
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        $_SESSION['email'] = $email;
        $_SESSION['id_usuario'] = $user_data['id']; 
        // CORREÇÃO: Pegamos o nome exato da coluna do seu banco
        $_SESSION['nivel'] = $user_data['nivel_acesso']; 
        
        header('Location: ../dashboard.php');
        exit();
    } else {
        header('Location: ../Tela_Login.php?erro=login-invalido');
        exit();
    }
}
?>