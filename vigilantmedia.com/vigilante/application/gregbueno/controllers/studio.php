<?php

class Studio extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('GbLib');
		//$this->load->model('Gb_model');
	}
	
	function index()
	{
		$this->gblib->_smarty_display_studio_page('gb_studio_index.tpl');
	}
	
	function docs($topic = 'toc')
	{
		$page = 'gb_studio_doc_' . $topic . '.tpl';
		$this->gblib->_smarty_display_studio_page($page);
	}
	
	function error($code)
	{
		$this->gblib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->gblib->_smarty_display_gb_page('vm_error_' . $code . '.tpl');
	}
	
	//Processing methods
}
?>