<?php


/**
 * Description of mt_ep4_product_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');

class Mt_ep4_product_map_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_obr_product_release_map';
		$this->primary_index_field = 'product_release_id';
	}
	
	public function get_products_by_release_id($release_id, $return_results = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('gc_products', 'product_release_product_id = id', 'left');
		$this->CI->db->where('product_release_release_id', $release_id);
		
		if (false !== ($rowProducts = $this->CI->db->get())) {
			if ($return_results === true) {
				$rsProducts = $this->return_smarty_array($rowProducts);
				return $rsProducts;
			}
			return $rowProducts;
		}
		return false;
	}
}

?>
