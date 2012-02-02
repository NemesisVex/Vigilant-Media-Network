<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * VmModel
 *
 * @author Greg Bueno
 */
class VmModel {

	public $table_name;
	public $primary_index_field;
	protected $CI;

	public function __construct() {
		$this->CI = & get_instance();
	}

	public function create($input = null) {
		if (empty($input)) {
			$input = $this->build_insert_data($this->table_name);
		}
		
		if (false !== $this->CI->db->insert($this->table_name, $input)) {
			$id = $this->CI->db->insert_id();
			return $id;
		}
		return false;
	}

	public function retrieve($field, $value) {
		if (false !== ($row = $this->CI->db->get_where($this->table_name, array($field => $value)))) {
			return $row;
		}
		return false;
	}

	public function retrieve_by_id($id, $return_recordset = true) {
		$row = $this->retrieve($this->primary_index_field, $id);
		return ($return_recordset === true) ? $this->return_rs($row) : $row;
	}

	public function update($field, $value, $input) {
		$this->CI->db->where($field, $value);
		if (false !== $this->CI->db->update($this->table_name, $input)) {
			return true;
		}
		return false;
	}

	public function update_by_id($id, $input = null, $table_name = null, $form_values = null) {
		if (empty($input)) {
			$row = $this->retrieve_by_id($id);
			$input = $this->build_update_data($row, $form_values);
		}
		
		return $this->update($this->primary_index_field, $id, $input);
	}

	public function delete($field, $value) {
		$this->CI->db->where($field, $value);
		if (false !== $this->CI->db->delete($this->table_name)) {
			return true;
		}
		return false;
	}

	public function delete_by_id($id) {
		return $this->delete($this->primary_index_field, $id);
	}

	public function return_rs($row) {
		return ($row->num_rows() > 0) ? $row->row() : false;
	}

	public function return_smarty_array($row, $limit = null, $start = 1) {
		if (empty($limit)) {
			$limit = $row->num_rows();
		}
		$end = $start + ($limit - 1);
		if ($row->num_rows() > 0) {
			$i = 1;
			foreach ($row->result() as $rs) {
				if ($i >= $start && $i <= $end) {
					$array[] = $rs;
				}
				$i++;
			}
			return $array;
		}
		return false;
	}

	public function build_update_data($row, $form_values = null) {
		$updated_fields = array();

		foreach ($row as $row_field => $row_value) {
			if (false !== ($form_value = isset($form_values[$row_field]) ? $form_values[$row_field] : $this->CI->input->get_post($row_field))) {
				if ($form_value != $row_value) {
					$updated_fields[$row_field] = !isset($form_value) ? null : $form_value;
				}
			}
		}
		return $updated_fields;
	}

	public function build_insert_data($table_name = null, $form_values = null) {
		if (empty($table_name)) {
			$table_name = $this->table_name;
		}

		$inserted_fields = array();

		foreach ($this->CI->db->list_fields($this->table_name) as $row_field) {
			if (false !== ($form_value = isset($form_values[$row_field]) ? $form_values[$row_field] : $this->CI->input->get_post($row_field))) {
				$inserted_fields[$row_field] = empty($form_value) ? null : $form_value;
			}
		}
		return $inserted_fields;
	}
}

?>
