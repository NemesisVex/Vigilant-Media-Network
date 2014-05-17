<?php
/**
 * Description of mt_ep4_file_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');
class Mt_ep4_file_model extends VmModel {
	
	protected $CI;
	
	public function __construct() {
		parent::__construct();
		
		$this->CI =& get_instance();
		
		$this->table_name = 'gc_obr_files';
		$this->primary_index_field = 'file_id';
	}
	
	public function get_files($order_by = 'file_path, file_name', $return_results = true) {
		$this->CI->db->from($this->table_name);
		if (!empty($order_by)) {
			$this->CI->db->order_by($order_by);
		}
		
		if (false !== ($rowFiles = $this->CI->db->get())) {
			if ($return_results === true) {
				$rsFiles = $this->return_smarty_array($rowFiles);
				return $rsFiles;
			}
			return $rowFiles;
		}
		return false;
	}
}

?>
