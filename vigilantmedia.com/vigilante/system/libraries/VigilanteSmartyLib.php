<?php

/**
 * VigilanteSmartyLib
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class VigilanteSmartyLib
{
	function __construct()
	{
		$this->CI =& get_instance();
		$this->_smarty_init_global_header();
	}
	
	function _smarty_init_global_header()
	{
		$this->CI =& get_instance();
		
		if (!empty($this->CI->page_title)) {$this->CI->mysmarty->assign('page_title', $this->CI->page_title);}
	}
	
	function _smarty_display_protected_page($content_var, $content_template, $wrapper_template, $page = 'global_page.tpl', $layout_template = 'global_layout.tpl', $charset = 'utf-8', $cache_control = 'private')
	{
		$this->CI =& get_instance();
		
		$this->CI->mysmarty->assign($content_var, $content_template);
		$this->_smarty_display_page($wrapper_template, $page, $layout_template, $charset, $cache_control);
	}
	
	function _smarty_display_page($content_template = 'root_index.tpl', $page = 'global_page.tpl', $layout_template = 'global_layout.tpl', $charset = 'utf-8', $cache_control = 'private')
	{
		$this->CI =& get_instance();
		
		header('Content-Type: text/html; charset=' . $charset);
		header('Cache-Control: ' . $cache_control);
		$this->CI->mysmarty->assign('content_template', $content_template);
		if (!empty($layout_template)) {$this->CI->mysmarty->assign('layout_template', $layout_template);}
		$this->CI->mysmarty->display($page);
	}
}
?>