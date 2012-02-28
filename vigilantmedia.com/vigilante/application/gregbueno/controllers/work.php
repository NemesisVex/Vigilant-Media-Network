<?php

class Work extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	var $login = 'himitsu';
	var $password = 'bungaku';
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('GbLib');
		$this->mysmarty->assign('session', $this->session);
	}
	
	function index()
	{
		$this->gblib->_format_section_head('work in progress');

		$this->gblib->_smarty_display_gb_page('gb_work_index.tpl');
	}
	
	function error($code)
	{
		$this->gblib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->gblib->_smarty_display_gb_page('vm_error_' . $code . '.tpl');
	}
	
	//Processing methods
	function login()
	{
		$login = $this->input->get_post('login');
		$password = $this->input->get_post('password');
		$redirect = $this->input->get_post('redirect');

		if (($login == $this->login) && ($password == $this->password))
		{
			$this->session->set_userdata('is_logged_in', true);
		}
		else
		{
			$this->session->set_flashdata('error', 'Sorry. You did not enter the correct login and password combination.');
		}
		header('Location: ' . $redirect);
	}

    function logout()
    {
		$this->session->set_userdata('is_logged_in', false);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>