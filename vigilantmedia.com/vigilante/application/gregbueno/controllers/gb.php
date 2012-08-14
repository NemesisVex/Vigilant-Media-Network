<?php

class Gb extends CI_Controller
{
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');

	function __construct()
	{
		parent::__construct();
		$this->load->library('GbLib');
		$this->load->model('Gb_model');
	}

	function index()
	{
		$rowEntries = $this->Gb_model->get_latest_entries();
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);

		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->gblib->_smarty_display_gb_page('gb_root_index.tpl');
	}

	function distractions()
	{
		$this->gblib->page_title = 'Distractions: How I spend my time and waste my money';
		$this->gblib->_smarty_display_gb_page('gb_root_distractions.tpl');
	}

	function profile()
	{
		$this->gblib->_format_section_head('Profile', 'Or how the hell did I end up like this?');
		$this->gblib->_smarty_display_gb_page('gb_root_profile.tpl');
	}

	function contact()
	{
		$this->gblib->_format_section_head('Contact', 'Just in case you feel like writing');
		$this->gblib->_smarty_display_gb_page('gb_root_contact.tpl');
	}

	function contact_sent()
	{
		$this->gblib->_format_section_head('Contact', 'Just in case you feel like writing');
		$this->gblib->_smarty_display_gb_page('gb_root_contact_sent.tpl');
	}

	function error($code)
	{
		$this->gblib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->gblib->_smarty_display_gb_page('gb_error_' . $code . '.tpl');
	}

	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->gblib->email($hidden_fields, $shown_fields);
	}
}
?>