<?php
session_start();
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
    <?php 
        $_SESSION["idProduto"] = intval($_GET['idProduto']);
        $idProduto = $_SESSION["idProduto"];
        $conn = mysqli_connect("localhost", "root", "", "kyiosh");
        $sql="SELECT * FROM `tbproduto` WHERE `idProduto` = '$idProduto'";
        $resultado = mysqli_query($conn, $sql);

        while($linha = mysqli_fetch_array($resultado)){
            echo "<img src='imagens/".$linha["fotoProd"]."'>";
            echo "<h2>Produto: ".$linha["nomeProd"]."</h2>";
            echo "<h2>Descrição: ".$linha["descProd"]."</h2>";

            if($linha["promocao"] === "s"){
                echo "<h2>Preço promocional: ".$linha["precoProm"]." (preço antigo: ".$linha["precoVenda"].")</h2>";                 
            }
            else{
                echo "<h2>Preço: ".$linha["precoVenda"]."</h2>";
            }
            echo "<form action=\"carrinho.php?acao=add&idProduto=".$linha["idProduto"]."\" method="."post"."><input type="."submit"." value="."Adicionar ao carrino"."></form>";
        }
    ?>
</main>
</body>
</html>