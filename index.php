<?php
session_start();
if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 's') {?>
    <form action="carrinho.php" method="post"><input type="submit" value="Ver carrinho"></form>  
<?php 
 }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<main>

    <div>
        <h1 align='center'>Aproveite a Promoção</h1>
        <?php
            // produtos em promocao
            $conn = mysqli_connect("localhost", "root", "", "kyiosh");
            $sql="SELECT * FROM `tbproduto` WHERE `ativo` = 's' AND `promocao` = 's'";
            $resultado = mysqli_query($conn, $sql);
            while($linha = mysqli_fetch_array($resultado)){
                echo "<a href=\"mostrarproduto.php?idProduto=".$linha["idProduto"]."\"><img src='uploads/".$linha["fotoProd"]."'></a>";
            }
        ?>
    </div>
    <div>
        <?php
            // produtos sem promoçao 
             $sql="SELECT * FROM `tbproduto` WHERE `ativo` = 's' AND `promocao` = 'n'";
             $resultado = mysqli_query($conn, $sql);
             while($linha = mysqli_fetch_array($resultado)){
                echo "<a href=\"mostrarproduto.php?idProduto=".$linha["idProduto"]."\"><img src='uploads/".$linha["fotoProd"]."'></a>";
             }
        ?> 
    </div>
    
    <?php
    if ((isset($_SESSION['logado'])) && ($_SESSION['logado'] == 's')) { ?>
        <form action="sair.php" method="post"><input type="submit" value="sair"></form>
    <?php } ?>
</main>
</body>
</html>