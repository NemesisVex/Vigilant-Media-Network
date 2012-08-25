<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjcLib
{
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $as_config;
	
	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->as_config['to_vigilante'] = 'http://vigilante';
				$this->as_config['to_vigilantmedia'] = 'http://vigilantmedia';
				break;
			case 'testing':
				$this->as_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->as_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				break;
			case 'production':
				$this->as_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->as_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				break;
		}
	}
	
	// Private methods
	function _smarty_display_jc_page($page)
	{
		$this->_smarty_display_as_page($page, 'ajc_global_page.tpl');
	}
	
	function _smarty_display_as_page($page, $wrapper = 'as_global_page.tpl')
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('config', $this->as_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper);
	}
	
	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;
		
		if (!empty($section_head)) {$this->page_title .= $section_head;}
		if (!empty($section_label)) {$this->page_title .= ' &#8212; ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ' &#8212; ' . $section_sublabel;}
	}
}
?>