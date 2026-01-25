<?php
// INÍCIO DA SESSÃO: Permite que o PHP armazene informações entre diferentes páginas
session_start();

// VALIDAÇÃO DE ENTRADA: Verifica se o botão 'submit' foi clicado e se os campos não estão vazios
if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) 
{
    // CONEXÃO: Inclui as configurações do banco de dados
    include_once('config.php');
    
    // CAPTURA: Atribui os valores digitados no formulário às variáveis
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // CONSULTA: Verifica no banco de dados se existe um usuário com este e-mail e senha
    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $result = $conexao->query($sql);

    // VERIFICAÇÃO DE RESULTADO: Se não houver correspondência no banco de dados
    if(mysqli_num_rows($result) < 1) 
    {       
        // Limpa as variáveis de sessão por segurança e retorna ao login
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: Tela_Login.php');
    } 
    else 
    {   
        // CRIAÇÃO DE SESSÃO: Armazena os dados do usuário logado para acesso às áreas restritas
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: Sistema.php');         
    }    
} 
else 
{
    // Caso o acesso seja direto (sem post), redireciona para a tela de login
    header('Location: Tela_Login.php');
}
?>