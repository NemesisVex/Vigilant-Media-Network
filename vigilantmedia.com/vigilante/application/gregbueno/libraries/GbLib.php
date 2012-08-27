<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class GbLib {

	var $webmaster_email = 'greg@gregbueno.com';
	var $site_name = 'Gregbueno.com';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $gb_config;

	function __construct() {
		$CI = & get_instance();
		switch (ENVIRONMENT) {
			case 'development':
				$this->gb_config['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
				$this->gb_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->gb_config['to_mt'] = 'http://dev.mt.vigilantmedia.com';
		        $this->gb_config['to_wp'] = 'http://wp.vigilantmedia.com';
				$this->gb_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->gb_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->gb_config['to_ep4'] = 'http://dev.eponymous4.gregbueno.com';
				//$this->gb_config['to_journal'] = 'http://journal';
				$this->gb_config['to_archive'] = 'http://dev.archive.musicwhore.org';
				$this->gb_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->gb_config['to_filmwhore'] = 'http://dev.film.musicwhore.org';
				$this->gb_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->gb_config['to_journalcon'] = 'http://dev.journalcon.austin-stories.com';
				$this->gb_config['to_austinstories'] = 'http://dev.austin-stories.com';
				$this->gb_config['to_ddn'] = 'http://dev.duran-duran.net';
				$this->gb_config['to_observant'] = 'http://dev.observantrecords.com';
				$this->gb_config['to_shinkyokuadvocacy'] = 'http://dev.shinkyokuadvocacy.com';
				$this->gb_config['to_emptyensemble'] = 'http://dev.emptyensemble.com';
				break;
			case 'testing':
				$this->gb_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				$this->gb_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->gb_config['to_mt'] = 'http://test.mt.vigilantmedia.com';
		        $this->gb_config['to_wp'] = 'http://wp-test.vigilantmedia.com';
				$this->gb_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->gb_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->gb_config['to_ep4'] = 'http://test.eponymous4.gregbueno.com';
				$this->gb_config['to_journal'] = 'http://test.journal.gregbueno.com';
				$this->gb_config['to_archive'] = 'http://test.archive.musicwhore.org';
				$this->gb_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->gb_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->gb_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->gb_config['to_journalcon'] = 'http://test.journalcon.austin-stories.com';
				$this->gb_config['to_austinstories'] = 'http://test.austin-stories.com';
				$this->gb_config['to_ddn'] = 'http://test.duran-duran.net';
				$this->gb_config['to_observant'] = 'http://test.observantrecords.com';
				$this->gb_config['to_shinkyokuadvocacy'] = 'http://test.shinkyokuadvocacy.com';
				$this->gb_config['to_emptyensemble'] = 'http://test.emptyensemble.com';
				break;
			case 'production':
				$this->gb_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				$this->gb_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->gb_config['to_mt'] = 'http://mt.vigilantmedia.com';
		        $this->gb_config['to_wp'] = 'http://blog.vigilantmedia.com';
				$this->gb_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->gb_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->gb_config['to_ep4'] = 'http://eponymous4.gregbueno.com';
				$this->gb_config['to_journal'] = 'http://journal.gregbueno.com';
				$this->gb_config['to_archive'] = 'http://archive.musicwhore.org';
				$this->gb_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->gb_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->gb_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->gb_config['to_journalcon'] = 'http://www.journalcon.com';
				$this->gb_config['to_austinstories'] = 'http://www.austin-stories.com';
				$this->gb_config['to_ddn'] = 'http://www.duran-duran.net';
				$this->gb_config['to_observant'] = 'http://www.observantrecords.com';
				$this->gb_config['to_shinkyokuadvocacy'] = 'http://www.shinkyokuadvocacy.com';
				$this->gb_config['to_emptyensemble'] = 'http://www.emptyensemble.com';
				break;
		}
		if ($CI->agent->is_mobile() == true) {
			$CI->mysmarty->template_dir = APPPATH . "/views/templates_mobile/";
			$CI->mysmarty->compile_dir = APPPATH . '/views/templates_mobile_c';
		}
	}

	function email($hidden_fields, $shown_fields, $site_name = 'Gregbueno.com', $redirect = '/index.php/gb/contact/sent/') {
		$CI = & get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}

	// Private methods
	function _smarty_display_demos_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_demos_layout.tpl');
	}

	function _smarty_display_studio_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_studio_layout.tpl');
	}

	function _smarty_display_journal_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_journal_layout.tpl');
	}

	function _smarty_display_journal_protected_page($page, $layout = 'gb_journal_layout.tpl') {
		$this->_smarty_display_gb_protected_page('journal_content', $page, 'gb_journal_content.tpl', 'gb_global_page.tpl', $layout);
	}

	function _smarty_display_sakufu_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_sakufu_layout.tpl');
	}

	function _smarty_display_meisakuki_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_meisakuki_layout.tpl');
	}

	function _smarty_display_vexvox_page($page) {
		$this->_smarty_display_gb_page($page, 'gb_vexvox_layout.tpl');
	}

	function _smarty_display_work_protected_page($page) {
		$this->_smarty_display_gb_protected_page('work_content', $page, 'gb_work_content.tpl');
	}

	function _smarty_display_work_page($page) {
		$this->_smarty_display_gb_page($page);
	}

	function _smarty_display_gb_protected_page($content_var, $content_template, $wrapper_template, $page = 'gb_global_page.tpl', $layout = 'gb_global_layout.tpl') {
		$CI = & get_instance();

		$CI->mysmarty->assign('config', $this->gb_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_protected_page($content_var, $content_template, $wrapper_template, $page, $layout);
	}

	function _smarty_display_gb_page($page, $layout = 'gb_global_layout.tpl', $wrapper = 'gb_global_page.tpl') {
		$CI = & get_instance();

		$CI->mysmarty->assign('config', $this->gb_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper, $layout);
	}

	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '') {
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;

		if (!empty($section_head)) {
			$this->page_title .= $section_head;
		}
		if (!empty($section_label)) {
			$this->page_title .= ': ' . $section_label;
		}
		if (!empty($section_sublabel)) {
			$this->page_title .= ': ' . $section_sublabel;
		}
	}

}

?>