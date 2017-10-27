<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Modelo');
		$this->load->helper('url');
		$this->load->database();
	}

	public function index(){
		// $this->Modelo->query('DROP DATABASE dentagenda');
		$clientes = $this->Modelo->query('SELECT * FROM contacto WHERE tipo_contacto = "cliente"');
		// echo var_dump(count($clientes));
		if(count($clientes) == 0){
			$this->Modelo->query('DROP DATABASE dentagenda');
		}
	}

	public function nueva_cita(){
		$this->load->view('main_layout_header');
		$this->load->view('main_layout_nav');
		$this->load->view('da_citas');
		$this->load->view('main_layout_footer');
	}
}

// Linked List
// Multprogramacion
// procesos 2o plano
