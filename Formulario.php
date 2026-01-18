<?php
if(isset($_POST['submit']))
{
    // print_r('Nome: ' . $_POST['nome']);
    // echo "<br>";
    // print_r('Email: ' . $_POST['email']);
    // echo "<br>";
    // print_r('Telefone: ' . $_POST['telefone']);
    // echo "<br>";
    // print_r('Gênero: ' . $_POST['genero']);
    // echo "<br>";
    // print_r('Data de Nascimento: ' . $_POST['data_nasc']);
    // echo "<br>";
    // print_r('Cidade: ' . $_POST['cidade']);
    // echo "<br>";
    // print_r('Estado: ' . $_POST['estado']);
    // echo "<br>";
    // print_r('Endereço: ' . $_POST['endereco']);
    //



    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero']; 
    $data_nasc = $_POST['data_nasc']; // Agora vai receber o valor do name="data_nasc"
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // Enviando para 'sexo' conforme sua estrutura do Workbench
    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, telefone, genero, data_nasc, cidade, estado, endereco) 
    VALUES ('$nome', '$email', '$telefone', '$genero', '$data_nasc', '$cidade', '$estado', '$endereco')");    
    
    if($result) {
        echo "Sucesso: Cliente cadastrado!";
    } else {
        echo "Erro técnico: " . mysqli_error($conexao);
    } }
    
?>
 



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Cliente</title>
    <style> 
        /* CLASSE: body 
           Define o estilo da página inteira. O linear-gradient cria o fundo azul degradê. */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            margin: 0;
            height: 100vh;
        }

        /* CLASSE: .box 
           Container principal. Usa position absolute + transform para ficar perfeitamente centralizado. */
        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8); /* Fundo preto com 80% de transparência */
            padding: 15px;
            border-radius: 15px;
            width: 25%;
        }

        /* TAG: fieldset 
           Cria a moldura azul ao redor dos campos. */
        fieldset {
            border: 2px solid dodgerblue;
            padding: 15px;
        }

        /* TAG: legend 
           Estiliza o título "Cadastro de Cliente" que fica sobre a linha do fieldset. */
        legend {
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 5px;
        }

        /* CLASSE: .inputBox 
           IMPORTANTE: Serve como 'âncora' (relative) para que o label (absolute) saiba onde se posicionar. */
        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        /* CLASSE: .inputUser 
           Estiliza os campos de texto. Remove bordas laterais e mantém apenas a linha de baixo. */
        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        /* CLASSE: .labelinput 
           O texto que descreve o campo. Começa posicionado exatamente em cima da linha do input. */
        .labelinput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none; /* Faz o clique do mouse ignorar o texto e focar no input atrás */
            transition: .5s; /* Suaviza a subida do texto */
        }

        /* ESTADO: .inputUser:focus e :valid 
           Seletor que faz o label subir quando o usuário clica ou quando o campo já tem texto. */
        .inputUser:focus ~ .labelinput, 
        .inputUser:valid ~ .labelinput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }

        /* ID: #data_nascimento 
           Estilo específico para o campo de data, garantindo que ele não quebre o layout. */
        #data_nasc {
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            background-color: transparent;
            color: white;
            font-family: Arial, sans-serif;
            border-bottom: 1px solid white;
            width: 100%;
            box-sizing: border-box;
        }

        /* PSEUDO-ELEMENTO: ::-webkit-calendar-picker-indicator 
           Inverte a cor do ícone do calendário para branco, para aparecer no fundo escuro. */
        #data_nasc::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        /* INTERATIVIDADE: cursor pointer 
           Muda o ícone do mouse para a 'mãozinha' ao passar em elementos clicáveis. */
        input[type="radio"], 
        label[for="feminino"], 
        label[for="masculino"], 
        label[for="outro"],
        #submit {
            cursor: pointer;
        }

        /* ID: #submit 
           Estiliza o botão de envio com um degradê e efeitos de hover. */
        #submit {
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }

        #submit:hover {
            background-image: linear-gradient(to right, rgb(2, 103, 161), rgb(4, 44, 62));
        }

    </style> 
</head>
<body>
    <div class="box">
        <form action="Formulario.php" method = "POST">
            <fieldset>
                <legend><b>Cadastro de Cliente</b></legend>
                <br>
                
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelinput">Nome Completo</label>
                </div>  
                <br>

                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelinput">Email</label>
                </div>
                <br>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelinput">Telefone</label>
                </div>

                <p>Sexo:</p>
                <input type="radio" name="genero" id="feminino" value="feminino" required>
                <label for="feminino">Feminino</label>
                <input type="radio" name="genero" id="masculino" value="masculino" required>
                <label for="masculino">Masculino</label>
                <input type="radio" name="genero" id="outro" value="outro" required>
                <label for="outro">Outro</label>
                <br><br>

                <label for="data_nasc"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nasc" id="data_nasc" required>
                <br><br>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelinput">Cidade</label>
                </div>
                <br>

                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelinput">Estado</label>
                </div>
                <br>

                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelinput">Endereço</label>
                </div>
                <br>
                
                <input type="submit" name="submit" id="submit" value="Enviar">

            </fieldset>
        </form>
    </div>
</body>
</html>