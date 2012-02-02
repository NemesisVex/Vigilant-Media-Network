<?php
class Jcon_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	// Music methods
	function get_panels()
	{
		$this->db->from('Program_Panels as Pa');
		$this->db->join('Program_Panelists as Pn', 'Pa.ProgramID=Pn.ProgramID', 'left outer');
		$this->db->join('Contact_2003 as C', 'Pn.ContactID=C.ContactID', 'left');
		$this->db->where('Pa.Publish',true);
		$this->db->order_by('Pa.PanelTitle');
		$this->db->order_by('Pn.IsModerator', 'Desc');
		$this->db->order_by('C.BadgeName');
		if (false !== ($rowPanels = $this->db->get()))
		{
			return $rowPanels;
		}
		return false;
	}
	
	function get_attendees()
	{
		$this->db->from('Contact_2003 as C');
		$this->db->join('Registration_2003 as R', 'C.ContactID=R.ContactID', 'left');
		$this->db->where('R.PayStatus <> ' . $this->db->escape('outstanding'));
		$this->db->where('C.IsListed', true);
		$this->db->order_by('C.BadgeName');
		if (false !== ($rowAttendees = $this->db->get()))
		{
			return $rowAttendees;
		}
		return false;
	}
}
?>