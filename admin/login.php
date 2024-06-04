<?php
session_start();
if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 's') {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<center>
    <h1>Login adm</h1>
    <form action="login.php" method="post">
        <p><input type="text" placeholder="email" name="email" required></p>
        <p><input type="password" placeholder="senha" name="senha" required></p>
        <p><input type="submit" value="login"></p>
    </form>

    <?php 
        if(isset($_POST['email']) && isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $conn = mysqli_connect("localhost", "root", "", "kyiosh");
            $sql = "SELECT * FROM `tbfuncinarios` WHERE `emailFunc` = '$email' AND `senhaFunc` = '$senha'";

            $resultado = mysqli_query($conn, $sql);

            if ($linha = mysqli_fetch_array($resultado)) {
				$_SESSION["idFunc"] = $linha["idFunc"];				
				$_SESSION["logado"] = 's';
				$_SESSION["nomeFunc"] = $linha["nomeFunc"];
				$_SESSION["funcao"] = $linha["funcao"];

                mysqli_close($conn);
			    header("Location: index.php");
		}else { ?>
                <h3>Email e/ou senha inválidos ou você não possui cadastro.</h3>
       <?php 
            }
        }
    ?>
</center>
</body>
</html>