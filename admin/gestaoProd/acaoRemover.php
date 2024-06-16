<?php
    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
    $sql = "SELECT * FROM `tbproduto`";
    $resultado = mysqli_query($conn, $sql);

    while($linha = mysqli_fetch_array($resultado)){
        $idProd = $linha['idProduto'];
        $nomeFoto = $linha['fotoProd'];

        $caminho = '../../uploads/';
        $caminhoArquivo = $caminho . basename($nomeFoto);
        
        if(isset($_POST[$idProd])){
            $sql2 = "DELETE FROM `tbproduto` WHERE `tbproduto`.`idProduto` = $idProd";
            $resultado2 = mysqli_query($conn, $sql2);
            unlink($caminhoArquivo);

            if(!$resultado2){
                echo "Erro na consulta: " . mysqli_error($conn);
            }
        }

        
    }
    mysqli_close($conn);
    header("Location: remover.php");
?>