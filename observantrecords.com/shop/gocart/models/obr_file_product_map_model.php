<?php

/**
 * Description of mt_ep4_file_product_map_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Obr_file_product_map_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_obr_files_product_map';
		$this->primary_index_field = 'file_product_id';
	}
	
	public function retrieve_by_product_id($product_id, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->where('file_product_product_id', $product_id);
		
		if (false !== ($rowFile = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsFile = $this->return_rs($rowFile);
				return $rsFile;
			}
			return $rowFile;
		}
		return false;
	}
}

?>
