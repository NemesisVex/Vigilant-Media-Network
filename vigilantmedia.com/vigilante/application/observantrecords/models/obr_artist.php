<?php

/**
 * Description of ep4_artist
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Artist extends VmModel {

	public function __construct() {
		parent::__construct();

		$this->table_name = 'ep4_artists';
		$this->primary_index_field = 'artist_id';
	}

	public function retrieve_all($select = '*', $order_by = 'artist_last_name', $return_recordset = true) {
		$this->db->select($select);
		$this->db->from($this->table_name);
		$this->db->order_by($order_by);

		if (false !== ($row = $this->db->get())) {
			if ($return_recordset === true) {
				$rs = $this->return_smarty_array($row);
				return $rs;
			} else {
				return $row;
			}
		}
		return false;
	}

}

?>
