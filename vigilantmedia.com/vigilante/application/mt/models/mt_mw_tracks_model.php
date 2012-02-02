<?php
class Mt_mw_tracks_model extends CI_Model
{
	var $track_table = 'mw_albums_tracks';
	var $track_table_index = 'track_id';
	
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
		$this->db->from('mw_albums_tracks as t');
		$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->where('r.release_id', $release_id);
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
	
	function add_track($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->track_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_track_by_id($track_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->track_table, $this->track_table_index, $track_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_track_by_id($track_id)
	{
		$where_function = is_array($track_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->track_table_index, $track_id);
		if (false !== $this->db->delete($this->track_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_tracks_by_release_id($release_id)
	{
		$where_function = is_array($release_id) ? 'where_in' : 'where';
		$this->db->$where_function('track_release_id', $release_id);
		if (false !== $this->db->delete($this->track_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_tracks_by_song_id($song_id)
	{
		$where_function = is_array($song_id) ? 'where_in' : 'where';
		$this->db->$where_function('track_song_id', $song_id);
		if (false !== $this->db->delete($this->track_table))
		{
			return true;
		}
		return false;
	}
}
?>