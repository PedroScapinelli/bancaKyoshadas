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
            if(isset($_GET['idFunc'])){
                $idFunc = $_GET['idFunc']; 
                echo "Informações Atuais<br>";
                echo "Nome: ".$_GET['nomeFunc']."<br>";
                echo "Email: ".$_GET['emailFunc']."<br>";
                echo "Senha: ".$_GET['senhaFunc']."<br>";
                echo "Função: ".$_GET['funcao']."<br>";
                echo "Ativo: ".$_GET['ativo']."<br>";
                echo "Altere as informações abaixo:<br>";
            }
        ?>
        <form action="acaoAlterar.php" method="post" onsubmit="verificarDados()">
            <input type = "hidden" name="idFunc" value="<?php echo $idFunc;?>">
            <p>Nome:<input type='text' name="nomeNovo" placeholder="Nome"  value="<?php if(isset($_GET['nomeFunc'])) {echo $_GET['nomeFunc'];} ?>" id="input-email" required></p>
            <p>Email:<input type='text' name="emailNovo" placeholder='Email' value="<?php if(isset($_GET['emailFunc'])) {echo $_GET['emailFunc'];} ?>" id="input-email" required></p>
            <p>Senha:<input type='text' name="senhaNovo" placeholder='Senha' value="<?php if(isset($_GET['senhaFunc'])) {echo $_GET['senhaFunc'];} ?>" id="input-senha"required></p>
            <p>Função:
            <select name="funcaoNovo">
                <option value="admin" <?php if(isset($_GET['funcao']) && $_GET['funcao'] == 'admin'){echo 'selected';}?> >Administrador</option>
                <option value="caixa" <?php if(isset($_GET['funcao']) && $_GET['funcao'] == 'caixa'){echo 'selected';}?> >Caixa</option>
                <option value="vendedor" <?php if(isset($_GET['funcao']) && $_GET['funcao'] == 'vendedor'){echo 'selected';}?> >Vendedor</option>
            </select></p>
            <p>Ativo:
            <select name="ativoNovo">
                <option value="s" <?php if(isset($_GET['ativo']) && $_GET['ativo'] == 's'){echo 'selected';}?> >s</option>
                <option value="n" <?php if(isset($_GET['ativo']) && $_GET['ativo'] == 'n'){echo 'selected';}?> >n</option>
            </select></p>
            <input type="submit" value="Alterar">
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
                let ativo = document.getElementById("input-ativo").value;
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
                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                    if (!$conn) {
                        die("Conexão falhou: " . mysqli_connect_error());
                    }
                    if(isset($_POST['nomeNovo']) && isset($_POST['emailNovo']) && isset($_POST['senhaNovo']) && isset($_POST['funcaoNovo']) && isset($_POST['ativoNovo']) && isset($_POST['idFunc'])){
                        $idFunc = $_POST['idFunc'];
                        $novoNome = $_POST['nomeNovo'];
                        $novoEmail = $_POST['emailNovo'];
                        $novoSenha = $_POST['senhaNovo'];
                        $novoFuncao = $_POST['funcaoNovo'];
                        $novoAtivo = $_POST['ativoNovo'];

                        
                        $sql="UPDATE `tbfuncinarios` SET `nomeFunc` = '$novoNome', `emailFunc` = '$novoEmail', `senhaFunc` = '$novoSenha', `funcao` = '$novoFuncao', `ativo` = '$novoAtivo'  WHERE `tbfuncinarios`.`idFunc` = '$idFunc';";
                        $resultado = mysqli_query($conn, $sql);

                        if(!$resultado){
                            echo "Erro na consulta: " . mysqli_error($conn);
                        }
                        else{
                            mysqli_close($conn);
                                
                             echo "<script>";
                              echo "const usrResp2 = confirm('Alteração feita com Sucesso!');";
                               echo "if(usrResp2){";
                               echo "window.location.href = '../gestaoFunc/alterar.php';}";
                             echo "</script>";
                             header("Location: index.php");
                        }
                    }
                }
        ?>   
</body>
</html>