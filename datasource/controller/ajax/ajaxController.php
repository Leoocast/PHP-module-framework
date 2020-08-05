<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/arkcms/admin/includes/helper/helper.php");

    if (!function_exists ('start' )){
        function start($class, $action){

            if ($action != "") 
                $class->$action();
        
        }
    } 

    start($classPassed, $actionPassed);

?>