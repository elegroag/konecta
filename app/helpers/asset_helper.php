<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('asset'))
{
	function asset($data='', $path='')
	{
		$value="";
		if($data){
			$explode =  explode(".", $data);
			$array_merge = array_merge([], $explode);
			$ext = end($array_merge);
			if($ext == "css" || $ext == "CSS"){
				if($path != ""){
					$value = base_url()."public/".$path.'/'.$data;
				}else{
					$value = base_url()."public/css/".$data;
				}
			}

			if($ext == "js" || $ext == "JS"){
				if($path != ""){
					$value = base_url()."public/".$path.'/'.$data;
				}else{
					$value = base_url()."public/js/".$data;
				}
			}
		}
		return $value; 
	}
}
