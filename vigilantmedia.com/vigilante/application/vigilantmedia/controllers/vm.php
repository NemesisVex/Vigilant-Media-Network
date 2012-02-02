<?php

class Vm extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('VmLib');
	}
	
	function index()
	{
		$this->vmlib->_format_section_head('The online portfolio of Greg Bueno');
		$this->vmlib->_smarty_display_vm_page('vm_root_index.tpl');
	}
	
	function portfolio()
	{
		if ($this->agent->is_mobile() == true) {
			$this->vmlib->_format_section_head('Portfolio');
			$this->vmlib->_smarty_display_vm_page('vm_root_projects.tpl');
		} else {
			header('Location: /');
		}
	}
	
	function resume($toggle = '')
	{
		$this->vmlib->_format_section_head('R&eacute;sum&eacute;');
		$wrapper = $toggle == 'print' ? 'vm_global_printer.tpl' : 'vm_global_page.tpl';
		
		$resume_path = $_SERVER['DOCUMENT_ROOT'] . '/content/resume.xml';
		if (false !== ($fp = @fopen($resume_path, 'r')))
		{
			$resume_input = fread($fp, filesize($resume_path));
			fclose($fp);
		}
		$resume_xml = simplexml_load_string($resume_input);
		
		$contact = $resume_xml->xpath('/resume/contact');
		$professional = $resume_xml->xpath('/resume/experience[@type="professional"]');
		$miscellaneous = $resume_xml->xpath('/resume/experience[@type="miscellaneous"]');
		$education = $resume_xml->xpath('/resume/experience[@type="education"]');
		$projects = $resume_xml->xpath('/resume/experience[@type="projects"]');
		$skills = $resume_xml->xpath('/resume/experience[@type="skills"]');
		$summary = $resume_xml->xpath('/resume/experience[@type="summary"]');
		
		$this->mysmarty->assign('contact', $contact);
		$this->mysmarty->assign('professional', $professional);
		$this->mysmarty->assign('miscellaneous', $miscellaneous);
		$this->mysmarty->assign('education', $education);
		$this->mysmarty->assign('skills', $skills);
		$this->mysmarty->assign('summary', $summary);
		$this->mysmarty->assign('toggle', $toggle);
		$this->mysmarty->assign('projects', $projects);
		$this->vmlib->_smarty_display_vm_page('vm_root_professional.tpl', null, $wrapper);
	}
	
	function contact()
	{
		$this->vmlib->_format_section_head('Contact');
		$this->vmlib->_smarty_display_vm_page('vm_root_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->vmlib->_format_section_head('Portfolio');
		$this->vmlib->_smarty_display_vm_page('vm_root_contact_sent.tpl');
	}
	
	function error($code)
	{
		$this->vmlib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->vmlib->_smarty_display_vm_page('vm_error_' . $code . '.tpl');
	}
	
	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->vmlib->email($hidden_fields, $shown_fields);
	}
}
?>