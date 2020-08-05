<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . "/datasource/helper/helper.php");

    function loadController($controller){
        $path = $_SERVER['DOCUMENT_ROOT'] . "/datasource/controller/" . $controller . "Controller.php";

        if(!file_exists($path))
            die(drawControllerError($controller));
        else {
            require_once($path);
        }
    }

    function loadLogic($file){
        $path = $_SERVER['DOCUMENT_ROOT'] . "/modules/logic/" . $file . ".php";

        if(!file_exists($path))
            die(drawLogicError($file));
        else 
            require_once($path);
    }


    function loadView($folder, $file, $data = null){
        $path = $_SERVER['DOCUMENT_ROOT']."/modules/views/$folder/$file.php";
        
        if(!file_exists($path))
            die(drawAdminViewError($folder, $file));
        else if($data != null){
            extract($data);
            include($path);
        }
        else 
            require_once($path);
 
    }

    function showDatabaseError($error){
        drawDatabaseError($error);
    }

    function requireAjaxHandler($class){
        
        $path = $_SERVER['DOCUMENT_ROOT']."/datasource/controller/ajax/ajaxController.php";
        
        $action = postAction();

        $data = [
            'classPassed'  => $class,
            'actionPassed' => $action
        ];

        extract($data);
        include($path);
    }

    //Draw Functions
    function drawControllerError($controller){
        
        $data = [
            'controller' => $controller
        ];

        extract($data);
        include("errors/controllerNotFound.php");
    }

    function drawLogicError($file){
        
        $data = [
            'file' => $file
        ];

        extract($data);
        include("errors/logicNotFound.php");
    }

    function drawDatabaseError($error){
        extract(getFormatedDBError($error));
        include("errors/database.php");
    }
    
    function drawAdminViewError($folder, $file){
        
        $data = [
            'folder' => $folder,
            'file'   => $file
        ];

        extract($data);
        include("errors/adminViewNotFound.php");
    }

    //Logic functions
    function getFormatedDBError($error){

        $message = "";
        $content = "";

        $conection  = $error->getTrace()[0]['args'][0];
        $host       = explode(';', explode('=', $conection)[2])[0];
        $user       = $error->getTrace()[0]['args'][1];
        $pass       = $error->getTrace()[0]['args'][2];

        switch ($error->getCode()) {
            //Host or Mysql running
            case '2002':
                $message = "Unknown Host";
                $content = "Your host: <b>$host</b><br><br>
                    If you sure your host is correct, verify MySQL is running <br><br>
                ";
            break;

            //Database
            case '1049':
                $message = explode('in', explode(']', $error)[2])[0];
            break;

            //User
            case '1044':
                $message = explode('in', explode(']', $error)[2])[0];
                $content = "<br> Apparently the user: <b>" . $user . "</b> is incorrect <br><br>"; 
            break;

            //Pass
            case '1045':
                $message = explode(' (us', explode('in', explode(']', $error)[2])[0])[0];
                $content = "<br>Apparently the password: <b>" . $pass . "</b> for the user <b>" . $user ."</b> is incorrect<br><br>"; 
            break;

            default:

            break;
        }

        $newError = [
            "message" => $message,
            "content" => $content
        ];

        return $newError;
    }
?>