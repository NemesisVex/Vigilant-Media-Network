<?php

/**
 * VmModel_MtCategory
 *
 * @author Greg Bueno
 */
class VmModel_MtCategory extends VmModel {

	public $placement_table_name = 'mt_placement';
	public $placement_primary_index_field = 'placement_id';

	public function __construct() {
		parent::__construct();

		$this->table_name = 'mt_category';
		$this->primary_index_field = 'category_id';
	}

	public function get_all_categories($blog_id = null, $return_results = false, $limit = null, $start = 1) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->order_by('category_label');
		$row = $this->CI->db->get_where($this->table_name, array('category_blog_id' => $blog_id));
		return ($return_results === true) ? $this->return_smarty_array($row, $limit, $start) : $row;
	}

	public function get_entry_categories($entry_id, $return_results = false, $primary_only = true) {
		$where_method = (is_array($entry_id)) ? 'where_in' : 'where';

		$this->CI->db->from($this->table_name);
		$this->CI->db->join($this->placement_table_name, $this->table_name . '.category_id = ' . $this->placement_table_name . '.placement_category_id');
		$this->CI->db->$where_method('placement_entry_id', $entry_id);
		if ($primary_only === true) {
			$this->CI->db->where('placement_is_primary', 1);
		}

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
