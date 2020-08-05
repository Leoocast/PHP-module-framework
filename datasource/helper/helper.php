<?php

function post() {
    unset($_POST['action']);
    return (object)$_POST;
}

function postAction() {
    return @$_POST['action'];
}

function debug($array, $title = "") {
    if ($title != "") {
        echo "$title: <pre> "; 
    } else {
        echo "<pre>";
    }
    print_r($array); echo "</pre>";
}

function redirect($result, $uri){
    if (isset($result['status'])) {
        header("Location: ../../$uri.php?success");
    } else {
        echo "<h3> Ups! Something happen :(, let's see: </h3>";
        debug($result); return;
    }
}

function redirectValidation($message, $uri){
    $arrayMessage = explode(" ", $message);
    $newMessage   = implode("_", $arrayMessage); 
    header("Location: ../../$uri.php?$newMessage");
}

function validateFields($fields, $post, $debugging = false){

    $helper = new stdClass();
    
    if ($debugging) {
        $helper->status = true;
        return $helper;
    }
    
    $error = false;
    $field = "";

    foreach ($post as $key => $value) {
        foreach ($fields as $_key => $_field) {
            if ($key == $_field && $value == "") {
                $field = $_field;
                $error = true;
                break;
            }
        }
    }

    if ($error) {
        $helper->status = false;
        $helper->message = "<h3>The field <b>$field</b> cannot be empty</h3>";
    } else {
        $helper->status = true;
    }

    return $helper;
   
}

function Action($class, $action = "", $limit = ""){

    if(isset($_POST["action"])) {
    
      switch($_POST["action"]){
              
        case "add":
            $class->Add();
        break;
          
        case "get":
            $class->Get();
        break;   
        
        case "update":
            $class->Update();    
        break;

        case "login":
            $class->Login();    
        break;

        case "logout":
            $class->Logout();    
        break;
                      
        case "delete":
            $class->Delete();
        break;

        case "custom":
            $class->Query();
        break;
    }
  } else if(isset($_GET["action"])) {
    
    switch($_GET["action"]){
            
      case "add":
          $class->Add();
      break;
        
      case "get":
          $class->Get();
      break;   
      
      case "update":
          $class->Update();    
      break;

      case "approveComment":
        $class->approveComment();    
      break;

      case "unapproveComment":
        $class->unapproveComment();    
      break;
                    
      case "delete":
          $class->Delete();
      break;

      case "custom":
          $class->Query();
      break;
  }
    } else {
    switch($action){
              
        case "add":
            $class->Add();
        break;

        case "getAll":
            return $class->GetAll();
        break;   
          
        case "get":
            $class->Get();
        break;   
        
        case "update":
            $class->Update();    
        break;
                      
        case "delete":
            $class->Delete();
        break;

        case "custom":
            $class->Query();
        break;

        case "limit":
            return $class->GetLimit($limit);
        break;
        
    }
  }
}

function RequireData($dataName, $isPrimary = false){
    
    $dataName = !$isPrimary ? $dataName . 'Data' : $dataName; 

    $path = $_SERVER['DOCUMENT_ROOT'] . "/web/datasource/data/$dataName.php";

    if(!file_exists($path))
        echo "$dataName not found, please check -> 'datasource/data/'";
    else 
        require_once($path);
}

function makeSelect($array, $id, $value, $name, $selected = null){
    echo '<select class="select2 form-control" name="'. $name . '" id="'.$name.'">';
    echo '<option selected value="0">Select '. $name . '</option>';

    foreach ($array as $i => $arrayValue) 
    
    if ($selected != null) 
        if ($arrayValue[$id] == $selected)
            echo '<option selected value="' . $arrayValue[$id] . '">'. $arrayValue[$value] .'</option>'; 
        else
            echo '<option value="' . $arrayValue[$id] . '">'. $arrayValue[$value] .'</option>';
    else
        echo '<option value="' . $arrayValue[$id] . '">'. $arrayValue[$value] .'</option>';

    echo "</select>";
}

function uploadFile($url, $name){
    if (isset($_FILES[$name])) {
        
        $target = $url.basename($_FILES[$name]['name']);

        if (move_uploaded_file($_FILES[$name]['tmp_name'], $target)) {
            return true;
        } else {
            return false;
        }
    }
}

function issetGET($variable){
    return isset($_GET[$variable]) ? true : false;
}

function issetPOST($variable){
    return isset($_POST[$variable]) ? true : false;
}

function get() {
    return (object)$_GET;
}

function manageLogin(){
    if (isset($_SESSION['login'])) 
        return $_SESSION['login'];
    else 
        header('Location: ../login.php');
}