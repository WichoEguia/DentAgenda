<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('main_layout_header', array('titulo' => 'Perfil'));
		$this->load->view('main_layout_nav', array('item' => 1));
		$this->load->view('main_layout_footer');
	}
}
?>
