<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

$sql_categoria = MySQL::conectar()->query("SELECT * FROM `categoria`");
$result_categoria = $sql_categoria->fetchAll();

if(isset($_POST['deletar'])){
    $id = $_POST['deletar'];
    $sql_editar = MySQL::conectar()->prepare("DELETE FROM `produtos` WHERE `id` = (?)");
    $sql_editar->execute(array($id));
}

if(isset($_POST['editar_acao'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valorvenda = $_POST['valorvenda'];
    $valorcompra = $_POST['valorcompra'];
    $empresa = $_POST['empresa'];
    $quantidade = $_POST['quantidade'];

    $sql_quantidade = MySQL::conectar()->prepare("SELECT `quantidade`,`valorcompra` FROM `produtos` WHERE `id` = (?)");
    $sql_quantidade->execute(array($id));
    $result = $sql_quantidade->fetchAll();
    $quantidadetotal = $result[0][0];


    if($quantidade > $quantidadetotal){
        $data = date('Y.m.d H:i');
        $quantidadenova = $quantidade - $quantidadetotal;
        $sql_novaquantidade = MySQL::conectar()->prepare("INSERT INTO `reporestoque`(`data`,`quantidadenova`,`id_produto`) VALUES (?,?,?)");
        $sql_novaquantidade->execute(array($data,$quantidadenova,$id));

        $dinheiro = $quantidadenova * $valorcompra;
        $sql = MySQL::conectar()->prepare("INSERT INTO `dinheiro` (`dinheiro`) VALUES (?)");
        $sql->execute(array(-$dinheiro));

    }

    $sql_editar = MySQL::conectar()->prepare("UPDATE `produtos` SET `nomeproduto` = (?),`categoria` = (?), `descricao` = (?), `valorvenda` = (?), `valorcompra` = (?), `empresaproduto` = (?), `quantidade`= (?) WHERE `id` = (?)");
    $sql_editar->execute(array($nome,$categoria,$descricao,$valorvenda,$valorcompra,$empresa,$quantidade,$id));
}

$sql = MySQL::conectar()->query("SELECT * FROM `produtos`");
$result = $sql->fetchAll();
    
?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL?>css/listar-produtos.css">
</head>
<div class="container">
    <p class="titulo">Listar Produtos</p>
    <div class="center">
    <?php
    foreach($result as $value){
        foreach($result_categoria as $value2){
            if($value['categoria'] == $value2['id']){
                $categoria = $value2['nome_categoria'];
            }
        }    
        if(!isset($categoria)){
            $categoria = "Não";
        }
        if($value['quantidade'] == 0){
            $estoquecor = "style='border-color: gray'";
        }else{
            $estoquecor = "style='border-color: rgb(235, 130, 1)'";
        }
        echo
        "<div class='foreach' ".$estoquecor." onclick=\"pegaid('{$value['id']}','{$value['nomeproduto']}','{$value['categoria']}','{$value['descricao']}','{$value['valorvenda']}','{$value['valorcompra']}','{$value['empresaproduto']}','{$value['quantidade']}')\">
            <p class='p-nome'><b>Nome:</b> ".ucfirst($value['nomeproduto'])."</p>
            <p><b>Categoria:</b> ". $categoria ."</p>
            <p><b>Descrição:</b> ".ucfirst($value['descricao'])."</p>
            <p><b>Preço Venda:</b> R$".$value['valorvenda']."</p>
            <p><b>Quantidade:</b> ".$value['quantidade']." UN</p>
        </div>";
        }
    ?>
    <div class='clear'></div>
    </div>
</div>
<script>
    function pegaid(id,nome,categoria,descricao,valorvenda,valorcompra,empresa,quantidade){
        $('.caixa-meio').append(
                '<form id="formulario" method="POST" action=""><input type="hidden" name="id" value=\"'+id+'\"><label>Nome Produto:</label><br><input type="text" name="nome" value=\"'+nome+'\" required><br><label>Categoria:</label><br><select name="categoria"><?php $conn = MySQL::conectar()->query("SELECT * FROM `categoria`"); $sql = $conn->fetchAll(); foreach($sql as $value){echo "<option value=".$value['id'].">".$value['nome_categoria']."</option><br>"; } ?>
                </select><br><label>Descrição:</label><br><input type="text" name="descricao" value=\"'+descricao+'\" required><br><label>Valor da Venda:</label><br><input type="text" name="valorvenda" value=\"'+valorvenda+'\" required><br><label>Valor da Compra:</label><br><input type="text" name="valorcompra" value=\"'+valorcompra+'\" required><br><label>Empresa do produto:</label><br><input type="text" name="empresa" value=\"'+empresa+'\" required><br><label>Quantidade:</label><br><input type="text" name="quantidade" value=\"'+quantidade+'\" required><br><br><input type="submit" class="editar" name="editar_acao" value="Editar"><br><br></form><label style="float: right; color: red; padding: 10px; font-weight: bold; cursor: pointer" onclick=\"deletar('+id+')\">Deletar</label>')
        $('.container2').css('display', 'block')
        $('body').css('overflow', 'hidden')
        $('.caixa').slideDown()        
        window.scrollTo(0, 0);
        $(".caixa-meio").slideDown();

        $('.container2').click(function() {
            $('body').css('overflow', 'visible')
            $('.container2').css('display', 'none');
            $('.caixa').css('display', 'none');
            $(".caixa-meio").empty()
        })
    }

    function deletar(id){
        var id = id;
        Swal.fire({
            title: 'Você deseja excluir o usuário selecionado?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Deletar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "http://localhost/sistemacompraevenda/painel/listar-produtos",
                data: {deletar: id}
            });
        window.location.href="http://localhost/sistemacompraevenda/painel/listar-produtos";
        }
})
    };

</script>