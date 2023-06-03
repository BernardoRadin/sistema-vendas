<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

if(isset($_POST['deletar'])){
    $id = $_POST['deletar'];
    $sql_editar = MySQL::conectar()->prepare("DELETE FROM `clientes` WHERE `id` = (?)");
    $sql_editar->execute(array($id));
}

if(isset($_POST['editar_acao'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $datanasc = $_POST['datanasc'];
    $datanasc = date('Y/m/d', strtotime($datanasc));
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql_editar = MySQL::conectar()->prepare("UPDATE `clientes` SET `nome` = (?),`datanasc` = (?), `cpf` = (?), `email` = (?), `telefone` = (?) WHERE `id` = (?)");
    $sql_editar->execute(array($nome,$datanasc,$cpf,$email,$telefone,$id));
}

$sql = MySQL::conectar()->query("SELECT * FROM `clientes`");
$result = $sql->fetchAll();
    
?>
<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL?>css/listar-clientes.css">
</head>
<div class="container">
    <p class="titulo">Listar Clientes</p>
    <div class="center">
    <table class="table">
        <th>Nome</th>
        <th>Data Nascimento</th>
        <th>CPF</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Editar</th>
        <th>Deletar</th>
    <?php
    foreach($result as $value){
        echo
        "<tr>
            <td class='p-nome'>".$value['nome']."</td>
            <td>".date('d/m/Y', strtotime($value['datanasc']))."</p>
            <td>".$value['cpf']."</td>
            <td>".$value['email']."</td>
            <td>".$value['telefone']."</td>
            <td><button onclick=\"pegaid('{$value['id']}','{$value['nome']}','{$value['datanasc']}','{$value['cpf']}','{$value['email']}','{$value['telefone']}')\" class='editar-button'><img class='editar-img' src='".INCLUDE_PATH_PAINEL."/images/lapis-editar.png' width=22px></button></td>
            <td><button onclick=\"deletar({$value['id']})\" class='deletar'><img class='deletar-img' src='".INCLUDE_PATH_PAINEL."/images/lixeira.png'></button></td>
        </tr>";
        }
    ?>
    </table>
    <div class="clear"></div>
    </div>
</div>
<script>
    function pegaid(id,nome,datanasc,cpf,email,telefone){
        $('.caixa-meio').append(
                '<form id="formulario" method="POST" action=""><input type="hidden" name="id" value='+id+'><label>Nome: </label><br><input type="text" name="nome" value=\"'+nome+'\" required></select><br><label>Data Nascimento:</label><br><input type="text" name="datanasc" value=\"'+datanasc+'\" required><br><label>CPF: </label><br><input type="text" name="cpf" value='+cpf+' required><br><label>Email:</label><br><input type="text" name="email" value='+email+' required><br><label>Telefone: </label><br><input type="text" name="telefone" value=\"'+telefone+'\" required><br><br><input type="submit" class="editar" name="editar_acao" value="Editar"><br><br></form>')
        $('.container2').css('display', 'block')
        $('.caixa').slideDown()
        $(".caixa-meio").slideDown();

        $('.container2').click(function() {
            $('.container2').css('display', 'none');
            $('.caixa').css('display', 'none');
            $(".caixa-meio").empty()
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
                url: "http://localhost/sistemacompraevenda/painel/listar-clientes",
                data: {deletar: id}
            });
        window.location.href="http://localhost/sistemacompraevenda/painel/listar-clientes";
   
        }
})
    };
</script>