<?php 
loadController('viajes');
    
function GetViajes(){
    
    $class = new ViajesController();
    $viajes = $class->GetAll();
  
    return $viajes;
}
?>