<?php
    session_start();
    
    $autoload = function($class){
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);
    date_default_timezone_set('America/Sao_Paulo');

    define('INCLUDE_PATH','http://localhost/sistemacompraevenda/');
    define('INCLUDE_PATH_PAINEL','http://localhost/sistemacompraevenda/painel/');

    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','estoque');
?>