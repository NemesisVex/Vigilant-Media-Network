<?php

/**
 * Obr_Audio
 * 
 * Obr_Audio is a model for Observant Records audio files.
 *
 * @author Greg Bueno
 */

class Obr_Audio extends MY_Model {
	
	public $_table = 'ep4_audio';
	public $primary_key = 'audio_id';
	public $belongs_to = array(
		'song' => array(
			'model' => 'Obr_Song',
			'primary_key' => 'audio_song_id',
		),
		'artist' => array(
			'model' => 'Obr_Artist',
			'primary_key' => 'audio_artist_id',
		),
	);
	public $has_many = array(
		'isrc' => array(
			'model' => 'Obr_Audio_Isrc',
			'primary_key' => 'audio_isrc_audio_id',
		),
		'maps' => array(
			'model' => 'Obr_Audio_Map',
			'primary_key' => 'map_audio_id',
		),
	);
	
	protected $soft_delete = true;
	protected $soft_delete_key = 'audio_deleted';
	
	public function __construct($params = null) {
		parent::__construct($params);
	}
	
	public function retrieve_by_artist_id($artist_id) {
		$this->db->from($this->_table);
		$this->db->join('ep4_songs', 'audio_song_id=song_id', 'left outer');
		$this->db->order_by('song_title, audio_mp3_file_path, audio_mp3_file_name');
		$this->db->where('audio_artist_id', $artist_id);
		if (false !== ($rsFiles = $this->db->get())) {
			return $rsFiles->result();
		}
		return false;
	}
	
	public function retrieve_by_track_id($track_id, $return_recordset = true) {
		$this->db->join('ep4_songs', 'audio_song_id=song_id', 'left outer');
		$this->db->join('ep4_audio_map', 'map_audio_id=audio_id', 'left outer');
		$this->db->where('map_track_id', $track_id);
		if (false !== ($rsFile = $this->db->get())) {
			return $rsFile->result();
		}
		return false;
	}
}
