<?php
class Ep4 extends CI_Controller
{
	public $webmaster_email = 'greg@eponymous4.com';
	public $site_name = 'Eponymous 4';
	public $digital_format_id = 14;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('VmMailer');
		$this->load->library('Ep4View');
		
		$this->load->model('Ep4_MtEntry');
		$this->load->model('Ep4_Release');
		$this->load->model('Ep4_news_model');
		$this->load->model('Ep4_release_model');
		
		$this->vmmailer->to = $this->webmaster_email;
		$this->vmmailer->redirect = '/index.php/contact/sent/';
		$this->vmmailer->subject_prefix = $this->site_name . ': feedback';
	}
	
	// View methods
	
	function index()
	{
		$rsNews = $this->Ep4_MtEntry->get_latest_entries(null, 3);
		$this->mysmarty->assign('rsNews', $rsNews);
		
		if (false !== ($rowReleases = $this->Ep4_release_model->get_releases($this->digital_format_id, 'asc')))
		{
			$rsReleases = $this->vmmodel->return_smarty_array($rowReleases);
			$this->mysmarty->assign('rsReleases', $rsReleases);
		}
		
		$this->vmview->display('ep4_root_index.tpl');
	}
	
	function bio()
	{
		$this->vmview->format_section_head('Bio');
		$this->mysmarty->assign('bgImage', 'LS006329.jpg');
		$this->vmview->display('ep4_root_bio.tpl');
	}
	
	function links()
	{
		$this->output->set_status_header(410);
	}
	
	function contact()
	{
		$this->vmview->format_section_head('Contact');
		$this->vmview->display('ep4_root_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->vmview->format_section_head('Contact', 'Thank You');
		$this->vmview->display('ep4_root_contact_sent.tpl');
	}
	
	function error($code)
	{
		$this->vmview->display_error_page($code, 'ep4_error_' . $code . '.tpl');
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
	
	// Private methods
}

?>