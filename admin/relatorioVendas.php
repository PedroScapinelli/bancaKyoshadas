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
        
            <form action="" method="post">
                <input type="date" name="data" required>
            </form>
            
            <?php

                if(isset($_POST['data'])){
                    $data = $_POST['data'];

                    $conn = mysqli_connect("localhost", "root", "", "kyiosh");
                }
        }
    ?>
</center>
</body>
</html>