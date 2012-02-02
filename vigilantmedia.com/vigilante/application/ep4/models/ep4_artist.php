<?php

/**
 * Description of ep4_artist
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Ep4_Artist extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_artists';
		$this->primary_index_field = 'artist_id';
	}
	
}

?>
