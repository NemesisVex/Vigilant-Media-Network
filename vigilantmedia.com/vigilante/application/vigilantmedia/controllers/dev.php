<?php

class Dev extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('VmLib');
	}
	
	function index()
	{
		$this->vmlib->_smarty_display_dev_page('dev_root_index.tpl');
	}
	
	function error($code)
	{
		$this->vmlib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->vmlib->_smarty_display_dev_page('vg_error_' . $code . '.tpl');
	}
	
}
?>