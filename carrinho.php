<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
<main>
    <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "kyiosh");

        if(!isset($_SESSION['logado'])) { ?>
            <script>
            const usrResp = confirm("você precisa fazer login");

            if(usrResp){
                window.location.href = "login.php";
            }
            
            </script>            
    <?php }
        else { ?>
            <form action="index.php" method="post"><input type="submit" value="Continuar comprando"></form>
            <form action="?acao=limpar" method="post"><input type="submit" value="Limpar Carrinho"></form>

        <?php
            if(!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array();
            }

            if(isset($_GET['acao'])){
	
                //adicionar produto ao carrinho
                if($_GET['acao'] === 'add'){
                    $idProduto = intval($_GET['idProduto']);

                    if(!isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto] = 1; //se o carrinho n tiver o produto, adicionar
                    } 
                    else {
                        $_SESSION['carrinho'][$idProduto] += 1; // se o produto já estar no carrinho, adicionar mais um
                    }
                } 
                
                //limpar os produtos do carrinho
                if($_GET['acao'] === 'limpar'){
                    unset($_SESSION['carrinho']);
                    $_SESSION['carrinho'] = array();
                }
                
                //altera a qnt de produto
                if($_GET['acao'] === 'remover'){
                    $idProduto = intval($_GET['idProduto']);

                    if(isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION['carrinho'][$idProduto] -= 1; // se o produto existir no carrinho, remover uma unidade do produto

                    if($_SESSION['carrinho'][$idProduto] <= 0){
                        unset($_SESSION['carrinho'][$idProduto]); // se a quantidade de produto no carrinho for <= 0, retirá-lo do carrinho
                        }
                    }
                }

                //"compra" dos produtos, basicamente coloca os produtos do carrinho na tbVendas (p/ o formulario dps) e apaga a sessão carrinho
                if($_GET['acao'] === 'comprar' && isset($_SESSION['carrinho'])){
                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                    $preco = 0;
                    $idCliente = $_SESSION["idCliente"];

                    foreach($_SESSION['carrinho'] as $idProduto => $qnt){
                        $sql = "SELECT *  FROM tbProduto WHERE `idProduto`= '$idProduto'";
                        $resultado = mysqli_query($conn,$sql);
                        
                        while($linha = mysqli_fetch_array($resultado)){
                            if($linha["promocao"] == "s"){
                                $preco = $linha["precoProm"];
                            }
                            else{
                                $preco = $linha["precoVenda"];                                
                            }
                        
                            $sql2 = "INSERT INTO `tbvendas` (`idPedido`, `idProduto`, `idCliente`, `data`, `precoVenda`, `qnt`) VALUES (NULL, '$idProduto', '$idCliente', current_timestamp(), '$preco', '$qnt');";
                            $resultado2 = mysqli_query($conn, $sql2);

                            if(!$resultado2){
                                echo "Erro: " . $sql2 . "<br>" . mysqli_error($conn);                            }
                        }
                    }

                    mysqli_close($conn);
                    unset($_SESSION['carrinho']);
                    $_SESSION['carrinho'] = array();
                }
            }

           if(count($_SESSION['carrinho']) == 0){
			echo "<h1>Não há produto no carrinho</h1>";
            } 
            else {
                $total = 0;

                foreach($_SESSION['carrinho'] as $idProduto => $qtd){
                    $sql   = "SELECT *  FROM tbProduto WHERE `idProduto`= '$idProduto'";
                    $resultado = mysqli_query($conn,$sql);
            
                    while($linha = mysqli_fetch_array($resultado)){
                        echo "<div>";
                        echo "<img src='uploads/".$linha["fotoProd"]."'>";
                        echo "<h2>Produto: ".$linha["nomeProd"]."</h2>";
                        echo "<h2>Descrição: ".$linha["descProd"]."</h2>";
                        echo "<h2>Quantidade: ".$qtd."</h2>";
                        echo "<form action='?acao=remover&idProduto=$idProduto' method='post'><input type='submit' value='remover'></form><p>";
                        echo "<form action='?acao=add&idProduto=$idProduto' method='post'><input type='submit' value='adicionar mais um'></form><p>";
                        echo "</div>";
                        if($linha["promocao"] == "s"){
                            $_SESSION['precoVendido'] = $linha["precoProm"];

                            $total += $qtd * $linha["precoProm"];
                            $subTotal = $qtd * $linha["precoProm"];

                            echo "<h2>Preço promocional: ".$linha["precoProm"]." (preço antigo: ".$linha["precoVenda"].")</h2>";                 
                            echo "<h2>Sub Total = ".$subTotal."</h2>";                 
                        }
                        else{
                            $_SESSION['precoVendido'] = $linha["precoVenda"];

                            $total += $qtd * $linha["precoVenda"];
                            $subTotal = $qtd * $linha["precoVenda"];

                            echo "<h2>Preço: ".$linha["precoVenda"]."</h2>";
                            echo "<h2>Sub Total = ".$subTotal."</h2>";                 
                        }
                    }
                }
                mysqli_close($conn);
                echo "<h2>Total: ".$total."</h2>";  
            }
            ?> 
                 <form action="?acao=comprar" method="post"><input type="submit" value="Comprar"></form>
                <?php      
      }
    ?>
</main>
</body>
</html>