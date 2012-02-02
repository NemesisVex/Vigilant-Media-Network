<?php
class Mt_as_meetings_model extends CI_Model
{
	var $meetings_table = 'as_meetings';
	var $meetings_table_index = 'meet_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_meetings()
	{
		$this->db->from($this->meetings_table);
		$this->db->order_by('meet_date', 'desc');
		if (false !== ($rowMeet = $this->db->get()))
		{
			return $rowMeet;
		}
		return false;
	}
	
	function get_meeting_by_id($meet_id)
	{
		if (false !== ($rowMeeting = $this->vigilantedblib->_get_record($this->meetings_table, $this->meetings_table_index, $meet_id)))
		{
			$rsMeeting = $this->vigilantedblib->_db_return_rs($rowMeeting);
			return $rsMeeting;
		}
		return false;
	}
	
	function add_meeting($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->meetings_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_meeting_by_id($meet_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->meetings_table, $this->meetings_table_index, $meet_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_meeting_by_id($meet_id)
	{
		$where_function = is_array($meet_id) ? 'where_in' : 'where';
		$this->db->$where_function('meet_id', $meet_id);
		if (false !== $this->db->delete($this->meetings_table))
		{
			return true;
		}
		return false;
	}
	
}
?>