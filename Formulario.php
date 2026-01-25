<?php
// GATILHO: Verifica se o formulário foi enviado via botão 'submit'
if(isset($_POST['submit']))
{
    // CONEXÃO: Importa as credenciais do banco de dados
    include_once('config.php');

    // CAPTURA: Transfere os dados do formulário para variáveis locais
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero']; 
    $data_nasc = $_POST['data_nasc']; 
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // PERSISTÊNCIA: Executa o comando SQL para inserir o novo cliente
    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha, telefone, genero, data_nasc, cidade, estado, endereco) 
    VALUES ('$nome', '$email', '$senha', '$telefone', '$genero', '$data_nasc', '$cidade', '$estado', '$endereco')"); 
    
    // FEEDBACK: Se a gravação for bem-sucedida, exibe alerta e redireciona
    if($result) {
        echo "<div class='container text-center mt-5'>";
        echo "    <div class='alert alert-success d-inline-block' role='alert'>";
        echo "        <strong>Sucesso:</strong> Cliente cadastrado com sucesso!";
        echo "    </div>";
        echo "</div>";

        // TIME-OUT: Aguarda 3 segundos para o usuário ler a mensagem antes de ir para o login
        header("refresh:3;url=Tela_Login.php");
    } else {
        // TRATAMENTO DE ERRO: Exibe o erro técnico caso a query falhe
        echo "<div class='alert alert-danger text-center mt-5'>Erro técnico: " . mysqli_error($conexao) . "</div>";
    }
}
?>