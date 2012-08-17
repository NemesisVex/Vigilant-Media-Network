<?php

/**
 * Description of observant
 *
 * @author Greg Bueno
 */
class Observant extends CI_Controller {
	
	public $webmaster_email = 'greg@observantrecords.com';
	public $site_name = 'Observant Records';
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library('VmMailer');
		$this->load->library('VmModel_MtEntry', array('dsn' => 'mt'));
		$this->load->library('ObservantView');
		
		$this->vmmailer->to = $this->webmaster_email;
		$this->vmmailer->redirect = '/index.php/contact/sent/';
		$this->vmmailer->subject_prefix = $this->site_name . ': feedback';
	}
	
	public function index() {
		$rsNews = $this->vmmodel_mtentry->get_latest_entries(null, 3);
		$this->mysmarty->assign('rsNews', $rsNews);
		
		$this->vmview->display('obr_root_index.tpl');
	}
	
	public function shop() {
		$this->vmview->format_section_head('Shop');
		$this->vmview->display('obr_shop_index.tpl');
	}
	
	public function contact() {
		$this->vmview->format_section_head('Contact');
		$this->vmview->display('obr_root_contact.tpl');
	}
	
	public function contact_sent() {
		$this->vmview->format_section_head('Contact', 'Thank You');
		$this->vmview->display('obr_root_contact_sent.tpl');
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
