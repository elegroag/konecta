<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Productos extends REST_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array("producto"));
	}

	public function index_get()
	{
		$data = $this->persona->get_all();
		$this->response($data, 200);
	}

	public function index_post()
	{
		$data = json_decode(file_get_contents("php://input"));
		$insert = [
				"documento"     => $data->documento,
				"email"         => $data->email,
				"nombres"       => $data->nombres,
				"apellidos"     => $data->apellidos,
				"municipios_id" => $data->municipios_id
		];
		$persona = $this->persona->create($insert);
		if($persona){
			$persona = $this->persona->save($persona);
			$this->response(["model" => $persona, "state"=>200]);
		}else{
			$this->response([
				"msj"=>"No es posible completar el registro del usuario"], 404);
		}
	}

	public function index_put()
	{
		$id = $this->uri->segment(2, 0);
		$data = json_decode(file_get_contents("php://input"));
		$values = [
				"documento"     => $data->documento,
				"email"         => $data->email,
				"nombres"       => $data->nombres,
				"apellidos"     => $data->apellidos,
				"municipios_id" => $data->municipios_id
		];
			$persona = $this->persona->create($values, true);
		if($persona){
			if($this->persona->updated($persona, $id)){
				$this->response(["model" => $persona]);
			}else{
				$this->response([
				"msj"=> "No es posible completar el registro del usuario"], 404);
			}
		}else{
			$this->response([
				"msj"=> "No es posible completar el registro del usuario"], 404);
		}
	}

	public function index_delete()
	{
		$id = $this->uri->segment(2, 0);
		if($this->persona->destroy($id)){
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
		$persona = $this->persona->get_use_id($id);
		$this->response($persona, 200);
	}

}	$values = [
	"documento"     => $data->documento,
	"email"         => $data->email,
	"nombres"       => $data->nombres,
	"apellidos"     => $data->apellidos,
	"municipios_id" => $data->municipios_id
];
$persona = $this->persona->create($values, true);
if($persona){
if($this->persona->updated($persona, $id)){
	$this->response(["model" => $persona]);
}else{
	$this->response([
	"msj"=> "No es posible completar el registro del usuario"], 404);
}
}else{
$this->response([
	"msj"=> "No es posible completar el registro del usuario"], 404);
}