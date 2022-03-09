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

	public function pagina_productos($offset=0)
	{
		$this->load->library('jpagination');
		$this->load->library('table');
		$this->load->helper('form');
		$json = file_get_contents('php://input');
		$post = json_decode($json);
		
		$limit = $post->limit;
		$offset = $post->offset;
		$order_by = $post->order_by;
		$filters = $post->filters;
		
		$like_y = array();
		$like_or = array();
		for($i=0; $i < count($filters); $i++)
		{
			if($i == 0){
				$like_y[] = ["field"=> $filters[$i]->name, "value"=> $filters[$i]->value];
			}else{
				$like_or[] = ["field"=>$filters[$i]->name, "value" => $filters[$i]->value];
			} 
		}
		$query = $this->producto->filtro(null, null, $like_y, $like_or, null);

		$config = [
			'div' 		=> false,
			'base_url' 	=> ($post->base_url)? $post->base_url : site_url().'productos/pagina_productos',
			'num_links' => ($post->num_links)? $post->num_links : 5,
			'per_page' 	=> ($post->per_page)? $post->per_page : 15,
			'total_rows' => (!is_bool($query))? $query->num_rows() : 0
		];
		/* $this->jpagination->initialize($config); */
		/* $pagination = $this->jpagination->create_links(); */
		$data = $this->producto->filtro($limit, $offset, $like_y, $like_or, $order_by);
		
		/* $this->table->set_heading(array_values($this->producto->campos_tabla)); */
		if(!is_bool($data))
		{
			$data = $data->result_array();
			/* foreach ($data as $ai => $row) 
			{
				$fila = array_values($row);
				$fila[] = "". 
				form_button([
					'type'  => 'button',
					'content' => "<i class='fas fa-eye fa-2x'></i>",
					'class' => 'btn btn-xs',
					'onClick' => 'mostrar(this)'
				])."".
				form_button([
					'type'  => 'button',
					'content' => "<i class='fas fa-edit fa-2x'></i>",
					'class' => 'btn btn-xs',
					'onClick' => 'editar(this)'
				])."".
				form_button([
					'type'  => 'button',
					'content' => "<i class='fas fa-trash fa-2x'></i>",
					'class' => 'btn btn-xs',
					'onClick' => 'borrar(this)'
				]);
				$this->table->add_row($fila);
			} */
		}else{
			$data = [];
		}
		echo json_encode([
			"data" => $data, 
			"offset" => $offset,
			"limit" => $limit,
			"order_by" => $order_by,
			"filters" => $filters,
			"campos_filtro"=> array_keys($this->producto->campos_tabla),
			"valores_filtro"=> $this->producto->campos_tabla,
			"total_rows"=> $config['total_rows'],
			"per_page"=> $config['per_page']
		]);
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