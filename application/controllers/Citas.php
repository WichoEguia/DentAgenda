<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Modelo');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('session');

		if($this->session->userdata("iddentista") == NULL){
			header("Location: " . base_url("index.php/Login/sign_in"));
		}
	}

	public function nueva_cita(){
		$this->load->view('main_layout_header',array('titulo' => 'Nueva Cita', 'nombre' => $this->session->userdata("nombre")));
		$this->load->view('main_layout_nav', array('item' => 3));
		$this->load->view('da_citas');
		$this->load->view('main_layout_footer');
	}

	public function obtener_clientes(){
		$resultado["resultado"] = false;
		$dentista_id = $this->session->userdata("iddentista");
		$clientes = $this->Modelo->query("SELECT * FROM contacto WHERE dentista_id = '" . $dentista_id . "' AND estatus = 'activo'");
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
			$tiempo_estimado = $this->input->post("tiempo_estimado");
			$fecha_creacion = date("Y-m-d h:i:s");
			$resultado["resultado"] = true;

			$this->Modelo->agregar_reg("cita", array(
				"folio_cita" => "000000",
				"descripcion" => $descripcion,
				"fecha" => $fecha,
				"estatus" => "activo",
				"fecha_creacion" => $fecha_creacion,
				"dentista_id" => $this->session->userdata("iddentista"),
				"duracion" => $tiempo_estimado . "horas",
				"contacto_id" => $id_cliente
			));
		}
		echo json_encode($resultado);
	}

	public function obtener_foto_perfil(){
		$resultado["resultad"] = false;
		$idcontacto = $this->input->post("idcontacto");

		$contacto = $this->Modelo->query("SELECT * FROM contacto WHERE idcontacto = " . $idcontacto);
		if(count($contacto) > 0){
			$resultado["resultado"] = true;
			$resultado["path_foto"] = $contacto[0]->foto;
		}

		echo json_encode($resultado);
	}
}

// Linked List
// Multprogramacion
// procesos 2o plano

?>
