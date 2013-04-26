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
	private $_isrc_country_code;
	private $_isrc_stem;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_audio_isrc';
		$this->primary_index_field = 'audio_isrc_id';
		
		$this->_isrc_registrant_code = ISRC_REGISTRANT_CODE;
		$this->_isrc_country_code = ISRC_COUNTRY_CODE;
		
		$this->_isrc_stem = ISRC_COUNTRY_CODE . '-' . $this->_isrc_registrant_code . '-' . date('y') . '-';
	}
	
	public function generate_code() {
		$isrc_code = null;
		
		// Get the first available unassigned code for the current year.
		$result = $this->_retrieve_unassigned_code();
		
		// If no unassigned code is available, create one.
		$isrc_code = (empty($result)) ? $this->_create_code() : $result->audio_isrc_code;
		
		return $isrc_code;
	}
	
	public function update($field, $value, $input) {
		// If audio_isrc_audio_id is being set, make sure it hasn't been
		// assigned to another audio file.
		if (!empty($input['audio_isrc_audio_id'])) {
			$is_writeable = $this->_validate_assignment($input['audio_isrc_audio_id']);
			
			if ($is_writeable === false) {
				$this->error = 'Another ISRC code has already been assigned to this audio file.';
				return false;
			}
		}
		
		return parent::update($field, $value, $input);
	}
	
	public function create($input = null) {
		// If audio_isrc_audio_id is being set, make sure it hasn't been
		// assigned to another audio file.
		if (!empty($input['audio_isrc_audio_id'])) {
			$is_writeable = $this->_validate_assignment($input['audio_isrc_audio_id']);
			
			if ($is_writeable === false) {
				$this->error = 'Another ISRC code has already been assigned to this audio file.';
				return false;
			}
		}
		
		return parent::create($input);
	}
	
	private function _create_code() {
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
		
		// Save the code in the database.
		$this->_save_unassigned_code($isrc_code);
		
		// Return the code.
		return $isrc_code;
	}
	
	private function _retrieve_unassigned_code() {
		$this->CI->db->from($this->table_name);
		$this->CI->db->like('audio_isrc_code', $this->_isrc_stem, 'after');
		$this->CI->db->where('audio_isrc_audio_id', 0);
		$this->CI->db->order_by('audio_isrc_code');
		$result = $this->CI->db->get();
		return $result->row();
	}
	
	private function _retrieve_last_code() {
		$this->CI->db->from($this->table_name);
		$this->CI->db->like('audio_isrc_code', $this->_isrc_stem, 'after');
		$this->CI->db->order_by('audio_isrc_code', 'desc');
		$result = $this->CI->db->get();
		return $result->row();
	}
	
	private function _save_unassigned_code($isrc_code) {
		$unassigned_code = array(
			'audio_isrc_code' => $isrc_code,
			'audio_isrc_audio_id' => 0,
		);
		
		$id = $this->create($unassigned_code);
		return $id;
	}
	
	private function _validate_assignment($audio_isrc_audio_id) {
		if ($audio_isrc_audio_id == 0) {
			// Zero is an acceptable repeatable value.
			return true;
		} else {
			// If the value is greater than zero, check to make sure
			// it isn't assigned to any other code.
			$result = $this->retrieve('audio_isrc_audio_id', $audio_isrc_audio_id);
			if ($result->num_rows() < 1) {
				return true;
			}
		}
		
		return false;
	}
}

?>
