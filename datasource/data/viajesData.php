<?php 
// session_start();
require($_SERVER['DOCUMENT_ROOT'] . "/datasource/data/Ark.php");

class ViajesData extends ArkFramework {
     
    private $table;
    private $uri;
    private $fields;
    
    function __construct(){
        $this->table  = 'Viajes';
        $this->fields = ['IdViaje', 'Descr'];
    }
    
    public function GetAll(){
        return $this->GetTable($this->table);
    }
  }
?>