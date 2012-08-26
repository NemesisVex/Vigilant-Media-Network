<?php

class Gb extends CI_Controller
{
	public $webmaster_email = 'greg@eponymous4.com';
	public $site_name = 'gregbueno.com';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('VmMailer');
		$this->load->library('GbView');
		
		$this->vmmailer->to = $this->webmaster_email;
		$this->vmmailer->redirect = '/index.php/contact/sent/';
		$this->vmmailer->subject_prefix = $this->site_name . ': feedback';
	}

	function index()
	{
		$this->vmview->display('gb_root_index.tpl');
	}

	function distractions()
	{
		$this->vmview->format_section_head('Distractions');
		$this->vmview->display('gb_root_distractions.tpl');
	}
	
	function museum()
	{
		$this->vmview->format_section_head('Blog Museum');
		$this->vmview->display('gb_root_museum.tpl');
	}
	
	function crux()
	{
		
	}

	function profile()
	{
		header('Location: /', 301);
	}

	function contact()
	{
		$this->vmview->format_section_head('Contact');
		$this->vmview->display('gb_root_contact.tpl');
	}

	function contact_sent()
	{
		$this->vmview->format_section_head('Contact');
		$this->vmview->display('gb_root_contact_sent.tpl');
	}

	function error($code)
	{
		$this->vmview->display_error_page($code, 'gb_error_' . $code . '.tpl');
	}

	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('from_name' => 'n',
		'from_email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->vmmailer->process_email_form($hidden_fields, $shown_fields);
	}
}
?>