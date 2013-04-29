<?php

/**
 * Obr_Audio
 * 
 * Obr_Audio is a model for Observant Records audio files.
 *
 * @author Greg Bueno
 */

class Obr_Audio_Map extends MY_Model {
	
	public $_table = 'ep4_audio_map';
	public $primary_key = 'map_id';
	public $belongs_to = array(
		'tracks' => array(
			'model' => 'Obr_Track',
			'primary_key' => 'map_track_id',
		),
		'audio' => array(
			'model' => 'Obr_Audio',
			'primary_key' => 'map_audio_id',
		),
	);
	
	protected $soft_delete = true;
	protected $soft_delete_key = 'map_deleted';
	
	public function __construct($params = null) {
		parent::__construct($params);
	}
	
}
