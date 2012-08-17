<?php

/**
 * Description of ep4_albums
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Album extends VmModel {

	public $album_artist_id;
	public $releases;

	public function __construct() {
		parent::__construct();

		$this->table_name = 'ep4_albums';
		$this->primary_index_field = 'album_id';

		$this->album_artist_id = 1;
		$this->config['fetch_releases'] = false;

		$this->CI->load->model('Obr_Artist');
		$this->CI->load->model('Obr_Release');
	}

	public function retrieve_by_id($id, $return_recordset = true) {
		if (false !==($rsAlbum = parent::retrieve_by_id($id, $return_recordset))) {
			if ($return_recordset === true) {
				if (!empty($rsAlbum->album_artist_id)) {
					$rsArtist = $this->CI->Obr_Artist->retrieve_by_id($rsAlbum->album_artist_id);
					$rs = (object) array_merge((array) $rsArtist, (array) $rsAlbum);
				}

				if ($this->config['fetch_releases'] === true) {
					if (false !== ($rsReleases = $this->CI->Obr_Release->retrieve_by_album_id($id))) {
						$rs->releases = $rsReleases;
					}
				}

				return $rs;
			} else {
				return $rsAlbum;
			}
		}
		return false;
	}

	public function retrieve_by_artist_id($artist_id, $return_recordset = true) {
		if (false !==($rsAlbum = parent::retrieve('album_artist_id', $artist_id))) {
			if ($return_recordset === true) {
				$rs = $this->return_smarty_array($rsAlbum);

				if ($this->config['fetch_releases'] === true) {
					for($i = 0; $i < count($rs); $i++) {
						$rs[$i]->releases = $this->Obr_Release->retrieve_by_album_id($rs[$i]->album_id);
					}
				}

				return $rs;
			} else {
				return $rsAlbum;
			}
		}
		return false;
	}
}

?>
