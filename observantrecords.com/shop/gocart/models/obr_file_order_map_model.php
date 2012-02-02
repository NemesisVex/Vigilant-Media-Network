<?php

/**
 * Description of mt_ep4_file_product_map_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Obr_file_order_map_model extends VmModel {
	
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
	
	public function get_files_by_order_id($order_id, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('obr_files', 'file_id=file_order_file_id', 'left');
		$this->CI->db->where('file_order_order_id', $order_id);
		
		if (false !== ($rowFiles = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsFiles = $this->return_smarty_array($rowFiles);
				return $rsFiles;
			}
			return $rowFiles;
		}
		return false;
	}
	
	public function get_files_by_customer_id($customer_id, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('obr_files', 'file_id=file_order_file_id', 'left');
		$this->CI->db->join('gc_orders', 'order_number=file_order_order_id', 'left');
		$this->CI->db->where('customer_id', $customer_id);
		
		if (false !== ($rowFiles = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsFiles = $this->return_smarty_array($rowFiles);
				return $rsFiles;
			}
			return $rowFiles;
		}
		return false;
	}
	
	public function get_file_by_order_token($file_order_token, $return_result = true) {
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('obr_files', 'file_id=file_order_file_id', 'left');
		$this->CI->db->where('file_order_token', $file_order_token);
		
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
