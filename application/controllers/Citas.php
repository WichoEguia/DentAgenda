<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Modelo');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('main_layout_header');
		$this->load->view('main_layout_nav');
		$this->load->view('da_citas');
		$this->load->view('main_layout_footer');
	}

	public function obtener_clientes(){
		$resultado["resultado"] = false;
		$clientes = $this->Modelo->query("SELECT * FROM contacto WHERE dentista_id = 1 AND tipo_contacto = 'cliente' AND estatus = 'activo'");
		// echo var_dump($clientes);

		if(count($clientes) > 0){
			$resultado["resultado"] = true;
			$resultado["clientes"] = $clientes;
		}

		echo json_encode($resultado);
	}
}

// Linked List
// Multprogramacion
// procesos 2o plano
