<?php

/**
 * ep4_song
 * 
 * ep4_song is a model for an Observant Records song.
 *
 * @author Greg Bueno
 * @copyright (c) 2013, Greg Bueno
 */

class Obr_Song extends MY_Model {
	
	public $_table = 'ep4_songs';
	public $primary_key = 'song_id';
	public $has_many = array(
		'tracks' => array(
			'model' => 'Obr_Track',
			'primary_key' => 'track_song_id',
		),
		'audio' => array(
			'model' => 'Obr_Audio',
			'primary_key' => 'audio_song_id',
		),
	);
	protected $soft_delete = true;
	protected $soft_delete_key = 'song_deleted';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get_by_artist_id($artist_id) {
		$this->order_by('song_title');
		if (false !== ($rsSongs = $this->get_many_by('song_primary_artist_id', $artist_id))) {
			return $rsSongs;
		}
		return false;
	}
}

?>
