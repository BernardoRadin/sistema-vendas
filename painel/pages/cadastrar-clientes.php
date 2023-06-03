<?php
if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $datanasc = $_POST['datanasc'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sucesso = true;

    $sql = MySQL::conectar()->prepare("INSERT INTO `clientes`(`nome`,`cpf`, `datanasc`, `email`, `telefone`) VALUES (?,?,?,?,?)");
    $sql->execute(array($nome,$cpf,$datanasc,$email,$telefone));

    if($sql->errorInfo()){
        $sucesso = false;
    }
}

?>

<div class="container">
    <head>
        <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL; ?>css/cadastrar.css">
    </head>
    <p class="titulo">Cadastrar Clientes</p>

    <div class="form">
        <form id="formulario" method="POST">
            <label>Nome:</label><br>
            <input type="text" name="nome" required><br>
            <label>Data Nascimento:</label><br>
            <input type="date" name="datanasc" required><br>
            <label>CPF:</label><br>
            <input type="text" name="cpf" required><br>
            <label>EMAIL:</label><br>
            <input type="email" name="email" placeholder="Ex: teste@teste.com.br" required><br>
            <label>Telefone:</label><br>
            <input type="text" name="telefone" required><br>
            <input type="submit" class="cadastrar" name="acao"><br><br>
        </form>
        <?php
            if(isset($sucesso) && $sucesso = true){
                echo "<div style='background-color: #73BE73; padding: 10px; color: white; '><p>Cliente cadastrado com sucesso!</p></div>";
            }else if($sucesso = false){
                echo "<div style='background-color: red; padding: 10px; color: white; '><p>O cliente não foi cadastrado!</p></div>";
            }
        ?>
    </div>
</div>