<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends CI_Controller
{  
	function __construct()
	{
		parent::__construct();
		redirect("productos");	
		exit();	
	}

	function index()
	{
	}

}