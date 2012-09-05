<?php

class Dev extends CI_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library('VigilantMediaView');

		$this->vmview->layout_template = 'dev_global_layout.tpl';
	}
	
	function index()
	{
		$this->vmview->display('dev_root_index.tpl');
	}
	
	function error($code)
	{
		$this->vmview->display_error_code('vg_error_' . $code . '.tpl');
	}
	
}
?>