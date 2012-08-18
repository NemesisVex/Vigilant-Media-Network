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
		
		$this->config['fetch_audio'] = true;
		
		$this->CI->load->model('Obr_Song');
	}
	
	public function retrieve_by_id($id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'track_song_id=song_id', 'left');
		if ($this->config['fetch_audio'] === true) {
			$this->db->join('ep4_audio', 'track_audio_id=audio_id', 'left outer');
		}
		if (false !== ($rsTrack = parent::retrieve_by_id($id, $return_recordset))) {
			return $rsTrack;
		}
		return false;
	}
	
	public function retrieve_by_release_id($release_id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'track_song_id=song_id', 'left');
		$this->db->order_by('track_disc_num, track_track_num');
		if (false !== ($rsTrack = parent::retrieve('track_release_id', $release_id, $return_recordset))) {
			if ($release_id === true) {
				$rs = $this->return_smarty_array($rsTrack);
				
				if ($this->config['fetch_audio'] === true) {
					$this->CI->load->model('Obr_Audio');
					$rs->audio = $this->CI->Obr_Audio->retrieve_by_track_id($rs->track_id);
				}
				
				return $rs;
			}
			return $rsTrack;
		}
		return false;
	}
}

?>
