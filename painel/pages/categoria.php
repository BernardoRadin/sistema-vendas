<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['deletar'])){
    $id = $_POST['deletar'];
    $sql_editar = MySQL::conectar()->prepare("DELETE FROM `categoria` WHERE `id` = (?)");
    $sql_editar->execute(array($id));
}

if(isset($_POST['acaocadastro'])){

$nome = $_POST['nome'];

$sql = MySQL::conectar()->prepare("INSERT INTO `categoria`(`nome_categoria`) VALUES (?)");
$sql->execute(array($nome));
$sucesso = true;

if($sql->errorInfo()){
    $sucesso = false;
}
}

if(isset($_POST['novo-nome'])){
    $novo_nome = $_POST['novo-nome'];
    $id = $_POST['id'];
    $sql_editar = MySQL::conectar()->prepare("UPDATE `categoria` SET `nome_categoria` = (?) WHERE `id` = (?)");
    $sql_editar->execute(array($novo_nome, $id));
}

$sqlselect = MySQL::conectar()->query("SELECT * FROM `categoria`");
$fetch = $sqlselect->fetchAll();

?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL ?>css/categoria.css">
</head>
<div class="container">
    <div class="criar">
    <p class="titulo">Criar categoria</p>

    <form class="form" method="POST" action="">
        <label>Nome Categoria:</label>
        <input type="text" name="nome">
        <input class="cadastrar" type="submit" name="acaocadastro" value="Enviar" required>
    </form>
    <?php
            if(isset($sucesso) && $sucesso = true){
                echo "<div style='background-color: #73BE73; padding: 10px; color: white; margin-top: 20px; '><p>Categoria cadastrado com sucesso!</p></div>";
            }
        ?>
    </div>
    <div class="modificar">
        <p class="titulo2">Editar e Excluir categoria</p>
        <div style='margin-top: 20px'>
            <table class='table' width='50%'>
            <tr>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Deletar</th>    
            </tr>
                <?php
                    foreach($fetch as $value){
                        echo "<tr>
                            <td><p class=".$value['id'].">".$value['nome_categoria']."</p></td>
                            <td><button onclick=\"pegaid('{$value['id']}','{$value['nome_categoria']}')\" class='editar'><img class='editar-img' src='".INCLUDE_PATH_PAINEL."/images/lapis-editar.png' width=22px></button></td>
                            <td><button onclick=\"deletar({$value['id']})\" class='deletar'><img class='deletar-img' src='".INCLUDE_PATH_PAINEL."/images/lixeira.png'></button></td>
                        </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
function pegaid(id,nome){
    $('.'+id).replaceWith($('<form id="formulario" method="POST" action=""><input name="novo-nome" type="text" style="height: 22px; font-size: 17px" value='+nome+'><input name="id" type="hidden" value='+id+'></form>'));   
    $(document).keypress(function(e) {
        if(e.which == 13){
            $("#formulario").submit();
        }
    })
} 

function deletar(id){
    var id = id
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
                url: "http://localhost/sistemacompraevenda/painel/categoria",
                data: {deletar: id}
            });
        window.location.href="http://localhost/sistemacompraevenda/painel/categoria";
   
        }
    })
    };
</script>