<?php
if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['deletar'])){
    $id = $_POST['deletar'];

    $sql_select = MySQL::conectar()->prepare("SELECT produtos.id,vendas.quantidade,valorvenda FROM `vendas` INNER JOIN `produtos` ON vendas.produtovenda_id = produtos.id WHERE vendas.id = (?)");
    $sql_select->execute(array($id));
    $result_select = $sql_select->fetchAll();
    $idproduto = $result_select[0]['id'];
    $quantidadecomprada = $result_select[0]['quantidade'];
    $valorvenda = $result_select[0]['valorvenda'];

    $dinheiro = $quantidadecomprada * $valorvenda;
    $sql = MySQL::conectar()->prepare("INSERT INTO `dinheiro` (`dinheiro`) VALUES (?)");
    $sql->execute(array(-$dinheiro));

    $update = MySQL::conectar()->prepare("UPDATE `produtos` SET `quantidade` = `quantidade` + '$quantidadecomprada' WHERE `id` = (?)");
    $update->execute(array($idproduto));

    $sql_editar = MySQL::conectar()->prepare("DELETE FROM `vendas` WHERE `id` = (?)");
    $sql_editar->execute(array($id));

}

    $sql = MySQL::conectar()->query("SELECT vendas.id AS id_venda,vendas.quantidade,vendas.produtovenda_id,vendas.clientevenda_id,vendas.data,vendas.quantidade,produtos.id,produtos.nomeproduto,clientes.id,clientes.nome FROM `vendas` JOIN `produtos` ON vendas.produtovenda_id = produtos.id JOIN `clientes` ON vendas.clientevenda_id = clientes.id ORDER BY `data` DESC");
    $result = $sql->fetchAll();
?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL?>css/listar-clientes.css">
</head>
<div class="container">
    <p class="titulo">Listar Vendas</p>
    <div class="center">
    <table class="table">
        <th>Produto</th>
        <th>Cliente</th>
        <th>Data</th>
        <th>Quantidade</th>
        <th>Deletar</th>
    <?php
    foreach($result as $value){
        echo
        "<tr>
            <td class='p-nome'>".$value['nomeproduto']."</td>
            <td class='p-nome'>".$value['nome']."</td>
            <td>".date('d/m/Y', strtotime($value['data']))."</p>
            <td>".$value['quantidade']."</td>
            <td><button onclick=\"deletar({$value['id_venda']})\" class='deletar'><img class='deletar-img' src='".INCLUDE_PATH_PAINEL."/images/lixeira.png'></button></td>
        </tr>";
        }
    ?>
    </table>
    <div class="clear"></div>
    </div>
</div>
<script>
    function deletar(id){
    var id = id;
        Swal.fire({
            text: 'Você deseja excluir a venda selecionada?',
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
                url: "http://localhost/sistemacompraevenda/painel/listar-vendas",
                data: {deletar: id}
            });
        window.location.href="http://localhost/sistemacompraevenda/painel/listar-vendas";
   
        }
})
    };
</script>