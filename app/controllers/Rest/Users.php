<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller
{  

	function __construct()
	{
		parent::__construct();
		$this->load->model("user");
	}

	public function index_get()
	{	
		$data = $this->user->get_all();
		$this->response($data, 200);
	}

	public function index_post()
	{
		$_POST = json_decode(file_get_contents("php://input"));		 
      $is_valid = $this->user->validate();
      if($is_valid == TRUE)
      {
      	$user = $this->user->create($_POST);
      	$user->id = $this->user->save($user);
      	$this->response($user, 200);
      }else{
      	$this->response([
      		"errors" => $is_valid['mensajes'],
      		"msj"    => "No es posible completar el registro del usuario"], 404);	      	
      }
	}

	public function index_put()
	{
		$id = $this->uri->segment(2, 0);
		$_POST = json_decode(file_get_contents("php://input"));		 
      $is_valid = $this->user->validate();
      if($is_valid == TRUE)
      {
      	$user = $this->user->create($_POST, true);
      	$user = $this->user->updated($user, $id);
      	$this->response($user, 200);
      }else{
      	$this->response([
      		"errors" => $is_valid['mensajes'],
      		"msj"    => "No es posible completar el registro del usuario"], 404);
      }
	}

	public function index_delete()
	{
		$id = $this->uri->segment(2, 0);
		if($this->user->destroy($id)){
      	$this->response([
      		"errors" => false,
      		"msj"     => "El registro se borro con éxito"], 200);
		}else{
      	$this->response([
      		"errors" => "",
      		"msj"    => "No es posible remover el registro"], 404);
		}
	}

	public function persona_get()
	{
		$id = $this->uri->segment(3, 0);
		$data = $this->user->get_user_id($id);
		$this->response($data, 200);
	}

}