<?php

/**
 * VigilanteDbLib
 *
 * 
 * @package CodeIgniter
 * @subpackage Vigilant Media Network
 * @category Libraries
 * @author Greg Bueno
 * @copyright (c) 2012 Greg Bueno
 */
class VigilanteDbLib
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	function _db_build_update_data($row, $form_values = '')
	{
		$this->CI =& get_instance();
		$updated_fields = array();
		
		foreach ($row as $row_field => $row_value)
		{
			//$this->CI->vigilantecorelib->debug_trace("DB: $row_field => $row_value");
			if (false !== ($form_value = isset($form_values[$row_field]) ? $form_values[$row_field] : $this->CI->input->get_post($row_field)))
			{
				//$this->CI->vigilantecorelib->debug_trace("FORM: $row_field => $form_value");
				if ($form_value != $row_value)
				{
					$updated_fields[$row_field] = !isset($form_value) ? null: $form_value;
				}
			}
		}
		return $updated_fields;
	}
	
	function _db_build_insert_data($row, $form_values = '')
	{
		$this->CI =& get_instance();
		$inserted_fields = array();
		
		foreach ($row->list_fields() as $row_field)
		{
			if (false !== ($form_value = isset($form_values[$row_field]) ? $form_values[$row_field] : $this->CI->input->get_post($row_field)))
			{
				//$this->CI->vigilantecorelib->debug_trace("$row_field => $form_value");
				$inserted_fields[$row_field] = empty($form_value) ? null : $form_value;
			}
		}
		return $inserted_fields;
	}
	
	function _db_return_rs($row)
	{
		if ($row->num_rows() > 0)
		{
			$rs = $row->row();
			return $rs;
		}
		return false;
	}
	
	function _db_return_smarty_array($row, $limit = '', $start = 1)
	{
		$this->CI =& get_instance();
		
		if (empty($limit)) {$limit = $row->num_rows();}
		$end = $start + ($limit - 1);
		if ($row->num_rows() > 0)
		{
			$i = 1;
			foreach ($row->result() as $rs)
			{
				if ($i >= $start && $i <= $end)
				{
					$array[] = $rs;
				}
				$i++;
			}
			return $array;
		}
		return false;
	}
	
	function _get_record($table, $field, $value)
	{
		$this->CI =& get_instance();
		if (false !== ($row = $this->CI->db->get_where($table, array($field => $value))))
		{
			return $row;
		}
		return false;
	}
	
	function _add_record($table, $input)
	{
		$this->CI =& get_instance();
		if (false !== $this->CI->db->insert($table, $input))
		{
			$id = $this->CI->db->insert_id();
			return $id;
		}
		return false;
	}
	
	function _update_record($table, $field, $value, $input)
	{
		$this->CI =& get_instance();
		
		$this->CI->db->where($field, $value);
		if (false !== $this->CI->db->update($table, $input))
		{
			return true;
		}
		return false;
	}
	
	function _delete_record($table, $field, $value)
	{
		$this->CI =& get_instance();
		
		$this->CI->db->where($field, $value);
		if (false !== $this->CI->db->delete($table))
		{
			return true;
		}
		return false;
	}
}
?>