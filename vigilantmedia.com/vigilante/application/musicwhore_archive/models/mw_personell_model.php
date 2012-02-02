<?php
class Mw_personell_model extends CI_Model
{
	var $member_table = 'mw_artists_personell';
	var $member_table_index = 'member_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_member_by_id($member_id, $return_type = '')
	{
		if (false !== ($rowMember = $this->vigilantedblib->_get_record($this->member_table, $this->member_table_index, $member_id)))
		{
			switch ($return_type)
			{
				case 'row':
					return $rowMember;
					break;
				default:
					$rsMember = $this->vigilantedblib->_db_return_rs($rowMember);
					return $rsMember;
			}
		}
		return false;
	}
	
	function get_members_by_artist_id($member_artist_id)
	{
		$this->db->order_by('member_order');
		if (false !== ($rowMembers = $this->db->get_where($this->member_table, array('member_artist_id' => $member_artist_id))))
		{
			return $rowMembers;
		}
		return false;
	}
}
?>