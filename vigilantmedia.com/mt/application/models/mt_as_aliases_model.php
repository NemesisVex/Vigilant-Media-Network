<?php
class Mt_as_aliases_model extends CI_Model
{
	var $alias_table = 'as_users_aliases';
	var $alias_table_index = 'alias_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_alias_by_user_id($alias_user_id)
	{
		$this->db->where('alias_user_id', $alias_user_id);
		$this->db->order_by('alias_name', 'asc');
		if (false !== ($rowAliases = $this->db->get($this->alias_table)))
		{
			return $rowAliases;
		}
		return false;
	}
	
	function get_alias_by_id($alias_id)
	{
		if (false !== ($rowAlias = $this->vigilantedblib->_get_record($this->alias_table, $this->alias_table_index, $alias_id)))
		{
			$rsAlias = $this->vigilantedblib->_db_return_rs($rowAlias);
			return $rsAlias;
		}
		return false;
	}
	
	function add_alias($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->alias_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_alias_by_id($alias_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->alias_table, $this->alias_table_index, $alias_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_alias_by_id($alias_id)
	{
		$where_function = is_array($alias_id) ? 'where_in' : 'where';
		$this->db->$where_function('alias_id', $alias_id);
		if (false !== $this->db->delete($this->alias_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_alias_by_user_id($alias_user_id)
	{
		$where_function = is_array($alias_user_id) ? 'where_in' : 'where';
		$this->db->$where_function('alias_user_id', $alias_user_id);
		if (false !== $this->db->delete($this->alias_table))
		{
			return true;
		}
		return false;
	}
}
?>