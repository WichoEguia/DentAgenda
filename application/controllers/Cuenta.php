<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	public function index(){
		$this->load->helper('url');
		$this->load->view('main_layout_header');
		$this->load->view('main_layout_nav');
		$this->load->view('main_layout_footer');
	}
}
