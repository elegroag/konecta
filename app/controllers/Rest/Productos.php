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
		$this->load->model(array("producto", "categoria"));
	}

	public function index_get()
	{
		$data = $this->producto->get_all();
		$this->response($data, 200);
	}

	public function index_post()
	{
		$insert = [
			"referencia"=> $this->post('referencia'),
			"precio"=> $this->post('precio'),
			"nombre"=> $this->post('nombre'),
			"peso"=> $this->post('peso'),
			"stock"=> $this->post('stock'),
			"categoria"=> $this->post('categoria')
		];
		$producto = $this->producto->create($insert);
		if($producto){
			$producto = $this->producto->save($producto);

			$categorias = (object) $this->categoria->get_use_id($producto->categoria);
			$producto->idcategoria = $producto->categoria;
			$producto->categoria = $categorias->categoria;
			$this->response([
				"model" => $producto, 
				"state"=>200
			]);
		}else{
			$this->response(["msj"=>"No es posible completar el registro del usuario"], 404);
		}
	}

	public function index_put()
	{
		$id = $this->uri->segment(2, 0);
		$values = [
			"referencia"=> $this->post('referencia'),
			"precio"=> $this->post('precio'),
			"nombre"=> $this->post('nombre'),
			"peso"=> $this->post('peso'),
			"stock"=> $this->post('stock'),
			"categoria"=> $this->post('categoria')
		];
		$producto = $this->producto->create($values, true);
		if($producto)
		{
			if($producto->updated($producto, $id))
			{
				$categorias = (object) $this->categoria->get_use_id($producto->categoria);
				$producto->idcategoria = $producto->categoria;
				$producto->categoria = $categorias->categoria;
				$this->response(["model" => $producto]);
			}else{
				$this->response([
				"msj"=> "No es posible completar el registro del usuario 1"], 404);
			}
		}else{
			$this->response([
				"msj"=> "No es posible completar el registro del usuario 2"], 404);
		}
	}

	public function index_delete()
	{
		$id = $this->uri->segment(2, 0);
		if($this->producto->destroy($id)){
		$this->response([
			"errors" => false,
			"msj"=> "El registro se borro con éxito"], 200);
		}else{
		$this->response([
			"errors" => "",
			"msj"=> "No es posible remover el registro"], 404);
		}
	}

	public function producto_get()
	{
		$id = $this->uri->segment(3, 0);
		$producto = $this->producto->get_use_id($id);
		$this->response($producto, 200);
	}
}