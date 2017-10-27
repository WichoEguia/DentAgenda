<?php
  class Modelo extends CI_Model{
    public function __construct(){

      $this->load->database();
    }

    public function query($cadena){
      $query = $this->db->query($cadena);
      return $query->row_array();
    }
  }
?>
