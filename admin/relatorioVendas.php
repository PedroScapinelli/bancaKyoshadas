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
                
                if (isset($_POST['data'])) {
                    $data = $_POST['data'];
                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                    $totalVendas = 0;
                    
                    if (!$conn) {
                        die("Conexão falhou: " . mysqli_connect_error());
                    }
                
                    $sql = "SELECT v.idProduto, p.fotoProd, p.nomeProd, p.precoVenda, SUM(v.qnt) AS 'qntProduto', SUM(v.precoVenda) AS 'total'
                             FROM tbvendas v
                             JOIN tbProduto p ON v.idProduto = p.idProduto
                             WHERE v.data = '$data'
                             GROUP BY v.idProduto;";
                    $resultado = mysqli_query($conn, $sql);
                
                    if ($resultado) {
                        while ($linha = mysqli_fetch_array($resultado)) {
                            $foto = $linha['fotoProd'];
                            $nomeProd = $linha['nomeProd'];
                            $precoProd = $linha['precoVenda'];
                            $total = $linha['total'];
                            $qntProduto = $linha['qntProduto'];
                            $totalVendas += $total;
                
                            if ($qntProduto > 0) {
                                $precoVenda = $total / $qntProduto;
                            } else {
                                $precoVenda = 0;
                            }
                
                            echo "<tr>";
                                echo "<td><img height='50%' src='../uploads/" . $foto . "' alt='foto produto'></td>";
                                echo "<td>" . $nomeProd . "</td>";
                                echo "<td>R$" . $precoProd . "</td>";
                                echo "<td>R$" . $precoVenda . "</td>";
                                echo "<td>" . $qntProduto . "</td>";
                                echo "<td>R$" . $total . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Erro na consulta: " . mysqli_error($conn);
                    }
                
                    echo "<tr>";
                        echo "<h3>Total de Vendas: R$".$totalVendas."</h3>";
                    echo "</tr>";

                    mysqli_close($conn);
            }
        }
    ?>
            </tbody>
            </table>

            <form action='index.php' method='post'><input type='submit' value='voltar'></form>
</center>
</body>
</html>