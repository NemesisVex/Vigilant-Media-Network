<?php

class Vm extends CI_Controller
{
	public $webmaster_email = 'greg@gregbueno.com';
	public $site_name = 'Vigilant Media';

	function __construct()
	{
		parent::__construct();
		$this->load->library('VmMailer');
		$this->load->library('VigilantMediaView');

		$this->vmmailer->to = $this->webmaster_email;
		$this->vmmailer->redirect = '/index.php/vm/contact/sent/';
		$this->vmmailer->subject_prefix = $this->site_name . ': feedback';
	}

	function index()
	{
		$this->vmview->format_section_head('The online portfolio of Greg Bueno');
		$this->vmview->display('vm_root_index.tpl');
	}

	function projects()
	{
		$this->vmview->format_section_head('Projects');
		$this->vmview->display('vm_root_projects.tpl');
	}

	function resume()
	{
		$this->vmview->format_section_head('R&eacute;sum&eacute;');

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
		$this->mysmarty->assign('projects', $projects);
		$this->vmview->display('vm_root_resume.tpl');
	}

	function contact()
	{
		$this->vmview->format_section_head('Contact');
		$this->vmview->display('vm_root_contact.tpl');
	}

	function contact_sent()
	{
		$this->vmview->format_section_head('Contact', 'Thank You');
		$this->vmview->display('vm_root_contact_sent.tpl');
	}

	function error($code)
	{
		$this->vmview->display_error_page($code, 'vm_error_' . $code . '.tpl');
	}

	// Processing methods
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