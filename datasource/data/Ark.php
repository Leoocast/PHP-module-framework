<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/datasource/config/pdo.php");

/**
    * Leo (Arklight) Castellanos - 2019
*/
class ArkFramework {

    /**
    * Function to get json, full table, by id or by column
    * @param table {object} The table
    * @param selector {string} The id or column name of the table
    * @param selectorValue {string} The id or column value
    */
    public function GetTable($table, $selector = null, $selectorValue = null ){
    
        $query ="";
        
        if ($selectorValue == null || $selector == null)
            $query = "select * from " . $table;
            else 
            $query = "select * from " . $table . " where " . $selector . " = " . $selectorValue;
        
            return $this->ExecuteQuery($query, "get");
    }

    public function GetAllStatment($table, $statment){
    
        $query = "select * from " . $table . " " . $statment;
        
        return $this->ExecuteQuery($query, "get");
    }

    /**
    * Function to get json, limit table
    * @param table {object} The table
    * @param limit {int} Limit of the query
    */
    public function GetLimit($table, $limit = null ){
    
        $query = "select * from " . $table . " LIMIT " . $limit;
        
        return $this->ExecuteQuery($query, "get");
    }

    /**
    * Function to add an entry
    * @param table {object} The table
    * @param fields {object} The fields of the table
    * @param data {object} The data to insert
    */
    public function SetTableData($data, $table){
        
        $sql = "INSERT INTO ". $table . "(";
        
        //Adding values
        foreach ($data as $key => $value) {
            $sql .= $key . ", ";
        }

        //Deleting the last coma
        $sql = substr ( $sql , 0 , strlen ( $sql ) - 2 ) . ") values (";

        //Adding parameters
        for ($i = 0; $i < count ( $data ); $i++) {
            $sql .= "?" . ", ";
        }
        
        //Deleting last coma
        $sql = substr ( $sql , 0 , strlen ( $sql ) - 2 ) . ")";
        
        $send = [];

        foreach ($data as $key => $value) {
            array_push($send, $value);
        }

        return $this->ExecuteQuery($sql, "add", $send);

    }

        /**
    * Function to update an entry
    * @param table {object} The table
    * @param fields {object} The fields of the table
    * @param data {object} The data to insert
    * @param selector {object} Update selector
    */
    public function Update($table, $data, $selector, $selectorValue){
        
        $sql = "UPDATE " . $table . " set ";

            //Adding values
        foreach ($data as $key => $row) {
            $sql .= $key . "=";
            
            $type = gettype($row);
            
            if ($type == "string") 
            $sql .= "'$row'";
            else
            $sql .= $row;
            
            $sql .= ", ";
        }

        //Deleting the last coma
        $sql = substr ( $sql , 0 , strlen ( $sql ) - 2 ) . " where " . $selector . "=$selectorValue";

        return $this->ExecuteQuery($sql, "update");
    }
    
        /**
    * Function to delete an entry
    * @param table {object} The table
    * @param selector {string} The id or column name of the table
    * @param selectorValue {string} The id or column value
    */
    public function DeleteTableData($table, $selector, $selectorValue){

        $sql = "delete from " . $table . " where " . $selector . " = " . $selectorValue;

        return $this->ExecuteQuery($sql, "del");
    }

    /**
    * Function to get a custom query
    * @param query {object} The custom query
    */
    public function GetQuery($query){
                
        return $this->ExecuteQuery($query);

    }

    public function SetQuery($query){
                
        return $this->ExecuteQuery($query, 'del');

    }

    /**
    * Function to control all methods
    * @param query {object} Query to execute
    * @param type {object} Type of action
    * @param data {object} Data to insert
    */
    public static function ExecuteQuery($query, $type = "", $data = null){

            try {
        
            $command = PDOconection::getInstance()->getDb()->prepare($query);
            $result = "";

            switch($type){
                
                case "add":
                case "del":
                    $command->execute($data);
                    $result = array('status' => true);
                break;

                case "update":
                    $command->execute();
                    $result = array('status' => true);
                break;
                
                case "get":
                case "":
                    $command->execute();
                    $result = $command->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($result)) 
                    $result = "no_data";
                break;
            }
            
            return $result;

        } catch(Exception $ex) {             
            
            $error = array(
                "status"  => false,
                "Query"   => $query,
                "Code"    => $ex->getCode(),
                "Line"    => $ex->getLine(),
                "File"    => $ex->getFile(),
                "Message" => $ex->getMessage()
            );

            return $error;    
        }
    }
}

class Response 
{
    public $status;
    public $message;

    function __construct($_status, $_message){
        $this->status = $_status;
        $this->message = $_message;
    }
}
