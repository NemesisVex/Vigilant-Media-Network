<?php

class Help extends CI_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library('AsLib');
	}
	
	function index()
	{
		$this->aslib->_format_section_head('help');
		$this->aslib->breadcrumbs['help'] = $_SERVER['REQUEST_URI'];
		
		$this->aslib->_smarty_display_as_page('as_help_index.tpl');
	}
	
	function topic($topic, $popup_flag = false)
	{
		$this->aslib->_format_section_head('help');
		$this->aslib->breadcrumbs['help'] = '/index.php/help/';
		
		$topic_template = 'as_help_' . $topic . '.tpl';
		$wrapper = $popup_flag == true ? 'as_help_popup.tpl' : 'as_global_page.tpl';
		
		$this->mysmarty->assign('popup_flag', $popup_flag);
		$this->aslib->_smarty_display_as_page($topic_template, $wrapper);
	}
	//Processing methods
}
?>