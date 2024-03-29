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
        <input type="text" name="nome" required>
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
                <th class="coluna-categoria">Categoria</th>
                <th>Editar</th>
                <th>Deletar</th>    
            </tr>
                <?php
                    foreach($fetch as $value){
                    echo "<tr>
                            <td id=".$value['id']." class='coluna-categoria'>".$value['nome_categoria']."</td>
                            <td><button class='editar' onclick=\"montaForm(this,'{$value['id']}','{$value['nome_categoria']}')\"><img class='editar-img' src='".INCLUDE_PATH_PAINEL."/images/lapis-editar.png' width=22px></button></td>
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
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1300,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

function montaForm(e,id,nome){
    Toast.fire({
        icon: 'info',
        title: 'Pressione ENTER para enviar!'
    })

    
    $('#'+id).html('<form id="formulario" style="display: inline-block" method="POST" action=""><input name="novo-nome" type="text" style="height: 22px; font-size: 17px" value=\"'+nome+'\"><input name="id" type="hidden" value='+id+'></form>').find('input').focus();   
    $(e).prop('disabled', true);

    $(document).on('mousedown', (event)=>{
        if(!$(event.target).closest('#formulario').length){
            $('#'+id).text(nome);
            $(e).prop('disabled', false);
        }
    })
}

function deletar(id){
    var id = id
        Swal.fire({
            text: 'Você deseja excluir o usuário selecionado?',
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