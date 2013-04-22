<?php

/**
 * Description of ep4_song
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Audio_Isrc extends VmModel {
	
	public $song_id;
	private $_isrc_registrant_code;
	private $_isrc_stem;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_audio_isrc';
		$this->primary_index_field = 'audio_isrc_id';
		
		$this->_isrc_registrant_code = ISRC_REGISTRANT_CODE;
		
		$this->_isrc_stem = 'us-' . $this->_isrc_registrant_code . '-' . date('y') . '-';
	}
	
	public function generate_code() {
		$isrc_code = null;
		
		// Get the most recently generated code for the year.
		$result = $this->_retrieve_last_code();
		
		// If a result exists, increment the designation code.
		if (!empty($result)) {
			list ($country, $registrant, $year, $designation) = explode('-', $result->audio_isrc_code);
			$new_designation = intval($designation);
			$new_designation++;
			$isrc_code = $country . '-' . $registrant . '-' . $year . '-' . sprintf('%05d', $new_designation);
		} else {
		// If no result exists, create the first code.
			$isrc_code = $this->_isrc_stem . sprintf('%05d', 1);
		}
		
		// Return the code.
		return $isrc_code;
	}
	
	private function _retrieve_last_code() {
		$this->CI->db->from($this->table_name);
		$this->CI->db->like('audio_isrc_code', $this->_isrc_stem, 'after');
		$this->CI->db->order_by('audio_isrc_code', 'desc');
		$result = $this->CI->db->get();
		return $result->row();
	}
}

?>
