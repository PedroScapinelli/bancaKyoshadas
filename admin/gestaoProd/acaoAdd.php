<?php 
    $conn = mysqli_connect("localhost", "root", "", "kyiosh");

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    if(isset($_POST['nomeProd']) && isset($_POST['descProd']) && isset($_POST['precoVenda']) && isset($_POST['precoProm']) && isset($_POST['ativo']) && isset($_POST['prom'])){
        $nomeProd = $_POST['nomeProd'];
        $descProd = $_POST['descProd'];
        $precoVenda = $_POST['precoVenda'];
        $precoProm = $_POST['precoProm'];
        $ativo = $_POST['ativo'];
        $prom = $_POST['prom'];

        $diretorioDestino = '../../uploads/';
        $fotoProd = $_FILES['imagem']['name'];
        $caminhoTemporario = $_FILES['imagem']['tmp_name'];
        $caminhoDestino = $diretorioDestino . basename($fotoProd);

        if(isset($_FILES['imagem'])){

            if($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

                if (move_uploaded_file($caminhoTemporario, $caminhoDestino)) {
                    echo "O arquivo " . htmlspecialchars($fotoProd) . " foi enviado com sucesso!";
                } 
                else{
                    echo "Erro ao mover o arquivo para o diretório de destino.";
                }
            } 
            else{
                echo "Erro no upload do arquivo: " . $_FILES['imagem']['error'];
            }
        } 

        $sql = "INSERT INTO `tbproduto` (`idProduto`, `nomeProd`, `descProd`, `fotoProd`, `precoVenda`, `precoProm`, `ativo`, `promocao`) VALUES (NULL, '$nomeProd', '$descProd', '$fotoProd', '$precoVenda', '$precoProm', '$ativo', '$prom');";
        $resultado = $resultado = mysqli_query($conn, $sql);

        if(!$resultado){
            echo "Erro na consulta: " . mysqli_error($conn);
        }
        else{
            mysqli_close($conn);
                                
            echo "<script>";
            echo "const usrResp2 = confirm('Adição feita com Sucesso!');";
            echo "window.location.href = '../gestaoProd/add.php';}";
            echo "</script>";
        }
    }
    else{
        echo "<script>";
        echo "confirm('Envie uma Imagem');";
        echo "</script>";
    }
    header("Location: add.php");
     
?>