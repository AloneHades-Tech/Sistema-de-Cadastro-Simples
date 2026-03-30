<?php
// 1. Inicia a sessão para validar quem está tentando cadastrar
session_start();

// 2. SEGURANÇA: Apenas o Admin pode usar este formulário
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../Tela_Login.php");
    exit();
}

if(isset($_POST['submit']))
{
    // 3. CAMINHO: Sobe um nível para achar a pasta core
    include_once('../core/config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero']; 
    $data_nasc = $_POST['data_nasc']; 
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // 4. SQL: Inserimos o cliente já com o nível de acesso definido
    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha, telefone, genero, data_nasc, cidade, estado, endereco, nivel_acesso) 
    VALUES ('$nome', '$email', '$senha', '$telefone', '$genero', '$data_nasc', '$cidade', '$estado', '$endereco', 'cliente')"); 
    
    if($result) {
        echo "<div style='color: white; text-align: center; margin-top: 20px;'><strong>Sucesso:</strong> Cliente cadastrado!</div>";
        // Redireciona para a tabela de gestão após 2 segundos
        header("refresh:2;url=Sistema.php");
    } else {
        echo "Erro técnico: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Cliente</title>
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            color: white;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            width: 350px;
        }
        fieldset { border: 2px solid dodgerblue; padding: 15px; }
        legend { 
            padding: 8px; 
            text-align: center; 
            background-color: dodgerblue; 
            border-radius: 8px; 
        }
        .inputBox { position: relative; margin-top: 15px; }
        .inputUser {
            background: none; border: none; border-bottom: 1px solid white;
            outline: none; color: white; width: 100%;
        }
        #submit {
            background-color: dodgerblue; width: 100%; border: none;
            padding: 10px; color: white; cursor: pointer; border-radius: 8px;
            margin-top: 15px;
        }
        .voltar { color: white; text-decoration: none; position: absolute; top: 20px; left: 20px; }
    </style> 
</head>
<body>
    <a href="Sistema.php" class="voltar">← Voltar para Gestão</a>
    <div class="box">
        <form action="Formulario.php" method="POST">
            <fieldset>
                <legend><b>Novo Cliente</b></legend>
                <div class="inputBox">
                    <input type="text" name="nome" class="inputUser" required>
                    <label>Nome Completo</label>
                </div>
                <div class="inputBox">
                    <input type="email" name="email" class="inputUser" required>
                    <label>Email</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" class="inputUser" required>
                    <label>Senha</label>
                </div>
                <div class="inputBox">
                    <input type="tel" name="telefone" class="inputUser" required>
                    <label>Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" name="genero" value="feminino" required> Feminino
                <input type="radio" name="genero" value="masculino" required> Masculino
                <br><br>
                <label>Data de Nascimento:</label>
                <input type="date" name="data_nasc" style="width: 100%;" required>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar Cliente">
            </fieldset>
        </form>
    </div>
</body>
</html>