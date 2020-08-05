<?php
define("HOSTNAME", "127.0.0.1");
define("DATABASE", "test"); 
define("USERNAME", "root");  
define("PASSW", '');  
//---------------------------------//

class PDOconection {

    private static $conexion = null;
    private static $pdo;

    final private function __construct() {
        try {
            self::getDb();
        } catch (Exception $e) {
            
            die(showDatabaseError($e));
        }
    }

    public static function getInstance() {
        if (self::$conexion === NULL) {
            self::$conexion = new self();
        }
        return self::$conexion;
    }

    public function getDb() {
        if (self::$pdo == NULL) {
            self::$pdo = new PDO(
                    "mysql:dbname=" . DATABASE . 
                    ";host=" . HOSTNAME . 
                    ";port:63343;" , 
                    USERNAME, 
                    PASSW, 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    final protected function __clone() {
        
    }

    function __destruct() {
        self::$pdo = NULL;
    }
}