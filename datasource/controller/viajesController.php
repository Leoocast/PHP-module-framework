<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/datasource/data/viajesData.php");

class ViajesController extends ViajesData {

  public function GetViajes(){
      return $this->GetAll();
  }
}

$ViajesController = new ViajesController();
?>