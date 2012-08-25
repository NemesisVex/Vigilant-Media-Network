<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VmLib
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $vm_config;
	
	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->vm_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->vm_config['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
				$this->vm_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->vm_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->vm_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->vm_config['to_filmwhore'] = 'http://dev.film.musicwhore.org';
				$this->vm_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->vm_config['to_journalcon'] = 'http://dev.journalcon.austin-stories.com';
				$this->vm_config['to_austinstories'] = 'http://dev.austin-stories.com';
				$this->vm_config['to_allaboard'] = 'http://allaboard';
				break;
			case 'testing':
				$this->vm_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->vm_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				$this->vm_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->vm_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->vm_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->vm_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->vm_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->vm_config['to_journalcon'] = 'http://test.journalcon.austin-stories.com';
				$this->vm_config['to_austinstories'] = 'http://test.austin-stories.com';
				$this->vm_config['to_allaboard'] = 'http://allaboard.vigilantmedia.com';
				break;
			case 'production':
				$this->vm_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->vm_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				$this->vm_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->vm_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->vm_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->vm_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->vm_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->vm_config['to_journalcon'] = 'http://www.journalcon.com';
				$this->vm_config['to_austinstories'] = 'http://www.austin-stories.com';
				$this->vm_config['to_allaboard'] = 'http://allaboard.vigilantmedia.com';
				break;
		}
		if ($CI->agent->is_mobile() == true) {
			$CI->mysmarty->template_dir = APPPATH . "/views/templates_mobile/";
			$CI->mysmarty->compile_dir = APPPATH . '/views/templates_mobile_c';
		}
	}
	
	function email($hidden_fields, $shown_fields, $site_name = 'Vigilant Media', $redirect = '/index.php/vm/contact/sent/')
	{
		$CI =& get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}
	
	// Private methods
	function _smarty_display_dev_page($page)
	{
		$this->_smarty_display_vm_page($page, 'dev_global_layout.tpl');
	}
	
	function _smarty_display_vg_page($page)
	{
		$this->_smarty_display_vm_page($page, 'vg_global_layout.tpl');
	}
	
	function _smarty_display_vm_page($page, $layout = 'vm_global_layout.tpl', $wrapper = 'vm_global_page.tpl')
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('config', $this->vm_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->mysmarty->assign('root_content', $page);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper, $layout);
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