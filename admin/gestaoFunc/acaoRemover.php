<?php
    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
    $sql="SELECT * FROM `tbfuncinarios`";
    $resultado = mysqli_query($conn, $sql);
    while($linha = mysqli_fetch_array($resultado)){
        $idFunc = $linha['idFunc'];
        if(isset($_POST[$idFunc])){
            $sql2="DELETE FROM `tbfuncinarios` WHERE `idFunc` = '$idFunc';";
            $resultado2 = mysqli_query($conn, $sql2);

            if(!$resultado2){
                echo "Erro na consulta: " . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
    header("Location: remover.php");
?>