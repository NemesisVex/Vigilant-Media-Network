<?php

/**
 * Description of mt_ep4_file_product_map_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Mt_ep4_file_product_map_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_obr_files_product_map';
		$this->primary_index_field = 'file_product_id';
	}
	
	public function get_maps_by_file_id($file_id, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('gc_products', 'file_product_product_id = id', 'left');
		$this->CI->db->where('file_product_file_id', $file_id);
		
		if (false !== ($rowFiles = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsFiles = $this->return_smarty_array($rowFiles);
				return $rsFiles;
			}
			return $rowFiles;
		}
		return false;
	}
	
	public function delete_product_map_by_file_id($file_id) {
		$this->CI->db->from($this->table_name);
		if (false !== $this->delete('file_product_file_id', $file_id)) {
			return true;
		}
		return false;
	}
}

?>
