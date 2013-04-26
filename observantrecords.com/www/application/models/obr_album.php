<?php

/**
 * Obr_Album
 * 
 * Obr_Album is a model for Observant Records albums.
 *
 * @author Greg Bueno
 */

class Obr_Album extends MY_Model {

	public $_table = 'ep4_albums';
	public $primary_key = 'album_id';
	public $belongs_to = array(
		'artist' => array(
			'model' => 'Obr_Artist',
			'primary_key' => 'album_artist_id',
		),
		'format' => array(
			'model' => 'Obr_Album_Format',
			'primary_key' => 'album_format_id',
		),
	);
	public $has_many = array(
		'releases' => array(
			'model' => 'Obr_Release',
			'primary_key' => 'album_release_id',
		), 
	);
	
	public function __construct($params = null) {
		parent::__construct($params);

		$this->table_name = 'ep4_albums';
		$this->primary_index_field = 'album_id';

		$this->album_artist_id = 1;
		
		$this->config['fetch_releases'] = false;

		$this->CI->load->model('Obr_Artist');
		$this->CI->load->model('Obr_Release');
	}

	public function retrieve_by_artist_id($artist_id, $return_recordset = true) {
		$this->db->order_by('album_release_date');
		if (false !==($rsAlbum = parent::retrieve('album_artist_id', $artist_id))) {
			if ($return_recordset === true) {
				$rs = $this->return_smarty_array($rsAlbum);

				if ($this->config['fetch_releases'] === true) {
					for($i = 0; $i < count($rs); $i++) {
						$rs[$i]->releases = $this->CI->Obr_Release->retrieve_by_album_id($rs[$i]->album_id);
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
