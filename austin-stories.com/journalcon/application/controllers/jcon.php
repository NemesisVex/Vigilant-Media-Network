<?php

class Jcon extends CI_Controller
{
	var $webmaster_email = 'greg@gregbueno.com';
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('AjcLib');
		$this->load->model('Jcon_model');
	}
	
	function index()
	{
		$this->ajclib->_smarty_display_jc_page('ajc_root_index.tpl');
	}
	
	function faq()
	{
		$this->ajclib->_format_section_head('FAQ');
		$this->ajclib->_smarty_display_jc_page('ajc_root_faq.tpl');
	}
	
	function registration()
	{
		$this->ajclib->_format_section_head('Registration');
		$this->ajclib->_smarty_display_jc_page('ajc_root_registration.tpl');
	}
	
	function hotel()
	{
		$this->ajclib->_format_section_head('Hotel');
		$this->ajclib->_smarty_display_jc_page('ajc_root_hotel.tpl');
	}
	
	function raddisson()
	{
		$this->ajclib->_format_section_head('Hotel', 'Raddisson');
		$this->ajclib->_smarty_display_jc_page('ajc_root_raddisson.tpl');
	}
	
	function programming()
	{
		$this->ajclib->_format_section_head('Programming');
		
		$rowPanels = $this->Jcon_model->get_panels();
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		$rsPanels = $this->_build_panels($rowPanels);
		
		$this->mysmarty->assign('rsPanels', $rsPanels);
		$this->ajclib->_smarty_display_jc_page('ajc_root_programming.tpl');
	}
	
	function transportation()
	{
		$this->ajclib->_format_section_head('Transportation');
		$this->ajclib->_smarty_display_jc_page('ajc_root_transportation.tpl');
	}
	
	function austin()
	{
		$this->ajclib->_format_section_head('About Austin');
		$this->ajclib->_smarty_display_jc_page('ajc_root_austin.tpl');
	}
	
	function local()
	{
		$this->ajclib->_format_section_head('Texans, Click Here!');
		$this->ajclib->_smarty_display_jc_page('ajc_root_local.tpl');
	}
	
	function attendees()
	{
		$this->ajclib->_format_section_head('Attendees');
		
		$rowAttendees = $this->Jcon_model->get_attendees();
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		$rsAttendees = $this->vigilantedblib->_db_return_smarty_array($rowAttendees);
		
		$this->mysmarty->assign('rsAttendees', $rsAttendees);
		$this->ajclib->_smarty_display_jc_page('ajc_root_attendees.tpl');
	}
	
	function committee()
	{
		$this->ajclib->_format_section_head('Committee');
		$this->ajclib->_smarty_display_jc_page('ajc_root_committee.tpl');
	}
	
	function sponsors()
	{
		$this->ajclib->_format_section_head('Sponsors');
		$this->ajclib->_smarty_display_jc_page('ajc_root_sponsors.tpl');
	}
	
	function thanks()
	{
		$this->ajclib->_format_section_head('Thanks!');
		$this->ajclib->_smarty_display_jc_page('ajc_root_thanks.tpl');
	}
	
	function links()
	{
		$this->ajclib->_format_section_head('Link to us');
		$this->ajclib->_smarty_display_jc_page('ajc_root_link.tpl');
	}
	
	function error($code)
	{
		$this->ajclib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->ajclib->_smarty_display_jc_page('ajc_error_' . $code . '.tpl');
	}
	
	// Private methods
	function _build_panels($rowPanels)
	{
		$rowProgram = $this->db->get('Program_Panels', 1, 1);
		foreach ($rowProgram->list_fields() as $program_field)
		{
			$program_fields[] = $program_field;
		}
		$rowContact = $this->db->get('Contact_2003', 1, 1);
		foreach ($rowContact->list_fields() as $contact_field)
		{
			$contact_fields[] = $contact_field;
		}
		
		$rsPanels = null;
		
		foreach ($rowPanels->result() as $rsProgram)
		{
			$p = $rsProgram->ProgramID;
			foreach ($program_fields as $program_field)
			{
				$rsPanels[$p][$program_field] = $rsProgram->$program_field;
			}
			
			$c = $rsProgram->ContactID;
			foreach ($contact_fields as $contact_field)
			{
				$rsPanels[$p]['panelists'][$c][$contact_field] = $rsProgram->$contact_field;
			}
			$rsPanels[$p]['panelists'][$c]['IsModerator'] = $rsProgram->IsModerator;
		}
		return $rsPanels;
	}
}
?>