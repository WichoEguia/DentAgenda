<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactos extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Modelo');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library("upload");

		if($this->session->userdata("iddentista") == NULL){
			header("Location: " . base_url("index.php/Login/sign_in"));
		}
	}

	public function index(){
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Contactos'));
		$this->load->view('main_layout_nav', array('item' => 2));
		$this->load->view('main_layout_footer');
	}

	public function nuevo_contacto(){
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Nuevo Contacto'));
		$this->load->view('main_layout_nav', array('item' => 0));
		$this->load->view("da_agregar_contacto");
		$this->load->view('main_layout_footer');
	}
}
?>
