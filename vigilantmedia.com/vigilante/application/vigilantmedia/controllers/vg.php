<?php

class Vg extends CI_Controller
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
		$this->vmlib->_smarty_display_vg_page('vg_root_index.tpl');
	}
	
	function docs($chapter = '', $section = '')
	{
		$this->vmlib->_format_section_head('Documentation');
		
		if (!empty($chapter) && !empty($section))
		{
			$template = 'vg_doc_' . sprintf('%02s', $chapter) . '_' . sprintf('%02s', $section) . '.tpl';
			$doc_side = 'vg_doc_' . sprintf('%02s', $chapter) . '_side.tpl';
			$this->mysmarty->assign('doc_side', $doc_side);
			$this->mysmarty->assign('side_template', 'vg_doc_side.tpl');
			$this->vmlib->_smarty_display_vg_page($template);
		}
		else
		{
			$this->vmlib->_smarty_display_vg_page('vg_doc_index.tpl');
		}
	}
	
	function error($code)
	{
		$this->vmlib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->vmlib->_smarty_display_vg_page('vg_error_' . $code . '.tpl');
	}
	
}
?>