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
		$this->load->view("da_perfil");
		$this->load->view('main_layout_footer');
	}

	public function obttener_datos_perfil(){
		$rsultado["resultado"] = false;

		if($this->session->userdata("iddentista")){
			$iddentista = $this->session->userdata("iddentista");
			$dentista = $this->Modelo->query("SELECT * FROM dentista WHERE iddentista = " . $iddentista);

			if(count($dentista) > 0){
				$resultado["resultado"] = true;

				$resultado["dentista"] = $dentista[0];
				$resultado["no_pacientes"] = $this->no_pacientes($iddentista);
				$resultado["no_citas"] = $this->no_citas($iddentista);
				$resultado["no_citas_hoy"] = $this->no_citas_hoy($iddentista);
				$resultado["no_citas_manana"] = $this->no_citas_manana($iddentista);
			}
		}

		echo json_encode($resultado);
	}

	public function no_pacientes($iddentista){
		$clientes = $this->Modelo->query("SELECT * FROM contacto WHERE dentista_id = " . $iddentista);
		return count($clientes);
	}

	public function no_citas($iddentista){
	  $citas = $this->Modelo->query("SELECT * FROM cita WHERE dentista_id = " . $iddentista);
		return count($citas);
	}

	public function no_citas_hoy($iddentista){
		$hoy = date("Y-m-d h:i:s");

	  $citas = $this->Modelo->query("SELECT * FROM cita WHERE fecha LIKE '%" . substr($hoy, 10, 9) . "%' AND dentista_id = " . $iddentista);
		return count($citas);
	}

	public function no_citas_manana($iddentista){
		$mañana = strtotime("+ 1 day", strtotime(date("Y-m-d h:i:s")));

	  $citas = $this->Modelo->query("SELECT * FROM cita WHERE fecha = '" . substr($mañana, 10, 9) . "' AND dentista_id = " . $iddentista);
		return count($citas);
	}
}
?>
