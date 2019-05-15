<?php

/**
 * Created by PhpStorm.
 * User: Kelvin
 * Date: 09/01/2017
 * Time: 16:28
 */
class Conexao
{
    // private static $User = 'datececo_senai';
    // private static $Pass = 'datesenai';
    // private static $Host = 'localhost';
    // private static $DB = 'datececo_cecoteg';
    // private static $PDO = null;

    private static $User = 'root';
    private static $Pass = '';
    private static $Host = 'localhost';
    private static $DB = 'date';
    private static $PDO = null;

    private static function PDO()
    {
        $dsn = 'mysql:host='.self::$Host.';dbname='.self::$DB;
        $Options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');

        // Conexão PDO
        self::$PDO = new PDO($dsn, self::$User, self::$Pass, $Options);

        // Para debugar com exceções
        self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$PDO;
    }

    // Conexão para as classes filhas
    protected function getPDO()
    {
        return self::PDO();
    }
}
