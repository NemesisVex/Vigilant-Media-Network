<?php

class Archive extends CI_Controller
{
	var $page_title;
	var $webmaster_email = 'greg@gregbueno.com';
	var $per_page = 10;
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_mt_model');
		
		$this->archivelib->_format_side_navigation();
	}
	
	// View methods
	
	function index()
	{
		$this->archivelib->_format_section_head('Archives');
		$this->archivelib->_smarty_display_mw_page('amwb_root_index.tpl');
	}
	
	function terms()
	{
		$this->archivelib->_format_section_head('About', 'Terms and conditions of use');
		$this->archivelib->_smarty_display_mw_page('amwb_root_terms.tpl');
	}
	
	function error($code)
	{
		$this->archivelib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->archivelib->_smarty_display_mw_page('amwb_error_' . $code . '.tpl');
	}
	
	// Processing methods
	
	// Private methods
}

?>