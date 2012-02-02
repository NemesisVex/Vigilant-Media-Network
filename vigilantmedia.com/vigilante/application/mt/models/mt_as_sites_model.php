<?php
class Mt_as_sites_model extends CI_Model
{
	var $site_table = 'as_sites';
	var $site_table_index = 'site_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_sites_by_user_id($site_user_id)
	{
		$this->db->where('site_user_id', $site_user_id);
		$this->db->order_by('site_name', 'asc');
		if (false !== ($rowSites = $this->db->get('as_sites')))
		{
			return $rowSites;
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