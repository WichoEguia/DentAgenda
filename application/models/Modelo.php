<?php
  class Modelo extends CI_Model{
    public function query(cadena){
      return $query->result(cadena)
    }
  }
?>
