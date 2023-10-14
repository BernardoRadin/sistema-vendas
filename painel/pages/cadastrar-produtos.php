<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['acao'])){
    if(isset($_POST['nome']) && isset($_POST['categoria']) && !empty($_POST['categoria']) && isset($_POST['descricao']) && isset($_POST['valorvenda']) && is_numeric($_POST['valorvenda']) && isset($_POST['valorcompra']) && is_numeric($_POST['valorcompra']) && isset($_POST['empresa']) && isset($_POST['quantidade']) && is_numeric($_POST['quantidade'])){
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];
        $valorvenda = str_replace(",",".",$_POST['valorvenda']);
        $valorcompra = str_replace(",",".",$_POST['valorcompra']);
        $empresa = $_POST['empresa'];
        $quantidade = $_POST['quantidade'];
        $data = date('Y.m.d H:i');

        $sql = MySQL::conectar()->prepare("INSERT INTO `produtos`(`nomeproduto`,`categoria`, `descricao`, `valorvenda`, `valorcompra`, `empresaproduto`, `quantidade`, `datacompra`, `quantidadecomprada`,`excluido`) VALUES (?,?,?,?,?,?,?,?,?,'0')");
        $sucesso = true;

        if(!$sql->execute(array($nome,$categoria,$descricao,$valorvenda,$valorcompra,$empresa,$quantidade,$data,$quantidade))){
            $sucesso = false;
        }

        $dinheiro = $quantidade * $valorcompra;
        $sql = MySQL::conectar()->prepare("INSERT INTO `dinheiro` (`dinheiro`) VALUES (?)");
        $sql->execute(array(-$dinheiro));
    }else{
        $sucesso = false;
    }
}
?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL; ?>css/cadastrar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
</head>
<div class="container">
    <p class="titulo">Cadastrar Produtos</p>

    <div class="form">
        <form id="formulario" method="POST">
            <label>Nome Produto:</label><br>
            <input type="text" name="nome" required><br>
            <label>Categoria:</label><br>
            <select name="categoria" required>
            <option selected value="">Selecione uma das categorias</option><br>
                <?php
                    $conn = MySQL::conectar()->query("SELECT `id`,`nome_categoria` FROM `categoria`");;
                    $sql = $conn->fetchAll();
                    foreach($sql as $value){
                        echo "<option value=".$value['id'].">".$value['nome_categoria']."</option><br>";
                    }
                ?>
            </select><br>
            <label>Descrição:</label><br>
            <input type="text" name="descricao" required><br>
            <div style="position: relative">
                <label>Valor pago na compra:</label><br>
                <input class="valorcompra" type="text" name="valorcompra" id='dinheiro' required><br>
                <p class="label-reais">R$ </p>
            </div>
            <div style="position: relative">
                <label>Valor de Venda:</label><br>
                <input class="valorvenda" type="text" name="valorvenda" id='dinheiro' required><br>
                <p class="label-reais">R$ </p>
            </div>
            <label>Empresa do produto:</label><br>
            <input type="text" name="empresa" required><br>
            <label>Quantidade:</label><br>
            <input type="text" name="quantidade" required><br><br>
            <input type="submit" class="cadastrar" name="acao"><br><br>
        </form>
        <?php
            if(isset($sucesso) && $sucesso == true){
                echo "<div style='background-color: #73BE73; padding: 10px; color: white; '><p>Produto cadastrado com sucesso!</p></div>";
            }
            if(isset($sucesso) && $sucesso == false){
                echo "<div style='background-color: red; padding: 10px; color: white; '><p>Ocorreu um erro, verifique os campos!</p></div>";
            }
        ?>
    </div>
</div>