<?php

/**
 * Obr_Artist
 * 
 * Obr_Artist is the model for an Observant Records Artist.
 *
 * @author Greg Bueno
 * @copyright (c) 2013, Greg Bueno
 */

class Obr_Artist extends MY_Model {
	
	public $_table = 'ep4_artists';
	public $primary_key = 'artist_id';
	public $has_many = array(
		'albums' => array(
			'model' => 'obr_album',
			'primary_key' => 'album_artist_id',
		),
		'releases' => array(
			'model' => 'obr_release',
			'primary_key' => 'release_artist_id',
		),
		'songs' => array(
			'model' => 'obr_song',
			'primary_key' => 'song_primary_artist_id',
		),
		'audio' => array(
			'model' => 'obr_audio',
			'primary_key' => 'audio_artist_id',
		),
		
	);

	public function __construct() {
		parent::__construct();

		$this->table_name = 'ep4_artists';
		$this->primary_index_field = 'artist_id';
	}

}

?>
