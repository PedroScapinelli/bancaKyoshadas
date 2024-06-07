<?php
session_start();
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 'n') {
    header("Location: admin/login.php");
} ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <form action="relatorioVendas.php" method="post"><input type="submit" value="Relatório de Vendas"></form>
    <form action="gestaoFunc/index.php" method="post"><input type="submit" value="Gestão de Funcionários"></form>
    <form action="gestaoProd/index.php" method="post"><input type="submit" value="Gestão de Produtos"></form>
    <form action="../sair.php" method="post"><input type="submit" value="sair"></form>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "kyiosh");

    ?>
    
</body>
</html>