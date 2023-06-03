<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/estilologin.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="overlay"></div>
        <div class="login">
            <?php
                if(isset($_POST['acao'])){
                    $user = $_POST['nome'];
                    $password = $_POST['senha'];
                    $sql = MySQL::conectar()->prepare("SELECT * FROM `usuarios` WHERE nome = ? AND senha = ?");
                    $sql->execute(array($user, $password));
                    if($sql->rowCount() == 1){
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['senha'] = $password;
                        header("Location: ".INCLUDE_PATH_PAINEL);
                        die();
                    }else{
                        echo '<div class="erro-login"><p style="color: red">Usuário ou senha incorretos!</p></div>';
                    }
                }
            ?>
            <h1>LOGIN</h1>
            <div class="form">
                <form method="POST" action="">
                    <label>NOME</label><br>
                    <input type="text" name="nome" PLACEHOLDER='EX: teste@teste.com;br'><br>
                    <label>Senha</label><br>
                    <input type="password" name="senha"><br><br>
                    <input type="submit" name="acao" VALUE="ENVIAR">
                    <a href="">Esqueceu a senha?</a>
                    <?php
                        $pdo = MySQL::conectar();
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>