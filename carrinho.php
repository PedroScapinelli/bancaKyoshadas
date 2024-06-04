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
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "kyiosh");
        if (!isset($_SESSION['logado'])) { ?>
            <script>alert('Você precisa estar logado para usar o carrinho');</script>
            <form action="login.php" method="post"><input type="submit" value="Fazer login"></form>
    <?php
        }else{
            if(isset($_GET['acao'])){
	
                //ADICIONAR CARRINHO
                if($_GET['acao'] === 'adicionar'){
                    $idProduto = intval($_GET['idProduto']);
                    if(!isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto] = 1;
                    } else {
                        $_SESSION['carrinho'][$idProduto] += 1;
                    }
                } 
                
                //REMOVER CARRINHO 
                if($_GET['acao'] === 'limpar'){
                    unset($_SESSION['carrinho']);
                    $_SESSION['carrinho'] = array();
                } 
                
                //ALTERAR QUANTIDADE
                if($_GET['acao'] === 'remover'){
                    $idProduto = intval($_GET['idProduto']);
                    if(isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto] -= 1;
        echo 	$_SESSION['carrinho'][$idProduto];			
                        if ($_SESSION['carrinho'][$idProduto]<=0){
                            unset($_SESSION['carrinho'][$idProduto]);
                        }
                    }
                }		
           }
           if(count($_SESSION['carrinho']) == 0){
			echo "<h1>Não há produto no carrinho</h1>";
            } else {
                foreach($_SESSION['carrinho'] as $idProduto => $qtd){
                    $sql   = "SELECT *  FROM tbProduto WHERE `idProduto`= '$idProduto'";
                    $resultado = mysqli_query($conn,$sql);
                    while($linha = mysqli_fetch_array($resultado)){
                        echo "<img src='imagens/".$linha["fotoProd"]."'>";
                        echo "<h2>Produto: ".$linha["nomeProd"]."</h2>";
                        echo "<h2>Descrição: ".$linha["descProd"]."</h2>";
                        echo "<h2>Quantidade: ".$qtd."</h2>";
                        if($linha["promocao"] == "s"){
                            echo "<h2>Preço promocional: ".$linha["precoProm"]." (preço antigo: ".$linha["precoVenda"].")</h2>";                 
                        }else{
                            echo "<h2>Preço: ".$linha["precoVenda"]."</h2>";
                        }
                    }
                } 
            }          
        }
    ?>
</main>
</body>
</html>