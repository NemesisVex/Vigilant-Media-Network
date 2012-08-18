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
	
	public function retrieve_by_artist_id($artist_id, $return_results = true) {
		$this->db->order_by('song_title');
		if (false !== ($rsSongs = parent::retrieve('song_primary_artist_id', $artist_id))) {
			if ($return_results === true) {
				return $this->return_smarty_array($rsSongs);
			} else {
				return $rsSongs;
			}
		}
		return false;
	}
	
}

?>
