<?php
class Mt_mw_lyrics_model extends CI_Model
{
	var $lyrics_table = 'mw_lyrics';
	var $lyrics_table_index = 'lyric_id';
	var $lyrics_map_table = 'mw_lyrics_map';
	var $lyrics_map_table_index = 'lyric_map_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_files_by_artist_id($artist_id)
	{
		$this->db->order_by('lyric_file_name', 'asc');
		$rowFiles = $this->db->get_where($this->lyrics_table, array('lyric_artist_id' => $artist_id));
		return $rowFiles;
	}
	
	function get_lyric_by_id($lyric_id)
	{
		$rowLyric = $this->vigilantedblib->_get_record($this->lyrics_table, $this->lyrics_table_index, $lyric_id);
		$rsLyric = $this->vigilantedblib->_db_return_rs($rowLyric);
		return $rsLyric;
	}
	
	function get_lyric_map_by_id($map_id)
	{
		$rowMap = $this->vigilantedblib->_get_record($this->lyrics_map_table, $this->lyrics_map_table_index, $map_id);
		$rsMap = $this->vigilantedblib->_db_return_rs($rowMap);
		return $rsMap;
	}
	
	function get_lyric_mapped_to_track($release_id)
	{
		$this->db->from('mw_albums_tracks as t');
		$this->db->join('mw_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->join('mw_lyrics_map as m', 'm.lyric_map_track_id=t.track_id', 'left outer');
		$this->db->join('mw_lyrics as au', 'm.lyric_map_lyric_id=au.lyric_id', 'left outer');
		$this->db->where('au.map_id', $map_id);
		$rowLyric = $this->db->get();
		return $rowLyric;
	}
	
	function add_lyric_($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->lyrics_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function add_lyric_map($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->lyrics_map_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_lyric_by_id($lyric_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->lyrics_table, $this->lyrics_table_index, $lyric_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function update_lyric_map_by_id($map_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->lyrics_map_table, $this->lyrics_map_table_index, $map_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_lyric_by_id($lyric_id)
	{
		$where_function = is_array($lyric_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->lyrics_table_index, $lyric_id);
		if (false !== $this->db->delete($this->lyrics_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_lyric_map_by_id($map_id)
	{
		$where_function = is_array($map_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->lyrics_map_table_index, $map_id);
		if (false !== $this->db->delete($this->lyrics_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_lyric_maps_by_lyric_id($map_lyric_id)
	{
		$where_function = is_array($map_lyric_id) ? 'where_in' : 'where';
		$this->db->$where_function('lyric_map_lyric_id', $map_lyric_id);
		if (false !== $this->db->delete($this->lyrics_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_lyric_maps_by_track_id($map_track_id)
	{
		$where_function = is_array($map_track_id) ? 'where_in' : 'where';
		$this->db->$where_function('lyric_map_track_id', $map_track_id);
		if (false !== $this->db->delete($this->lyrics_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_lyric_maps_by_release_id($release_id)
	{
		$deleteQuery = '';
		$deleteQuery .= 'Delete m.* From mw_lyrics_map as m, ep4_tracks as t, mw_albums_releases as r ';
		$deleteQuery .= 'Where m.lyric_map_track_id=t.track_id ';
		$deleteQuery .= 'And t.track_release_id=r.release_id ';
		$deleteQuery .= is_array($release_id) ? 'And r.release_id In (' . join(',', $release_id) . ')' : 'And r.release_id = ' . intval($release_id);
		if (false !== $this->db->query($deleteQuery))
		{
			return true;
		}
		return false;
	}
	
}
?>