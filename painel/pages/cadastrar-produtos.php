<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valorvenda = str_replace(",",".",$_POST['valorvenda']);
    $valorcompra = str_replace(",",".",$_POST['valorcompra']);
    $empresa = $_POST['empresa'];
    $quantidade = $_POST['quantidade'];
    $data = date('Y.m.d H:i');
    $sucesso = true;
    $sql = MySQL::conectar()->prepare("INSERT INTO `produtos`(`nomeproduto`,`categoria`, `descricao`, `valorvenda`, `valorcompra`, `empresaproduto`, `quantidade`, `datacompra`, `quantidadecomprada`) VALUES (?,?,?,?,?,?,?,?,?)");

    $sql->execute(array($nome,$categoria,$descricao,$valorvenda,$valorcompra,$empresa,$quantidade,$data,$quantidade));
    if($sql->errorInfo()){
        $sucesso = false;
    }

    $dinheiro = $quantidade * $valorcompra;
    $sql = MySQL::conectar()->prepare("INSERT INTO `dinheiro` (`dinheiro`) VALUES (?)");
    $sql->execute(array(-$dinheiro));

}
?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL; ?>css/cadastrar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dinheiro').maskMoney({
                prefix: 'R$ ', // prefixo
                allowNegative: false, // permite valores negativos?
                thousands: '.', // separador de milhares
                decimal: ',', // separador de decimais
                affixesStay: false, // mantém o prefixo e o sufixo na posição correta ao digitar
                allowZero: true // permite valor zero?
            });
        });
  </script>
</head>
<div class="container">
    <p class="titulo">Cadastrar Produtos</p>

    <div class="form">
        <form id="formulario" method="POST">
            <label>Nome Produto:</label><br>
            <input type="text" name="nome" required><br>
            <label>Categoria:</label><br>
            <select name="categoria">
            <option selected>Selecione uma das categorias</option><br>
                <?php
                    $conn = MySQL::conectar()->query("SELECT * FROM `categoria`");;
                    $sql = $conn->fetchAll();
                    foreach($sql as $value){
                        echo "<option value=".$value['id'].">".$value['nome_categoria']."</option><br>";
                    }
                ?>
            </select><br>
            <label>Descrição:</label><br>
            <input type="text" name="descricao" required><br>
            <label>Valor da Venda:</label><br>
            <input type="text" name="valorvenda" id='dinheiro' required><br>
            <label>Valor da Compra:</label><br>
            <input type="text" name="valorcompra" id='dinheiro' required><br>
            <label>Empresa do produto:</label><br>
            <input type="text" name="empresa" required><br>
            <label>Quantidade:</label><br>
            <input type="text" name="quantidade" required><br><br>
            <input type="submit" class="cadastrar" name="acao"><br><br>
        </form>
        <?php
            if(isset($sucesso) && $sucesso = true){
                echo "<div style='background-color: #73BE73; padding: 10px; color: white; '><p>Produto cadastrado com sucesso!</p></div>";
            }
        ?>
    </div>
</div>