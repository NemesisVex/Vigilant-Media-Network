<?php
class Mt_ep4_content_model extends CI_Model
{
	var $content_map_table = 'ep4_content';
	var $content_map_table_index = 'content_id';
	var $blog_id = 12;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_maps_by_entry_id($entry_id)
	{
		$this->db->from('ep4_content as c');
		$this->db->join('mt_entry as e', 'c.content_entry_id=e.entry_id', 'left');
		$this->db->join('ep4_tracks as t', 'c.content_track_id=t.track_id', 'left');
		$this->db->join('ep4_albums_releases as r', 'c.content_release_id=r.release_id', 'left');
		$this->db->join('ep4_songs as s', 't.track_song_id=s.song_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left');
		$this->db->join('ep4_albums as a', 'r.release_album_id=a.album_id', 'left');
		$this->db->where('e.entry_id', $entry_id);
		$rowEntries = $this->db->get();
		return $rowEntries;
	}
	
	function get_maps_by_release_id($release_id)
	{
		$this->db->from('ep4_content as c');
		$this->db->join('mt_entry as e', 'c.content_entry_id=e.entry_id', 'left');
		$this->db->join('ep4_tracks as t', 'c.content_track_id=t.track_id', 'left outer');
		$this->db->join('ep4_albums_releases as r', 'c.content_release_id=r.release_id', 'left');
		$this->db->join('ep4_songs as s', 't.track_song_id=s.song_id', 'left outer');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->join('ep4_albums as a', 'r.release_album_id=a.album_id', 'left');
		$this->db->where('r.release_id', $release_id);
		$rowEntries = $this->db->get();
		return $rowEntries;
	}
	
	function get_content_map_by_id($content_id)
	{
		$rowContent = $this->vigilantedblib->_get_record($this->content_map_table, $this->content_map_table_index, $content_id);
		$rsContent = $this->vigilantedblib->_db_return_rs($rowContent);
		return $rsContent;
	}
	
	function add_content_map($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->content_map_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_content_map_by_id($content_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->content_map_table, $this->content_map_table_index, $content_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_content_map_by_id($content_id)
	{
		$where_function = is_array($content_id) ? 'where_in' : 'where';
		$this->db->$where_function($this->content_map_table_index, $content_id);
		if (false !== $this->db->delete($this->content_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_content_maps_by_release_id($release_id)
	{
		$where_function = is_array($release_id) ? 'where_in' : 'where';
		$this->db->$where_function('content_release_id', $release_id);
		if (false !== $this->db->delete($this->content_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_content_maps_by_track_id($track_id)
	{
		$where_function = is_array($track_id) ? 'where_in' : 'where';
		$this->db->$where_function('content_track_id', $track_id);
		if (false !== $this->db->delete($this->content_map_table))
		{
			return true;
		}
		return false;
	}
}
?>