<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
    $this->load->library("session");
    $this->load->model("Modelo");

		if($this->session->userdata("iddentista") != NULL){
			header("Location: " . base_url("index.php/Perfil"));
		}
	}

	public function sign_up(){
		$this->load->view("login_layout_header");
    $this->load->view("da_signup");
    $this->load->view("login_layout_footer");
	}

  public function valida_datos_no_existentes(){
    $resultado["resultado"] = true;
    $email = $this->input->post("email");

    $res = $this->Modelo->query("SELECT * FROM dentista WHERE email = '" . $email . "'");
    if(count($res) > 0){
      $resultado["resultado"] = false;
    }

    echo json_encode($resultado);
  }

  public function crear_usuario(){
    $resultado["resultado"] = false;
    if($this->input->post("email") && $this->input->post("nombre") && $this->input->post("password")){
      $this->Modelo->agregar_reg("dentista",array(
        "email" => $this->input->post("email"),
        "nombre" => $this->input->post("nombre"),
        "password" => sha1($this->input->post("password")),
				"foto" => base_url("assets/img/perfil_da.jpg")
      ));

      $this->crear_sesion($this->db->insert_id(), $this->input->post("email"), $this->input->post("nombre"), base_url("assets/img/perfil_da.jpg"));
      $resultado["resultado"] = true;
    }

    echo json_encode($resultado);
  }

  public function crear_sesion($iddentista, $email, $nombre, $foto){
    $userdata = array(
      "iddentista" => $iddentista,
      "email" => $email,
      "nombre" => $nombre,
			"foto" => $foto
    );

    $this->session->set_userdata($userdata);
  }

  public function sign_in(){
		$this->load->view("login_layout_header");
    $this->load->view("da_signin");
    $this->load->view("login_layout_footer");
	}

  public function inciar_sesion(){
    $resultado["resultado"] = false;
    $email = $this->input->post("email");
    $password = sha1($this->input->post("password"));
		// echo $password;

    $usuario = $this->Modelo->query("SELECT * FROM dentista WHERE email = '" . $email . "' AND password = '" . $password . "'");
    if(count($usuario) == 1){
      $resultado["resultado"] = true;
      $usuario = $usuario[0];

      $this->crear_sesion($usuario->iddentista,$usuario->email,$usuario->nombre,$usuario->foto);
      $resultado["session"] = $this->session->userdata();
    }

    echo json_encode($resultado);
  }

	public function salir(){
		$this->session->unset_userdata(array("iddentista","email","nombre"));
		header("Location: " . base_url("index.php/Login/sign_in"));
	}
}
?>
