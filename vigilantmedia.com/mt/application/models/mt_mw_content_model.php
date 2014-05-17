<?php
class Mt_mw_content_model extends CI_Model
{
	var $content_map_table = 'mw_content';
	var $content_map_table_index = 'content_id';
	var $blog_id = 12;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_maps_by_entry_id($entry_id)
	{
		$this->db->from('mw_content as c');
		$this->db->join('mt_entry as e', 'c.content_entry_id=e.entry_id', 'left');
		$this->db->join('mw_albums_releases as r', 'c.content_release_id=r.release_id', 'left outer');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left outer');
		$this->db->join('mw_artists as ar', 'c.content_artist_id=ar.artist_id', 'left outer');
		$this->db->where('e.entry_id', $entry_id);
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
	
	function delete_content_maps_by_album_id($album_id)
	{
		$where_function = is_array($album_id) ? 'where_in' : 'where';
		$this->db->$where_function('content_album_id', $album_id);
		if (false !== $this->db->delete($this->content_map_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_content_maps_by_artist_id($artist_id)
	{
		$where_function = is_array($artist_id) ? 'where_in' : 'where';
		$this->db->$where_function('content_artist_id', $artist_id);
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