<?php

/**
 * Description of ep4_song
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Song extends VmModel {
	
	public $song_id;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_songs';
		$this->primary_index_field = 'song_id';
	}
}

?>
