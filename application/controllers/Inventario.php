<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {
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
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Inventario', 'nombre' => $this->session->userdata("nombre")));
		$this->load->view('main_layout_nav', array('item' => 5));
		$this->load->view("da_inventario");
		$this->load->view('main_layout_footer');
	}

	public function obtener_elementos(){
		$resultado["resultado"] = false;
		$dentista_id = $this->session->userdata("iddentista");
		$productos = $this->Modelo->query("SELECT * FROM producto WHERE dentista_id = " . $dentista_id);

		if(count($productos) > 0){
			$resultado["resultado"] = true;
			$resultado["productos"] = $productos;
		}

		echo json_encode($resultado);
	}

	public function nuevo_producto(){
		$this->load->view('main_layout_header', array('titulo' => 'Nuevo Producto', 'nombre' => $this->session->userdata("nombre")));
		$this->load->view('main_layout_nav');
		$this->load->view("da_productos");
		$this->load->view('main_layout_footer');
	}

	public function crear_producto(){
		$resultado["resultado"] = false;
		if($this->input->post("nombre") && $this->input->post("descripcion") && $this->input->post("cantidad") && $this->input->post("restock")){
			$resultado["resultado"] = true;
			$nombre = $this->input->post("nombre");
			$descripcion = $this->input->post("descripcion");
			$cantidad = $this->input->post("cantidad");
			$restock = $this->input->post("restock");

			$this->Modelo->agregar_reg("producto", array(
				"folio" => $this->crear_folio(),
				"nombre" => $nombre,
				"descripcion" => $descripcion,
				"cantidad" => $cantidad,
				"restock" => $restock,
				"dentista_id" => $this->session->userdata("iddentista")
			));
		}

		echo json_encode($resultado);
	}

	public function crear_folio(){
		$folio = "";
		for($i=0;$i<4;$i++){
			$folio .= rand(0, 9);
		}

		return $folio;
	}
}
?>
