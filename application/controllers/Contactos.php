<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactos extends CI_Controller {
	public function index(){
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Contactos'));
		$this->load->view('main_layout_nav', array('item' => 2));
		$this->load->view('main_layout_footer');
	}
}
?>
