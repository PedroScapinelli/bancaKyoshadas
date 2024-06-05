<?php
session_start();
if (isset($_SESSION["logado"]) || $_SESSION["logado"] == 's') {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<center>
    <form action="cadastro.php" method="post">
        <p><input type="text" placeholder="nome" name="nome" required></p>
        <p><input type="text" placeholder="email" name="email" required></p>
        <p><input type="password" placeholder="senha" name="senha" required></p>
        <p><input type="text" placeholder="endereço" name="endereco" required></p>        
        <p><input type="text" placeholder="nº celular" name="fone" required></p>        
        <p><input type="submit" value="cadastrar"></p>
    </form>

    <?php 
        if(isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome']) && isset($_POST['endereco']) && isset($_POST['fone'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $fone = $_POST['fone'];
            $endereco = $_POST['endereco'];

            $conn = mysqli_connect("localhost", "root", "", "kyiosh");

            function validarEmail($email){
                $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                return preg_match($pattern, $email);
            }

            $verificarEmailBD = mysqli_query($conn, "SELECT * FROM `tbclientes` WHERE `emailCli` = '$email'");

            if($linha = mysqli_fetch_array($verificarEmailBD)){
                mysqli_close($conn);
                echo "<script>alert('Email já cadastrado');</script>";
            }
            else if(validarEmail($email) != true){
                echo "<script>alert('Email inválido');</script>";
            } 
            else {
                $sql =  "INSERT INTO `tbclientes` (`idCliente`, `nomeCli`, `emailCli`, `senhaCli`, `endereco`,`foneCli`) VALUES (NULL, '$nome', '$email', '$senha','$endereco', '$fone');";

                $resultado = mysqli_query($conn, $sql);

                if(!$resultado){
                    die('Query Inválida: ' . @mysqli_error($conn));
                }else {
                            mysqli_close($conn);
                    header("Location: login.php");
                }
            }
        }
    ?>
    
</body>
</html>