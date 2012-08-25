<?php

class Ep4Lib
{
	var $webmaster_email = 'greg@eponymous4.com';
	var $site_name = 'Eponymous 4 Official Site';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $ep4_config = array();
	
	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->ep4_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->ep4_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->ep4_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->ep4_config['to_ep4'] = 'http://dev.eponymous4.gregbueno.com';
				$this->ep4_config['ep4_mp3_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_mp3';
				$this->ep4_config['ep4_zip_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_zip';
				$this->ep4_config['ep4_cover_root_path'] = '/home/nemesisv/websites/dev/trunk/eponymous4.com/www/images/_covers';
				break;
			case 'test':
				$this->ep4_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->ep4_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->ep4_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->ep4_config['to_ep4'] = 'http://test.eponymous4.gregbueno.com';
				$this->ep4_config['ep4_mp3_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_mp3';
				$this->ep4_config['ep4_zip_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_zip';
				$this->ep4_config['ep4_cover_root_path'] = '/home/nemesisv/websites/test/eponymous4.com/www/images/_covers';
				break;
			case 'production':
				$this->ep4_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->ep4_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->ep4_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->ep4_config['to_ep4'] = 'http://eponymous4.gregbueno.com';
				$this->ep4_config['ep4_mp3_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_mp3';
				$this->ep4_config['ep4_zip_root_path'] = '/home/nemesisv/websites/prod/gregbueno.com/eponymous4/audio/_zip';
				$this->ep4_config['ep4_cover_root_path'] = '/home/nemesisv/websites/prod/eponymous4.com/www/images/_covers';
				break;
		}
		if ($CI->agent->is_mobile() == true) {
			$CI->mysmarty->template_dir = APPPATH . "/views/templates_mobile/";
			$CI->mysmarty->compile_dir = APPPATH . '/views/templates_mobile_c';
		}
	}
	
	function email($hidden_fields, $shown_fields, $site_name = 'Eponymous 4 Official Site', $redirect = '/index.php/contact/sent/')
	{
		$CI =& get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}
	
	function _smarty_display_ep4_page($page, $layout = 'ep4_global_layout.tpl', $wrapper = 'ep4_global_page.tpl')
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('config', $this->ep4_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper, $layout);
	}
	
	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;
		
		if (!empty($section_head)) {$this->page_title .= $section_head;}
		if (!empty($section_label)) {$this->page_title .= ' &raquo; ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ' &raquo; ' . $section_sublabel;}
	}
}

?>