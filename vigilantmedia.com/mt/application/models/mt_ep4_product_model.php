<?php

/**
 * Description of mt_ep4_product_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Mt_ep4_product_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_products';
		$this->primary_index_field = 'id';
		
		$this->CI->load->model('Mt_ep4_product_map_model');
	}
	
	public function get_products($order_by = 'name', $return_results = true) {
		$this->CI->db->order_by($order_by);
		
		if (false !== ($rowProducts = $this->CI->db->get($this->table_name))) {
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
