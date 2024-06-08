<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Funcionário</title>
</head>
<body>
<center>
    <form action="add.php" method="post">
        <p><input type="text" name="nome" placeholder="Nome" required></p>
        <p><input type="text" name="email" placeholder="Email" required></p>
        <p><input type="password" name="senha" placeholder="Senha" required></p>
        <p>Função</p>
        <select name="funcao">
            <option value="admin">Administrador</option>
            <option value="caixa">Caixa</option>
            <option value="vendedor">Vendedor</option>
        </select>
        <p><input type="submit" value="Adicionar"></p>
    </form>

    <?php 
        session_start();

        if(!isset($_SESSION['logado'])) { ?>
            <script>
            const usrResp = confirm("você precisa fazer login");

            if(usrResp){
                window.location.href = "admin/login.php";
            }
            </script>
            
    <?php } 
        else{     
            
            if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['funcao'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $funcao = $_POST['funcao'];

                $conn = mysqli_connect("localhost", "root", "", "kyiosh");


                    function validarEmail($email){
                        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                        return preg_match($pattern, $email);
                    }
        
                    $verificarEmailBD = mysqli_query($conn, "SELECT * FROM `tbfuncinarios` WHERE `emailFunc` = '$email'");
        
                    if($linha = mysqli_fetch_array($verificarEmailBD)){
                        mysqli_close($conn);
                        echo "<script>confirm('Email já cadastrado');</script>";
                    }
                    else if(validarEmail($email) != true){
                        echo "<script>confirm('Email inválido');</script>";
                    }
                    else{
                        $sql = "INSERT INTO `tbfuncinarios`(`idFunc`, `nomeFunc`, `emailFunc`, `senhaFunc`, `funcao`, `ativo`) VALUES (NULL, '$nome', '$email', '$senha', '$funcao', 's')";
                        $resultado = mysqli_query($conn, $sql);

                        if(!$resultado){
                            echo "Erro na consulta: " . mysqli_error($conn);
                        }
                        else{
                            mysqli_close($conn);
                            
                            echo "<script>";
                                echo "confirm('Adição feita com Sucesso!');";
                            echo "</script>";
                        
                        }
                    }
            }
        }
    ?>

</center>
</body>
</html>