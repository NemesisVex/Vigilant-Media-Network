<?php


/**
 * Description of mt_ep4_product_model
 *
 * @author Greg Bueno
 */
require_once(APPPATH . 'libraries/VmModel.php');

class Obr_product_map_model extends VmModel {
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'gc_obr_product_release_map';
		$this->primary_index_field = 'product_release_id';
	}
	
	public function get_release_by_product_id($product_id, $return_result = true) {
		$release_query = '';
		$release_query .= 'Select * From (' . $this->table_name . ' as rm ';
		$release_query .= 'Left Join ep4_albums_releases r On rm.product_release_release_id = r.release_id) ';
		$release_query .= 'Left Join ep4_albums as al On r.release_album_id = al.album_id ';
		$release_query .= 'Where rm.product_release_product_id = ' . $product_id;
		
		if (false !== ($rowRelease = $this->CI->db->query($release_query))) {
			if ($return_result === true) {
				$rsRelease = $this->return_rs($rowRelease);
				if (!empty($rsRelease->release_id)) {
					$rsRelease->tracks = $this->get_tracks($rsRelease->release_id);
				}
				return $rsRelease;
			}
			return $rowRelease;
		}
		return false;
	}
	
	public function get_tracks($release_id, $return_result = true) {
		$track_query = '';
		$track_query .= 'Select * From ep4_tracks as t ';
		$track_query .= 'Left Join ep4_songs as s on s.song_id = t.track_song_id ';
		$track_query .= 'Left Outer Join ep4_audio_map as am on am.map_track_id = t.track_id ';
		$track_query .= 'Left Outer Join ep4_audio as au on am.map_audio_id = au.audio_id ';
		$track_query .= 'Where t.track_release_id = ' . $release_id . ' ';
		$track_query .= 'Order By t.track_track_num';
		
		if (false !== ($rowTracks = $this->CI->db->query($track_query))) {
			if ($return_result === true) {
				$rsTracks = $this->return_smarty_array($rowTracks);
				return $rsTracks;
			}
			return $rowTracks;
		}
		return false;
	}
}

?>
