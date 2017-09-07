<?php
/**
 * Created by PhpStorm.
 * User: Nikita Pavlov
 * Date: 07.09.2017
 * Time: 15:02
 */

class Database{
    private static $dbName = 'crudphp';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if ( self::$cont == null) {
            try {
                self::$cont = new PDO('mysql:host='.self::$dbHost.';dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword);
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}