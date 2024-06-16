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
            window.location.href = "*/admin/login.php";
        }
        </script>
    <?php } 
    else{ 
            $idProd = 0;
            if(isset($_GET['idProd']) && isset($_GET['nomeProd']) && isset($_GET['descProd']) && isset($_GET['precoVenda']) && isset($_GET['precoProm']) && isset($_GET['promocao']) && isset($_GET['ativo'])){
                $idProd = $_GET['idProd']; 
                echo "Informações Atuais<br>";
                echo "Nome: ".$_GET['nomeProd']."<br>";
                echo "Descrição: ".$_GET['descProd']."<br>";
                echo "Preço de Venda: ".$_GET['precoVenda']."<br>";
                echo "Preço promocional: ".$_GET['precoProm']."<br>";
                echo "Promoção: ".$_GET['promocao']."<br>";
                echo "Ativo: ".$_GET['ativo']."<br>";
                echo "Altere as informações abaixo:<br>";
            }
        ?>
        <form action="acaoAlterar.php" method="post">
            <input type="hidden" name="idProd" value="<?php echo $idProd ?>"> 
            <p>Nome:<input type='text' name="nomeNovo"  value="<?php if(isset($_GET['nomeProd'])) {echo $_GET['nomeProd'];} ?>" required></p>
            <p>Descrição:<input type='text' name="descNovo" value="<?php if(isset($_GET['descProd'])) {echo $_GET['descProd'];} ?>"  required></p>
            <p>Preço de Venda:<input type='text' name="pvNovo"  value="<?php if(isset($_GET['precoVenda'])) {echo $_GET['precoVenda'];} ?>" required></p>
            <p>Preço promocional:<input type='text' name="ppNovo"  value="<?php if(isset($_GET['precoProm'])) {echo $_GET['precoProm'];} ?>" required></p>
            <p>Promoção:
            <select name="promoNovo">
                <option value="s" <?php if(isset($_GET['promocao']) && $_GET['promocao'] == 's'){echo 'selected';}?> >Sim</option>
                <option value="n" <?php if(isset($_GET['promocao']) && $_GET['promocao'] == 'n'){echo 'selected';}?> >Não</option>
            </select></p>
            <p>Ativo:
            <select name="ativoNovo">
                <option value="s" <?php if(isset($_GET['ativo']) && $_GET['ativo'] == 's'){echo 'selected';}?> >Sim</option>
                <option value="n" <?php if(isset($_GET['ativo']) && $_GET['ativo'] == 'n'){echo 'selected';}?> >Não</option>
            </select></p>
            <p><input type="submit" value="Alterar"></p>
        </form>
        <form action='index.php' method='post'><input type='submit' value='voltar'></form>

    <?php
                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                    if (!$conn) {
                        die("Conexão falhou: " . mysqli_connect_error());
                    }
                    if(isset($_POST['nomeNovo']) && isset($_POST['descNovo']) && isset($_POST['pvNovo']) && isset($_POST['ppNovo']) && isset($_POST['ativoNovo']) && isset($_POST['promoNovo'])&& isset($_POST['idProd'])){
                        $idProd = $_POST['idProd'];
                        $novoNome = $_POST['nomeNovo'];
                        $descNovo = $_POST['descNovo'];
                        $pvNovo = $_POST['pvNovo'];
                        $ppNovo = $_POST['ppNovo'];
                        $ativoNovo = $_POST['ativoNovo'];
                        $promoNovo = $_POST['promoNovo'];

                        $sql="UPDATE `tbproduto` SET `nomeProd` = '$novoNome', `descProd` = '$descNovo', `precoVenda` = ' $pvNovo', `precoProm` = '$ppNovo', `ativo` = '$ativoNovo', `promocao` = '$promoNovo' WHERE `tbproduto`.`idProduto` = $idProd";
                        $resultado = mysqli_query($conn, $sql);

                        if(!$resultado){
                            echo "Erro na consulta: " . mysqli_error($conn);
                        }
                        else{
                            mysqli_close($conn);
                                
                             echo "<script>";
                              echo "const usrResp2 = confirm('Alteração feita com Sucesso!');";
                               echo "if(usrResp2){";
                               echo "window.location.href = '../gestaoProd/alterar.php';}";
                             echo "</script>";

                        }
                    }
                }
        ?>      
</body>
</html>