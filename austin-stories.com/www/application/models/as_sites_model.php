<?php
class As_sites_model extends CI_Model
{
	var $site_table = 'as_sites';
	var $site_table_index = 'site_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_sites_by_user_id($site_user_id, $simple = false)
	{
		if ($simple == true)
		{
			$this->db->where('site_user_id', $site_user_id);
			$this->db->order_by('site_name', 'asc');
			if (false !== ($rowSites = $this->db->get('as_sites')))
			{
				return $rowSites;
			}
		}
		else
		{
			$this->db->from($this->site_table . ' as s');
			$this->db->join('vm_users as u', 's.site_user_id=u.user_id', 'left');
			$this->db->join('as_users_aliases as a', 's.site_alias_id=a.alias_id', 'left outer');
			$this->db->where('s.site_user_id', $site_user_id);
			$this->db->order_by('site_name', 'asc');
			if (false !== ($rowSites = $this->db->get()))
			{
				return $rowSites;
			}
		}
		return false;
	}
	
	function get_site_by_id($site_id)
	{
		if (false !== ($rowSite = $this->vigilantedblib->_get_record('as_sites', 'site_id', $site_id)))
		{
			$rsSite = $this->vigilantedblib->_db_return_rs($rowSite);
			return $rsSite;
		}
		return false;
	}
	
	function get_sites_with_feeds_by_user_id($site_user_id)
	{
		$this->db->from($this->site_table);
		$this->db->where('site_user_id', $site_user_id);
		$this->db->where('site_rss_feed is not null');
		$this->db->order_by('site_name');
		if (false !== ($rowSites = $this->db->get()))
		{
			return $rowSites;
		}
		return false;
	}
	
	function get_recent_sites($limit = 3)
	{
		$newQuery = '';
		$newQuery .= 'Select U.*, A.*, S.* ';
		$newQuery .= 'From (vm_users as U Left Join as_sites as S on S.site_user_id=U.user_id) ';
		$newQuery .= 'Left Outer Join as_users_aliases as A on A.alias_id=S.site_alias_id ';
		$newQuery .= 'Where ((U.user_level_mask & 1)=0 And (U.user_level_mask & 2)=0 And (U.user_level_mask & 4)=0) ';
		$newQuery .= 'And S.site_in_directory=1 ';
		$newQuery .= 'Order By S.site_date_added Desc Limit 3';
		
		if (false !== ($rowSites = $this->db->query($newQuery)))
		{
			return $rowSites;
		}
		return false;
	}
	
	function add_site($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->site_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_site_by_id($site_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->site_table, $this->site_table_index, $site_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_site_by_id($site_id)
	{
		$where_function = is_array($site_id) ? 'where_in' : 'where';
		$this->db->$where_function('site_id', $site_id);
		if (false !== $this->db->delete($this->site_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_site_by_user_id($site_user_id)
	{
		$where_function = is_array($site_user_id) ? 'where_in' : 'where';
		$this->db->$where_function('site_user_id', $site_user_id);
		if (false !== $this->db->delete($this->site_table))
		{
			return true;
		}
		return false;
	}
}
?>