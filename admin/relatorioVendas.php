<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<center>
    <?php 
        session_start();
        if(!isset($_SESSION['logado'])) { ?>
            <script>
            const usrResp = confirm("você precisa fazer login");

            if(usrResp){
                window.location.href = "login.php";
            }
            </script>            
    <?php }
        else { ?>
        
            <form action="relatorioVendas.php" method="post">
                <input type="date" name="data" required>
                <input type="submit" value="enviar">
            </form>

            <table border="1" align="center" width="80%">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome do Produto</th>
                        <th>Preço</th>
                        <th>Preço de Venda</th>
                        <th>Quantidade</th>
                        <th>Total Ganho</th>
                    </tr>
                </thead>
            <tbody>
            
            <?php

                if(isset($_POST['data'])){
                    $data = $_POST['data'];
                    $totalPedidos = 0;
                    
                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                    $sql = "SELECT *, SUM(`qnt`) AS 'qntProduto', SUM(`precoVenda`) AS 'total' FROM `tbvendas` WHERE `data` = '$data' GROUP BY `idProduto`;";
                    $resultado = mysqli_query($conn, $sql);

                    if($resultado){
                        while($linha = mysqli_fetch_array($resultado)){
                            $total = $linha['total'];

                            $sql2 = "SELECT *  FROM `tbProduto`;";
                            $resultado2 = mysqli_query($conn,$sql2);

                            if($resultado2){
                                while($linha2 = mysqli_fetch_array($resultado2)){
                                    $foto = $linha2['fotoProd'];
                                    $nomeProd = $linha2['nomeProd'];
                                    $precoProd = $linha2['precoVenda'];
                                }
                            }

                            $precoVenda = $linha['total'] / $linha['qntProduto'];

                            echo "<tr>";
                                echo "<td><img height='50%'src='../imagens/".$foto."' alt='foto produto'></td>";
                                echo "<td>".$nomeProd."</td>";
                                echo "<td>".$precoProd."</td>";
                                echo "<td>".$precoVenda."</td>";
                                echo "<td>".$linha['qntProduto']."</td>";
                                echo "<td>".$total."</td>";
                            echo "</tr>";
                        }
                    }
                }
            }
            mysqli_close($conn);
    ?>
            </tbody>
            </table>
</center>
</body>
</html>