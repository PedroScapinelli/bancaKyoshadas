
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Funcionário</title>
</head>
<body>
<center>
    <form action="add.php" method="post" onsubmit="verificarDados()">
        <p><input type="text" name="nome" placeholder="Nome" id="input-nome" required></p>
        <p><input type="text" name="email" placeholder="Email" id="input-email" required></p>
        <p><input type="password" name="senha" placeholder="Senha" id="input-senha" required></p>
        <p>Função</p>
        <select name="funcao">
            <option value="admin">Administrador</option>
            <option value="caixa">Caixa</option>
            <option value="vendedor">Vendedor</option>
        </select>
        <p><input type="submit" value="Adicionar"></p>
    </form>
    <form action='index.php' method='post'><input type='submit' value='voltar'></form>

    <script>
    function validarEmail(email) {
		let re = /\S+@\S+\.\S+/;
		return re.test(email);
	}

	function verificarDados() {
		let email = document.getElementById("input-email").value;
		let nome = document.getElementById("input-nome").value;
		let senha = document.getElementById("input-senha").value;

		if(!validarEmail(email)) {
			confirm("Digite um email válido!");

			document.getElementById("input-email").focus();
			window.onsubmit = function() { return false; };	
		} 
        else if(nome.length < 3) {
			confirm("O nome deve ter no mínimo 3 caracteres!");
            
			document.getElementById("input-nome").focus();
			window.onsubmit = function() { return false; };
		}
        else if(senha.length < 6){
            confirm("A senha deve ter no mínimo 6 caracteres!");

			document.getElementById("input-senha").focus();
			window.onsubmit = function() { return false; };
        }
        else if(ativo.length > 1 && ativo.length <= 0){
            confirm("O status de ativo deve ser somente 's' (sim) ou 'n' (não)");
            
			document.getElementById("input-ativo").focus();
			window.onsubmit = function() { return false; };
        }
        else{
			return true;
		}
	}
    </script>

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
                            echo "const usrResp2 = confirm('Alteração feita com Sucesso!');";
                             echo "if(usrResp2){";
                             echo "window.location.href = '../gestaoFunc/index.php';}";
                           echo "</script>";

                        }
                    }
            }
        }
    ?>

</center>
</body>
</html>