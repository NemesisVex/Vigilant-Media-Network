<?php

/**
 * VmModel_MtTag
 *
 * @author Greg Bueno
 */
class VmModel_MtTag extends VmModel {

	public $objecttag_table_name = 'mt_objecttag';
	public $objecttag_primary_index_field = 'objecttag_id';

	public function __construct() {
		parent::__construct();

		$this->table_name = 'mt_tag';
		$this->primary_index_field = 'tag_id';
	}

	public function get_entry_tags($entry_id, $return_results = false) {
		$where_method = (is_array($entry_id)) ? 'where_in' : 'where';

		$this->CI->db->from($this->table_name);
		$this->CI->db->join($this->objecttag_table_name, $this->table_name . '.tag_id = ' . $this->objecttag_table_name . '.objecttag_tag_id');
		$this->CI->db->$where_method('objecttag_object_id', $entry_id);
		$this->CI->db->where('objecttag_object_datasource', 'entry');

		if (false !== ($row = $this->CI->db->get())) {
			if ($return_results === true) {
				return ($row->num_rows() > 1) ? $this->return_smarty_array($row) : $this->return_rs($row);
			}
			return $row;
		}
		return false;
	}
}

?>
