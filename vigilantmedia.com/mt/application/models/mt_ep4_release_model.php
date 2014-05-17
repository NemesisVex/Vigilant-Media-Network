<?php
class Mt_ep4_release_model extends CI_Model
{
	var $release_table = 'ep4_albums_releases';
	var $release_table_index = 'release_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_release_by_id($release_id, $simple = false, $fields = '*')
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->release_table, $this->release_table_index, $release_id);
		}
		else
		{
			$this->db->select($fields);
			$this->db->from('ep4_albums_releases as r');
			$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('ep4_artists as ar', 'al.album_artist_id=ar.artist_id', 'left');
			$this->db->where('r.release_id', $release_id);
			$rowRelease = $this->db->get();
		}
		if (false !== ($rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease)))
		{
			return $rsRelease;
		}
		return false;
	}
	
	function get_releases_by_album_id($album_id, $fields = '*')
	{
		$this->db->select($fields);
		$this->db->from('ep4_albums_releases as r');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->where('al.album_id', $album_id);
		$this->db->order_by('r.release_release_date', 'desc');
		$rowReleases = $this->db->get();
		return $rowReleases;
	}
	
	function get_releases_by_artist_id($album_artist_id, $fields = '*')
	{
		$this->db->select($fields);
		$this->db->from('ep4_albums_releases as r');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->where('al.album_artist_id', $album_artist_id);
		$this->db->order_by('r.release_release_date', 'desc');
		$rowReleases = $this->db->get();
		return $rowReleases;
	}
	
	function get_formats()
	{
		$this->db->order_by('format_name', 'asc');
		$rowFormats = $this->db->get('mw_albums_formats');
		return $rowFormats;
	}
	
	function add_release($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->release_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_release_by_id($release_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->release_table, $this->release_table_index, $release_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_release_by_id($release_id)
	{
		$where_function = is_array($release_id) ? 'where_in' : 'where';
		$this->db->$where_function('release_id', $release_id);
		if (false !== $this->db->delete($this->release_table))
		{
			return true;
		}
		return false;
	}
}
?>