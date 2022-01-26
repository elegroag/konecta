	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Producto extends CI_Model{

	public static $table = "productos";
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		$this->db->select('productos.id, nombre, referencia, precio, stock, precio, peso, productos.categoria as idcategoria, categorias.categoria');
		$this->db->from(self::$table);
		$this->db->join('categorias', 'categorias.id=productos.categoria');
		$rqs = $this->db->get();
		return (is_bool($rqs))? array() : $rqs->result_array();
	}

	public function get_use_id($id)
	{
		$query = $this->db->query('SELECT * FROM '.self::$table.' WHERE id='.$id )->row_array();
		return $query;
	}

	public function save($insert)
	{
		$this->db->insert(self::$table, $insert);
		if(!is_object($insert)){
		$id = $this->db->insert_id();
			return $id;
		}else{
			$this->id = $this->db->insert_id();
			return $this;
		}
	}

	public function updated($update, $id)
	{
		$this->db->update(self::$table, $update, array("id"=> $id));
		return $this->db->affected_rows();
	}

	public function create($data=[], $update=null)
	{
		$_fields = $this->_fields_table();
		$is_array = is_array($data);
		foreach($_fields as $row)
		{
			if($row != "id"){
				if($is_array){
				$i=0;
				foreach($data as $key => $value){
					if($row == $key){
						$this->$row = $value;
						$i++;
						break;
					}
				}
				if($i==0){
					$this->$row = 0;
				}
				}else{
					$this->$row = 0;
				}
			}
			if($row == "createAt" && $this->$row == 0){
				$this->$row = date("Y-m-d H:i:s");
			}
		}
		return $this;
	}

	public function destroy($id)
	{
		return $this->db->simple_query("DELETE FROM ".self::$table." WHERE id=".$id);
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$_fields = $this->_fields_table();
		$this->form_validation->set_rules('precio', "precio", "required|integer");
		$this->form_validation->set_rules('nombre', "nombre", "required");
		$this->form_validation->set_rules('referencia', "referencia", "required");
		$this->form_validation->set_rules('categoria', "categoria", "required|integer");
		$this->form_validation->set_rules('stock', "stock", "required|integer");
		$this->form_validation->set_rules('peso', "peso", "required|integer");

		$_error = array();
		if($this->form_validation->run() == FALSE){
			foreach($_fields as $field){
				$_error[] = form_error($this->_fields_protected($field), '<span class="field-error">', '</span>');
			}
			return ["mensajes" => json_encode($_error)];
		}else{
			return true;
		}
	}

	function _fields_table()
	{
		return $this->db->list_fields(self::$table);
	}

	function _fields_protected($field)
	{
		$fields_names = [
			'id' => "codigo",
			'nombre'=> "nombre producto",
			'categoria'=> 'categoria',
			'stock' => 'stock',
			'referencia' => 'referencia',
			'precio'=> 'precio',
			'peso'=> 'peso'
		];
		return (isset($fields_names[$field]))? $fields_names[$field]: $field;
	}

}