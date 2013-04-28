<?php

/**
 * Description of obr_audio
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Audio extends VmModel {
	
	public function __construct($params = null) {
		parent::__construct($params);
		
		$this->table_name = 'ep4_audio';
		$this->primary_index_field = 'audio_id';
		
		$this->CI->load->model('Obr_Artist');
		$this->CI->load->model('Obr_Release');
	}
	
	public function retrieve_by_artist_id($artist_id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'audio_song_id=song_id', 'left outer');
		$this->db->order_by('song_title, audio_mp3_file_path, audio_mp3_file_name');
		if (false !== ($rsFiles = parent::retrieve('audio_artist_id', $artist_id))) {
			if ($return_recordset === true) {
				$rs = $this->return_smarty_array($rsFiles);
				return $rs;
			} else {
				return $rsFiles;
			}
		}
		return false;
	}
	
	public function retrieve_by_id($audio_id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'audio_song_id=song_id', 'left outer');
		if (false !== ($rsFile = parent::retrieve_by_id($audio_id, $return_recordset))) {
			return $rsFile;
		}
		return false;
	}
	
	public function retrieve_by_track_id($track_id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'audio_song_id=song_id', 'left outer');
		$this->db->join('ep4_audio_map', 'map_audio_id=audio_id', 'left outer');
		if (false !== ($rsFile = parent::retrieve('map_track_id', $track_id, $return_recordset))) {
			if ($return_recordset === true) {
				$rs = $this->return_smarty_array($rsFile);
				return $rs;
			}
			return $rsFile;
		}
		return false;
	}
}

?>
