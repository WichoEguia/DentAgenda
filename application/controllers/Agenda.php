<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Agenda extends CI_Controller {
    public function __construct(){
      parent::__construct();

      $this->load->model('Modelo');
  		$this->load->helper('url');
  		$this->load->database();
  		$this->load->library('session');
    }

    public function index(){
      $this->load->view('main_layout_header', array('titulo' => 'Agenda'));
  		$this->load->view('main_layout_nav', array('item' => 5));
  		$this->load->view('da_agenda');
  		$this->load->view('main_layout_footer');
    }

    public function traer_eventos(){
      $resultado["resultado"] = false;
      $hoy = date("Y-m-d h:i:s");
      $citas = $this->Modelo->query("SELECT * FROM cita JOIN contacto ON (cita.contacto_id = contacto.idcontacto) WHERE cita.dentista_id = 1 AND cita.fecha > '" . $hoy . "' ORDER BY cita.fecha_creacion ASC");
      // echo var_dump($citas);

      if(count($citas) > 0){
        $resultado["resultado"] = true;
        $resultado["citas"] = $citas;
      }
      echo json_encode($resultado);
    }
  }
?>
