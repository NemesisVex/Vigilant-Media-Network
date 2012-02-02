<?php
class Mw_tracks_model extends CI_Model
{
	var $track_table = 'mw_albums_tracks';
	var $track_table_index = 'track_id';
	var $itunes_merchant_id = 7;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_track_by_id($track_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowTrack = $this->vigilantedblib->_get_record($this->track_table, $this->track_table_index, $track_id);
		}
		else
		{
			$this->db->from('mw_albums_tracks as t');
			$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
			$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
			$this->db->where('t.track_id', $track_id);
			$rowTrack = $this->db->get();
		}
		$rsTrack = $this->vigilantedblib->_db_return_rs($rowTrack);
		return $rsTrack;
	}
	
	function get_tracks_by_release_id($release_id)
	{
		$this->db->select('t.*, lm.*');
		$this->db->from('mw_albums_tracks as t');
		$this->db->join('mw_lyrics_map as lm', 'lm.lyric_map_track_id=t.track_id', 'left outer');
		//$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		//$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		//$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		//$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->where('t.track_release_id', $release_id);
		$this->db->order_by('t.track_disc_num', 'asc');
		$this->db->order_by('t.track_track_num', 'asc');
		$rowTracks = $this->db->get();
		return $rowTracks;
	}
	
	function get_tracks_mapped_to_lyric($release_id)
	{
		$this->db->from('mw_albums_tracks as t');
		$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->join('mw_lyrics_map as m', 'm.lyric_map_track_id=t.track_id', 'left outer');
		$this->db->join('mw_lyrics as l', 'm.lyric_map_lyric_id=l.lyric_id', 'left outer');
		$this->db->where('r.release_id', $release_id);
		$this->db->order_by('t.track_disc_num', 'asc');
		$this->db->order_by('t.track_track_num', 'asc');
		
		$rowTrack = $this->db->get();
		return $rowTrack;
	}
	
	function get_itunes_tracks_by_release_id($track_release_id)
	{
		$this->db->from('mw_albums_tracks as t');
		$this->db->join('mw_ecommerce as e', 'e.ecommerce_field_id=t.track_id', 'left outer');
		$this->db->where('e.ecommerce_field_type', 'track_id');
		$this->db->where('e.ecommerce_merchant_id', $this->itunes_merchant_id);
		$this->db->where('t.track_release_id', $track_release_id);
		$this->db->order_by('t.track_disc_num', 'asc');
		$this->db->order_by('t.track_track_num', 'asc');
		if (false !== ($rowITunesTracks = $this->db->get()))
		{
			return $rowITunesTracks;
		}
		return false;
	}
}
?>