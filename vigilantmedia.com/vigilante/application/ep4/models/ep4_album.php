<?php

/**
 * Description of ep4_albums
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Ep4_Album extends VmModel {
	
	public $album_artist_id;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'ep4_albums';
		$this->primary_index_field = 'album_id';
		
		$this->album_artist_id = 1;
		
		$this->CI->load->model('Ep4_Artist');
	}
	
	public function retrieve_by_id($id, $return_recordset = true) {
		if (false !==($rsAlbum = parent::retrieve_by_id($id, $return_recordset))) {
			if ($return_recordset === true) {
				if (!empty($rsAlbum->album_artist_id)) {
					$rsArtist = $this->CI->Ep4_Artist->retrieve_by_id($rsAlbum->album_artist_id);
					$rs = (object) array_merge((array) $rsArtist, (array) $rsAlbum);
					return $rs;
				}
			} else {
				return $rsAlbum;
			}
		}
		return false;
	}
}

?>
