<?php

class MySQL{

    private static $pdo;

    public static function conectar(){
        if(self::$pdo == NULL){
            try{
            self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 "));
            }catch(Exception $e){
                echo '<h4>Erro ao conectar </h4>';
            }  
        }
        return self::$pdo;
    }
}