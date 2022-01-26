<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerProductos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(["producto", "categoria", "venta"]);
	}

	public function render($content="", $title="")
	{
		$data = ["title" => $title, "content" => $content];
		$this->parser->parse('layout/app', $data);		
	}

	public function index()
	{
		$data = [
			"_productos"=> json_encode($this->producto->get_all()),
			"_categorias"=> json_encode($this->categoria->get_all()),
			"_ventas"=> json_encode($this->venta->get_all())
		];
		$content = $this->load->view('dash/manager_productos.php', $data, true);
		$this->render($content);
	}

	public function informe()
	{
		$data = [
			"success" => true,
			"mas_vendidos"=> $this->producto->mas_vendidos(),
			"mayor_stock"=> $this->producto->mayor_stock()
		];
		echo json_encode($data, JSON_NUMERIC_CHECK);
	}

}