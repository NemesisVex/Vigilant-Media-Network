<?php

/**
 * Description of ep4_track
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Track extends VmModel {
	
	public $track_id;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_tracks';
		$this->primary_index_field = 'track_id';
		
		$this->CI->load->model('Obr_Song');
		$this->CI->load->model('Obr_Release');
	}
	
	public function retrieve_by_id($id, $return_recordset = true) {
		if (false !== ($rsTrack = parent::retrieve_by_id($id, $return_recordset))) {
			if ($return_recordset === true) {
				$rs = $rsTrack;
				if (!empty($rsTrack->track_song_id)) {
					$rsSong = $this->CI->Obr_Song->retrieve_by_id($rsTrack->track_song_id);
					$rs = (object) array_merge((array) $rs, (array) $rsSong);
				}
				
				if (!empty($rsTrack->track_release_id)) {
					$rsRelease = $this->CI->Obr_Release->retrieve_by_id($rsTrack->track_release_id);
					$rs = (object) array_merge((array) $rs, (array) $rsRelease);
				}
				
				return $rs;
			} else {
				return $rsTrack;
			}
		}
		return false;
	}
}

?>
