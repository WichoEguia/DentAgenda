<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactos extends CI_Controller {
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
		$this->load->view('main_layout_header', array('titulo' => 'Contactos'));
		$this->load->view('main_layout_nav', array('item' => 2));
		$this->load->view('da_ver_contacto');
		$this->load->view('main_layout_footer');
	}

	public function nuevo_contacto(){
		$this->load->helper('url');
		$this->load->view('main_layout_header', array('titulo' => 'Nuevo Contacto'));
		$this->load->view('main_layout_nav', array('item' => 0));
		$this->load->view("da_agregar_contacto");
		$this->load->view('main_layout_footer');
	}

	public function alta_contacto(){
		$folio = $this->input->post("folio_contacto");
		$nombre = $this->input->post("nombre_contacto");
		$email = $this->input->post("email_contacto");
		$telefono = $this->input->post("telefono_contacto");
		$telefono_secundario = $this->input->post("telefono_secundario_contacto");
		$tipo = $this->input->post("tipo_contacto");
		$alergias = $this->input->post("alergias_contacto");
		$sexo = $this->input->post("sexo_contacto");
		$foto_contacto = $this->input->post("foto_contacto");

		$config['upload_path']          = './assets/uploads/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 4096;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;
		$config["file_name"]						= "imagen_perfil-" . time();

    $this->load->library('upload', $config);
		$this->upload->do_upload('foto_contacto');
		$image_data = $this->upload->data();
		echo var_dump($image_data["file_name"]);
		echo $this->upload->display_errors();

		$foto_path = base_url("assets/uploads/" . $image_data["file_name"]);

		$this->Modelo->agregar_reg("contacto",array(
			"folio" => $folio,
			"nombre" => $nombre,
			"email" => $email,
			"telefono_principal" => $telefono,
			"telefono_auxiliar" => $telefono_secundario,
			"tipo_contacto" => $tipo,
			"activar_recordatorios" => "no",
			"estatus" => "activo",
			"alergias" => $alergias,
			"sexo" => $sexo,
			"foto" => $foto_path,
			"dentista_id" => $this->session->userdata("iddentista")
		));

		header("Location: " . base_url("index.php/Contactos/nuevo_contacto"));
	}

	public function obtener_contactos(){
		$resultado["resultado"] = false;
		$dentista_id = $this->session->userdata("iddentista");
		$contactos = $this->Modelo->query("SELECT * FROM contacto WHERE dentista_id = " . $dentista_id . " AND estatus = 'activo'");

		if(count($contactos) > 0){
			$resultado["resultado"] = true;
			$resultado["contactos"] = $contactos;
		}

		echo json_encode($resultado);
	}

	public function baja_contacto(){
		$resultado["resultado"] = false;

		if($this->input->post("contacto_id")){
			$resultado["resultado"] = true;

			$contacto_id = $this->input->post("contacto_id");
			$this->Modelo->query_no_result("UPDATE contacto SET estatus = 'baja' WHERE idcontacto = " . $contacto_id);
		}

		echo json_encode($resultado);
	}
}
?>
