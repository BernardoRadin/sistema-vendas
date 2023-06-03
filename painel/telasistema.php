<?php
if(isset($_GET['loggout'])){
    Painel::loggout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL; ?>css/sistemaestilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <div class="container2" style="display: none"></div>
    <div class="caixa" style="display: none">
        <div class="caixa-meio" style="display: none">
        </div>
    </div>
    <div class="menu">
        <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><h1 class="titulo-menu">MENU</h1></a>
        <div class="div-titulo"><h3 class="espacar-coluna">PRODUTOS</h3></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>cadastrar-produtos">Cadastrar Produtos</a></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>listar-produtos">Listar Produtos</a></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>relatorio-compras">Relatório de compras</a></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>categoria">Criar / Modificar Categorias</a></div>
        <div class="div-titulo"><h3 class="espacar-coluna">CLIENTES</h3></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>cadastrar-clientes">Cadastrar Clientes</a></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>listar-clientes">Listar Clientes</a></div>
        <div class="div-titulo"><h3 class="espacar-coluna">VENDAS</h3></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>realizar-venda">Realizar Venda</a></div>
        <div class="espaco"><a href="<?php INCLUDE_PATH_PAINEL;?>listar-vendas">Listar Vendas</a></div>
    </div>
    <header class="header">
        <div class="topo">
            <img class="menu-icon" src="<?php echo INCLUDE_PATH_PAINEL?>images/menu.png">
            <div class="loggout">
                <a href="<?php echo INCLUDE_PATH_PAINEL?>?loggout"><img src="<?php echo INCLUDE_PATH_PAINEL; ?>images/loggout.png"></a>
                <a class="sair" href="<?php echo INCLUDE_PATH_PAINEL?>?loggout">Sair</a>
            </div>
        </div>
    </header>
    <div class="clear"></div>
    <div class="content">
        <div class="content-conteudo">
            <div class="content-load">
                <?php Painel::carregapagina()?>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL?>js/menusistema.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL?>js/load-menu.js"></script>
</body>
</html>