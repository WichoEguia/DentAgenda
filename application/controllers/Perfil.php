<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Modelo');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper("form");

		if($this->session->userdata("iddentista") == NULL){
			header("Location: " . base_url("index.php/Login/sign_in"));
		}
	}

	public function index(){
		$this->load->view('main_layout_header', array('titulo' => 'Perfil', 'nombre' => $this->session->userdata("nombre")));
		$this->load->view('main_layout_nav', array('item' => 1));
		$this->load->view('main_layout_footer');
	}
}
?>
