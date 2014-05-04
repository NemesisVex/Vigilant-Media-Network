<?php
class Mt_user_model extends CI_Model
{
	var $user_table_name = 'vm_users';
	var $user_table_index = 'user_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_users($order_by = '')
	{
		if (empty($order_by)) {$order_by = 'user_first_name' . ' asc';}
		$this->db->order_by($order_by);
		$row = $this->db->get($this->user_table_name);
		return $row;
	}
	
	function get_pending_users()
	{
		$this->db->where('user_level_mask', 2);
		$this->db->order_by('user_date_added', 'desc');
		$rowUsers = $this->db->get($this->user_table_name);
		return $rowUsers;
	}
	
	function get_user_by_access_mask($access_mask)
	{
		$this->db->where('(user_access_mask & ' . $access_mask . ') = ' . $access_mask);
		$this->db->order_by('user_login', 'asc');
		$rowUsers = $this->db->get($this->user_table_name);
		return $rowUsers;
	}
	
	function get_user_by_login($user_login)
	{
		$row = $this->vigilantedblib->_get_record($this->user_table_name, 'user_login', $user_login);
		$rs = $this->vigilantedblib->_db_return_rs($row);
		return $rs;
	}
	
	function get_user_by_id($user_id)
	{
		$row = $this->vigilantedblib->_get_record($this->user_table_name, $this->user_table_index, $user_id);
		$rs = $this->vigilantedblib->_db_return_rs($row);
		return $rs;
	}
	
	function get_user_by_email($user_email)
	{
		$row = $this->vigilantedblib->_get_record($this->user_table_name, 'user_email', $user_email);
		$rs = $this->vigilantedblib->_db_return_rs($row);
		return $rs;
	}
	
	function get_user_by_temp_password($user_temp_password)
	{
		$row = $this->vigilantedblib->_get_record($this->user_table_name, 'user_temp_password', $user_temp_password);
		$rs = $this->vigilantedblib->_db_return_rs($row);
		return $rs;
	}
	
	function get_user_log()
	{
		$this->db->order_by('log_date_added', 'desc');
		$rowLogs = $this->db->get('vm_users_log');
		return $rowLogs;
	}
	
	function get_countries()
	{
		$rowCountries = $this->db->get('vm_countries');
		return $rowCountries;
	}
	
	function get_states()
	{
		$this->db->order_by('state_name');
		$rowStates = $this->db->get('vm_states');
		return $rowStates;
	}
	
	function update_user_by_id($user_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->user_table_name, $this->user_table_index, $user_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function update_user_by_email($user_email, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->user_table_name, 'user_email', $user_email, $input))
		{
			return true;
		}
		return false;
	}
	
	function add_user($input)
	{
		if (false !== $this->vigilantedblib->_add_record($this->user_table_name, $input))
		{
			$user_id = $this->db->insert_id();
			return $user_id;
		}
		return false;
	}
	
	function add_user_log($input)
	{
		if (false !== $this->vigilantedblib->_add_record('vm_users_log', $input))
		{
			$log_id = $this->db->insert_id();
			return $log_id;
		}
		return false;
	}
	
	function delete_user_by_id($user_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->user_table_name, $this->user_table_index, $user_id))
		{
			return true;
		}
		return false;
	}
	
	function delete_user_log_by_user_id($user_id)
	{
		if (false !== $this->vigilantedblib->_delete_record('vm_users_log', 'log_user_id', $user_id))
		{
			return true;
		}
		return false;
	}
}
?>