<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<?php 
    session_start();
    if(!isset($_SESSION['logado'])) { ?>
        <script>
        const usrResp = confirm("você precisa fazer login");
        if(usrResp){
            window.location.href = "admin/login.php";
        }
        </script><?php 
        }else{ ?>
             <table border="1" align="center" width="80%">
                <thead>
                    <tr>
                        <th>Alterar</th>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço de Venda</th>
                        <th>Preço de Promoção</th>
                        <th>Promoção</th>
                        <th>Ativo</th>
                    </tr>
                </thead>
            <tbody>
        <?php
         $conn = mysqli_connect("localhost", "root", "", "kyiosh");
         $sql="SELECT * FROM `tbproduto`;";
         $resultado = mysqli_query($conn, $sql);

         while($linha = mysqli_fetch_array($resultado)){
            $idProd = $linha['idProduto'];

            $dados = "idProd=".$idProd."&nomeProd=".$linha['nomeProd']."&descProd=".$linha['descProd']."&precoVenda=".$linha['precoVenda']."&precoProm=".$linha['precoProm']."&promocao=".$linha['promocao']."&ativo=".$linha['ativo']."";

             echo "<tr>";
                echo "<th><form action='acaoAlterar.php?".$dados."' method='post'> <input type='submit' value='Alterar'></form></th>";
                echo "<th><img src='../../uploads/".$linha["fotoProd"]."'></th>";
                echo "<th>".$idProd."</th>";
                echo "<th>".$linha['nomeProd']."</th>";
                echo "<th>".$linha['descProd']."</th>";
                echo "<th>".$linha['precoVenda']."</th>";
                echo "<th>".$linha['precoProm']."</th>";
                echo "<th>".$linha['promocao']."</th>";
                echo "<th>".$linha['ativo']."</th>";
             echo "</tr>";
             
         }
    }

    ?>
        
            </tbody>
        </table>
        <center><form action='index.php' method='post'><input type='submit' value='voltar'></form></center>
</body>
</html>
