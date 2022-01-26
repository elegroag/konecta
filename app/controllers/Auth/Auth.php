<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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

	public function register()
	{
		$content = $this->load->view('auth/register', "", true);
		$this->render($content, "Register");
	}

	//Crear el registro de usuario
	public function create()
	{
      $is_valid = $this->user->validate();
      if($is_valid == TRUE)
      {
      	$password = $this->user->encript_password($this->input->post("password"), $this->input->post("email"));
			$data = array(
				"email"     => $this->input->post("email"),
				"password"  => $password,
				"nombres"   => $this->input->post("nombres"),
				"apellidos" => $this->input->post("apellidos"));			
      	$user = $this->user->create($data);      	
      	if($user){
      		$user->id = $this->user->save($user);
				$this->session->set_userdata(array(
					"in_session" => true,
					"username"   => $user->nombres.' '.$user->apellidos,
					"email"      => $email,
					"id"         => $user->id
				));
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
      }else{
      	$this->session->set_flashdata("result", [
				"errors"   => $is_valid['mensajes'],
				"status"   => 404, 
				"response" => "No es posible el ingreso al usuario los parametros no poseen coincidencias."]);
				redirect("login");
      }
	}

}