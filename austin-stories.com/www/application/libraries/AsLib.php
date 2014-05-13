<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AsLib
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $site_name = 'Austin Stories';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $breadcrumbs = array();
	var $blog_id = 9;
	var $as_config;
	
	function __construct()
	{
		$CI =& get_instance();
		
		$this->as_config['site_name'] = $this->site_name;
		$this->breadcrumbs['home'] = '/';
		
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->as_config['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
				$this->as_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->as_config['to_mt'] = 'http://dev.mt.vigilantmedia.com';
				//$this->as_config['to_vigilantdev'] = 'http://dev';
				$this->as_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->as_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->as_config['to_ep4'] = 'http://dev.eponymous4.gregbueno.com';
				//$this->as_config['to_journal'] = 'http://journal';
				$this->as_config['to_archive'] = 'http://dev.archive.musicwhore.org';
				$this->as_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->as_config['to_filmwhore'] = 'http://dev.film.musicwhore.org';
				$this->as_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->as_config['to_journalcon'] = 'http://dev.journalcon.austin-stories.com';
				$this->as_config['to_austinstories'] = 'http://dev.austin-stories.com';
				break;
			case 'testing':
				$this->as_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				$this->as_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->as_config['to_mt'] = 'http://test.mt.vigilantmedia.com';
				$this->as_config['to_vigilantdev'] = 'http://dev.vigilantmedia.com';
				$this->as_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->as_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->as_config['to_ep4'] = 'http://test.eponymous4.gregbueno.com';
				$this->as_config['to_journal'] = 'http://test.journal.gregbueno.com';
				$this->as_config['to_archive'] = 'http://test.archive.musicwhore.org';
				$this->as_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->as_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->as_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->as_config['to_journalcon'] = 'http://test.journalcon.austin-stories.com';
				$this->as_config['to_austinstories'] = 'http://test.austin-stories.com';
				break;
			case 'production':
				$this->as_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				$this->as_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->as_config['to_mt'] = 'http://mt.vigilantmedia.com';
				$this->as_config['to_vigilantdev'] = 'http://dev.vigilantmedia.com';
				$this->as_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->as_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->as_config['to_ep4'] = 'http://eponymous4.gregbueno.com';
				$this->as_config['to_journal'] = 'http://journal.gregbueno.com';
				$this->as_config['to_archive'] = 'http://archive.musicwhore.org';
				$this->as_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->as_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->as_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->as_config['to_journalcon'] = 'http://journalcon.austin-stories.com';
				$this->as_config['to_austinstories'] = 'http://www.austin-stories.com';
				break;
		}
	}
	
	function email($hidden_fields, $shown_fields, $site_name = 'Austin Stories', $redirect = '/index.php/aus/contact/sent/')
	{
		$CI =& get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}
	
	// Private methods
	function _smarty_display_as_protected_page($content_var, $content_template, $wrapper_template = 'as_members_content.tpl', $page = 'as_global_page.tpl', $crumbs = '')
	{
		$CI =& get_instance();
		
		if (empty($crumbs))
		{
			$crumbs = $this->_format_breadcrumbs($this->breadcrumbs);
			$CI->mysmarty->assign('breadcrumbs', $crumbs);
		}
		
		$CI->mysmarty->assign('config', $this->as_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_protected_page($content_var, $content_template, $wrapper_template, $page);
	}
	
	function _smarty_display_as_page($page, $wrapper = 'as_global_page.tpl', $crumbs = '')
	{
		$CI =& get_instance();
		
		if (empty($crumbs))
		{
			$crumbs = $this->_format_breadcrumbs($this->breadcrumbs);
			$CI->mysmarty->assign('breadcrumbs', $crumbs);
		}
		
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
		if (!empty($section_label)) {$this->page_title .= ': ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ': ' . $section_sublabel;}
	}
	
	function _format_breadcrumbs($paths, $delimiter = '&raquo;')
	{
		$CI =& get_instance();
		
		if (!empty($paths))
		{
			foreach ($paths as $label => $path)
			{
				$breadcrumbs[] = !empty($path) ? '<a href="' . $path . '">' . $label . '</a>' : $label;
			}
			$breadcrumb = join(' ' . $delimiter . ' ', $breadcrumbs);
			return $breadcrumb;
		}
		return false;
	}
}
?>