<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

$sql = MySQL::conectar()->query("SELECT `id`,`nomeproduto` FROM `produtos`");
$resultprodutos = $sql->fetchAll();

$sql = MySQL::conectar()->query("SELECT `id`,`nome` FROM `clientes`");
$resultclientes = $sql->fetchAll();


if(isset($_POST['acao'])){
    $produtoid = $_POST['produto'];
    $clienteid = $_POST['cliente'];
    $quantidade = $_POST['quantidade'];

    $sql = MySQL::conectar()->query("SELECT `quantidade`,`valorvenda` FROM `produtos` WHERE `id` = $produtoid");
    $result = $sql->fetchAll();
    $quantidadeatual = $result[0]['quantidade'];

    if($quantidadeatual >= $quantidade){
        $valorvenda = $result[0]['valorvenda'];
        $data = date('Y.m.d H:i');
        $sql = MySQL::conectar()->prepare("INSERT INTO `vendas`(`produtovenda_id`,`clientevenda_id`,`data`,`quantidade`) VALUES ((?),(?),(?),(?))");
        if($sql->execute(array($produtoid,$clienteid,$data,$quantidade))){
            $sucesso = "sim";    
        }

        $quantidadenova = $quantidadeatual - $quantidade;
        $sql_update = MySQL::conectar()->prepare("UPDATE `produtos` SET `quantidade` = (?) WHERE `id` = (?)");
        $sql_update->execute(array($quantidadenova, $produtoid));

        $dinheiro = $quantidade * $valorvenda;
        $sql_dinheiro = MySQL::conectar()->prepare("INSERT INTO `dinheiro` (`dinheiro`) VALUES (?)");
        $sql_dinheiro->execute(array(+$dinheiro));
    }else{
    $sucesso = 'nao tem quantidade';
    }
}
?>
<div class="container">
    <head>
        <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL; ?>css/cadastrar.css">
    </head>
    <p class="titulo">Realizar Venda</p>

    <div class="form">
        <form id="formulario" method="POST" action="">
            <label>Produto:</label><br>
            <select name="produto" required>
                <option selected>Selecione um produto</option>
            <?php 
            foreach($resultprodutos as $value){
                echo "<option value='$value[id]'>$value[nomeproduto]</option>";
            }
            ?>
            </select>
            <label>Cliente:</label><br>
            <select name="cliente" required>
                <option selected>Selecione um cliente</option>
            <?php 
            foreach($resultclientes as $value){
                echo "<option value='$value[id]'>$value[nome]</option>";
            }
            ?>
            </select>
            <label>Quantidade:</label><br>
            <input type="text" name="quantidade" required><br><br>
            <input type="submit" class="cadastrar" name="acao"><br><br>
        </form>
        <?php
            if(isset($sucesso) && $sucesso == "sim"){
                echo "<div style='background-color: #73BE73; padding: 10px; color: white'><p>Venda realizada com sucesso!</p></div>";
            }
            if(isset($sucesso) && $sucesso == "nao"){
                echo "<div style='background-color: red; padding: 10px; color: white'><p>A venda não foi realizada!</p></div>";
            }
            if(isset($sucesso) && $sucesso == 'nao tem quantidade'){
                echo "<div style='background-color: red; padding: 10px; color: white'><p>Não há estoque suficiente deste item!</p></div>";
            }
            if(isset($sucesso) && $sucesso == 'semvalor'){
                echo "<div style='background-color: red; padding: 10px; color: white'><p>Selecione um valor antes de realizar a venda!</p></div>";
            }
        ?>
    </div>
</div>