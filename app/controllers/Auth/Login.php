<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("user");
	}

	public function render($content="", $title="")
	{
		$data = ["title" => $title, "content" => $content];
		$this->parser->parse('layout/logeo', $data);
	}

	public function index()
	{
		$content = $this->load->view('auth/login', "", true);
		$this->render($content, "Login");
	}

	//Crear la sesion de usuario
	public function create()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$user = $this->user->user_session_validate($email, $password);
		if($user){
			$this->session->set_userdata([
				"in_session" => true,
				"username"   => $user->nombres.' '.$user->apellidos,
				"email"      => $email,
				"id"         => $user->id
			]);
			$this->session->set_flashdata("result",
				["status"  => 200,
				"response" => "El usuario ha ingresado con éxito."]);
			redirect("personas");
			exit();
		}else{
			$this->session->set_flashdata("result",
				["status"  => 404,
				"response" => "No es posible el ingreso al usuario los parametros no poseen coincidencias."]);
			redirect("login");
			exit();
		}
	}

	public function logout()
	{
		$this->session->unset_userdata(["in_session","username","email", "id"]);
		redirect("login");
		exit();
	}

}