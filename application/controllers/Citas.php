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
		$this->load->view('main_layout_header',array('titulo' => 'Citas'));
		$this->load->view('main_layout_nav', array('item' => 3));
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

	public function crear_nueva_cita(){
		$resultado["resultado"] = false;

		if($this->input->post("cliente_id") && $this->input->post("descripcion") && $this->input->post("fecha")){
			$id_cliente = $this->input->post("cliente_id");
			$descripcion = $this->input->post("descripcion");
			$fecha = $this->input->post("fecha");
			$fecha_creacion = date("Y-m-d h:i:s");
			$resultado["resultado"] = true;

			$this->Modelo->agregar_reg("cita", array(
				"folio_cita" => "000000",
				"descripcion" => $descripcion,
				"fecha" => $fecha,
				"estatus" => "activo",
				"fecha_creacion" => $fecha_creacion,
				"dentista_id" => 1,
				"contacto_id" => $id_cliente
			));
			echo json_encode($resultado);
		}
	}
}

// Linked List
// Multprogramacion
// procesos 2o plano

?>
