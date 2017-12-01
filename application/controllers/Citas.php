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
			$elemento = $this->input->post("elemento");
			$fecha_creacion = date("Y-m-d h:i:s");
			$resultado["resultado"] = true;
			$fecha_fin = date("Y-m-d H:i:s",strtotime("+ " . $tiempo_estimado . " hours",strtotime($fecha)));

			$this->Modelo->agregar_reg("cita", array(
				"folio_cita" => "000000",
				"descripcion" => $descripcion,
				"fecha" => $fecha,
				"estatus" => "activo",
				"fecha_creacion" => $fecha_creacion,
				"fecha_fin" => $fecha_fin,
				"dentista_id" => $this->session->userdata("iddentista"),
				"duracion" => $tiempo_estimado,
				"contacto_id" => $id_cliente,
				"producto_id" => $elemento
			));

			if($elemento){
				$this->Modelo->query_no_result("UPDATE producto SET cantidad = cantidad - 1 WHERE idproducto = " . $elemento);
			}
		}
		echo json_encode($resultado);
	}

	public function enviar_editar_cita(){
		$resultado["resultado"] = false;

		if($this->input->post("cliente_id") && $this->input->post("descripcion") && $this->input->post("fecha")){
			$id_cita = $this->input->post("idcita");
			$id_cliente = $this->input->post("cliente_id");
			$descripcion = $this->input->post("descripcion");
			$fecha = $this->input->post("fecha");
			$tiempo_estimado = $this->input->post("tiempo_estimado");
			$elemento = $this->input->post("elemento");
			$fecha_creacion = date("Y-m-d h:i:s");
			$resultado["resultado"] = true;
			$fecha_fin = date("Y-m-d H:i:s",strtotime("+ " . $tiempo_estimado . " hours",strtotime($fecha)));

			$this->Modelo->editar_reg("cita", array(
				"folio_cita" => "000000",
				"descripcion" => $descripcion,
				"fecha" => $fecha,
				"estatus" => "activo",
				"fecha_creacion" => $fecha_creacion,
				"fecha_fin" => $fecha_fin,
				"dentista_id" => $this->session->userdata("iddentista"),
				"duracion" => $tiempo_estimado,
				"contacto_id" => $id_cliente,
				"producto_id" => $elemento
			), "idcita", $id_cita);

			if($elemento){
				$this->Modelo->query_no_result("UPDATE producto SET cantidad = cantidad - 1 WHERE idproducto = " . $elemento);
			}
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

	public function obtener_elementos_inventario(){
	  $resultado["resultado"] = false;
		$elementos_inventario = $this->Modelo->query("SELECT * FROM producto WHERE dentista_id = " . $this->session->userdata("iddentista"));

		if(count($elementos_inventario) > 0){
			$resultado["resultado"] = true;
			$resultado["elementos"] = $elementos_inventario;
		}

		echo json_encode($resultado);
	}

	public function valida_fecha(){
		$resultado["resultado"] = false;
		$tiempo_estimado = $this->input->post("tiempo_estimado");

		$fecha_inicio = $this->input->post("fecha");
		$fecha_fin = date("Y-m-d H:i:s",strtotime("+ " . $tiempo_estimado . " hours",strtotime($fecha_inicio)));

		$dentista_id = $this->session->userdata("iddentista");

		$query = "SELECT * FROM cita ";
		$query .= "WHERE '" . $fecha_inicio . "' >= fecha AND '" . $fecha_inicio . "' <= fecha_fin ";
		$query .= "OR '" . $fecha_fin . "' <= fecha_fin AND '" . $fecha_fin . "' >= fecha ";
		$query .= "AND estatus = 'alta' AND dentista_id = " . $dentista_id;

		$citas =$this->Modelo->query($query);

		if(count($citas) > 0){
			$resultado["resultado"] = true;
		}

		echo json_encode($resultado);
	}

	public function editar_cita(){
		if(!$this->input->get("id")){
			header('location: ' . base_url("index.php/Agenda"));
		}else{
			$cita_id = $this->input->get("id");
			$datos_cita = $this->obtener_datos_cita($cita_id);

			$this->load->view('main_layout_header',array('titulo' => 'Editar Cita', 'nombre' => $this->session->userdata("nombre")));
			$this->load->view('main_layout_nav', array('item' => 0));
			$this->load->view('da_editar_cita', $datos_cita);
			$this->load->view('main_layout_footer');
		}
	}

	public function obtener_datos_cita($cita_id){
	  $resultado = $this->Modelo->query("SELECT * FROM cita WHERE idcita = " . $cita_id);
		// echo $this->db->last_query();
		if(count($resultado) > 0){
			return $resultado[0];
		}else{
			header('location: ' . base_url("index.php/Contactos") . '');
		}
	}
}

// Linked List
// Multprogramacion
// procesos 2o plano

?>
