<?php

class Crux extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('GbView');
		$this->vmview->layout_template = 'gb_crux_layout.tpl';
	}
	
	function index()
	{
		$this->vmview->display('gb_crux_index.tpl');
	}
	
	function error($code)
	{
		$this->vmview->display_error_code('gb_error_' . $code . '.tpl');
	}
}
?>