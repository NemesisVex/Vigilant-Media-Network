<?php

/**
 * Description of mt_ep4_file_product_map_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Mt_ep4_file_order_map_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_obr_files_order_map';
		$this->primary_index_field = 'file_product_id';
	}
	
	public function get_orders_by_file_id ($file_id, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('gc_orders', 'file_order_order_id = order_number', 'left');
		$this->CI->db->where('file_order_file_id', $file_id);
		
		if (false !== ($rowOrders = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsOrders = $this->return_smarty_array($rowOrders);
				return $rsOrders;
			}
			return $rowOrders;
		}
		return false;
	}
	
	public function delete_order_map_by_file_id($file_id) {
		$this->CI->db->from($this->table_name);
		if (false !== $this->delete('file_order_file_id', $file_id)) {
			return true;
		}
		return false;
	}
}

?>
