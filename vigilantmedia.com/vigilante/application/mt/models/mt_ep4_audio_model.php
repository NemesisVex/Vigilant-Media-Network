<?php
class Mt_ep4_audio_model extends CI_Model
{
	var $audio_table = 'ep4_audio';
	var $audio_table_index = 'audio_id';
	var $audio_map_table = 'ep4_audio_map';
	var $audio_map_table_index = 'map_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_files_by_artist_id($artist_id)
	{
		$this->db->order_by('audio_mp3_file_path', 'asc');
		$this->db->order_by('audio_mp3_file_name', 'asc');
		$rowFiles = $this->db->get_where($this->audio_table, array('audio_artist_id' => $artist_id));
		return $rowFiles;
	}
	
	function get_audio_by_id($audio_id)
	{
		$rowAudio = $this->vigilantedblib->_get_record($this->audio_table, $this->audio_table_index, $audio_id);
		$rsAudio = $this->vigilantedblib->_db_return_rs($rowAudio);
		return $rsAudio;
	}
	
	function get_audio_map_by_id($map_id)
	{
		$rowMap = $this->vigilantedblib->_get_record($this->audio_map_table, $this->audio_map_table_index, $map_id);
		$rsMap = $this->vigilantedblib->_db_return_rs($rowMap);
		return $rsMap;
	}
	
	function get_audio_by_file_path($file_name, $file_path) {
		$this->db->from($this->audio_table);
		$this->db->where('audio_mp3_file_name', $file_name);
		$this->db->where('audio_mp3_file_path', $file_path);
		
		if (false !== ($row = $this->db->get())) {
			return $row;
		}
		
		return false;
	}
	
	function get_audio_mapped_to_track($release_id)
	{
		/*
		$trackQuery = '';
		$trackQuery .= 'Select * From ((((((ep4_tracks as t Left Join ep4_albums_releases as r on t.track_release_id=r.release_id) ';
		$trackQuery .= 'Left Join ep4_albums as al on r.release_album_id=al.album_id) ';
		$trackQuery .= 'Left Join ep4_songs as s on t.track_song_id=s.song_id) ';
		$trackQuery .= 'Left Join mw_albums_formats as f on r.release_format_id=f.format_id) ';
		$trackQuery .= 'Left Outer Join ep4_audio_map as m on m.map_track_id=t.track_id) ';
		$trackQuery .= 'Left Outer Join ep4_audio as au on m.map_audio_id=au.audio_id) ';
		$trackQuery .= 'Where au.map_id = ' . intval($map_id) . ' ';
		$rowAudio = $this->db->query($trackQuery);
		*/
		
		$this->db->from('ep4_tracks as t');
		$this->db->join('ep4_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('ep4_songs as s', 't.track_song_id=s.song_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->join('ep4_audio_map as m', 'm.map_track_id=t.track_id', 'left outer');
		$this->db->join('ep4_audio as au', 'm.map_audio_id=au.audio_id', 'left outer');
		$this->db->where('au.map_id', $map_id);
		$rowAudio = $this->db->get();
		return $rowAudio;
	}
	
	function get_user_log()
	{
		$this->db->order_by('log_date_added', 'desc');
		$rowLogs = $this->db->get('ep4_audio_log');
		return $rowLogs;
	}
	
	function add_audio($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->audio_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function add_audio_map($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->audio_map_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_audio_by_id($audio_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->audio_table, $this->audio_table_index, $audio_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function update_audio_map_by_id($map_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->audio_map_table, $this->audio_map_table_index, $map_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_by_id($audio_id)
	{
		$where_function = is_array($audio_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->audio_table_index, $audio_id);
		if (false !== $this->db->delete($this->audio_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_by_song_id($song_id)
	{
		$where_function = is_array($song_id) ? 'where_in' : 'where';
		$this->db->$where_function('audio_song_id', $song_id);
		if (false !== $this->db->delete($this->audio_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_map_by_id($map_id)
	{
		$where_function = is_array($map_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->audio_map_table_index, $map_id);
		if (false !== $this->db->delete($this->audio_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_maps_by_audio_id($map_audio_id)
	{
		$where_function = is_array($map_audio_id) ? 'where_in' : 'where';
		$this->db->$where_function('map_audio_id', $map_audio_id);
		if (false !== $this->db->delete($this->audio_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_maps_by_track_id($map_track_id)
	{
		$where_function = is_array($map_track_id) ? 'where_in' : 'where';
		$this->db->$where_function('map_track_id', $map_track_id);
		if (false !== $this->db->delete($this->audio_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_audio_maps_by_release_id($release_id)
	{
		$deleteQuery = '';
		$deleteQuery .= 'Delete m.* From ep4_audio_map as m, ep4_tracks as t, ep4_albums_releases as r ';
		$deleteQuery .= 'Where m.map_track_id=t.track_id ';
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