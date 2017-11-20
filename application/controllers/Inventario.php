<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {
	public function index(){
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Inventario'));
		$this->load->view('main_layout_nav', array('item' => 4));
		$this->load->view("da_inventario");
		$this->load->view('main_layout_footer');
	}
}
?>
