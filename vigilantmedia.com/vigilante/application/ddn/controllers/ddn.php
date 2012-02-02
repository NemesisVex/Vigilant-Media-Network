<?php

class Ddn extends CI_Controller
{
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('DdnLib');
		$this->load->model('Ddn_mt_model');
	}
	
	function index($offset = '')
	{
		$this->ddnlib->_format_section_head();
		
		$rowNews = $this->Ddn_mt_model->get_latest_entries($this->ddnlib->blog_id);
		$rsNews = $this->vigilantedblib->_db_return_smarty_array($rowNews);

		$rowDates = $this->Ddn_mt_model->get_calendar($this->ddnlib->blog_id);
		$rsDates = $this->vigilantedblib->_db_return_smarty_array($rowDates);

		$this->mysmarty->assign('rsDates', $rsDates);
		$this->mysmarty->assign('rsNewsItems', $rsNews);
		$this->mysmarty->assign('content_side_template', 'ddn_root_index_side.tpl');
		$this->ddnlib->_smarty_display_ddn_page('ddn_root_index.tpl');
	}
	
	function contact()
	{
		$this->ddnlib->_format_section_head('contact', 'just in case you feel like writing');
		$this->ddnlib->_smarty_display_ddn_page('ddn_root_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->ddnlib->_smarty_display_ddn_page('ddn_root_contact_sent.tpl');
	}
	
	function error($code)
	{
		$this->ddnlib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->ddnlib->_smarty_display_ddn_page('ddn_error_' . $code . '.tpl');
	}

	//AJAX methods

	function markers($tour_id)
	{
		$rowTourDates = $this->Ddn_model->get_tour_dates($tour_id);

		$tour_xml = $this->ddnlib->build_tour_xml($rowTourDates);

		header('Content-type: text/xml;');
		echo $tour_xml;
	}

	function marker($date_id)
	{
		$rowDate = $this->Ddn_model->get_tour_date($date_id);
		$rsDate = $this->vigilantedblib->_db_return_rs($rowDate);

		$this->mysmarty->assign('rsDate', $rsDate);
		$output = $this->mysmarty->fetch('ddn_tour_marker.tpl');
		echo $output;
		die();
	}

	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->vigilantecorelib->email($hidden_fields, $shown_fields);
	}
}
?>