<?php
class Mt_ep4_album_model extends CI_Model
{
	var $album_table = 'ep4_albums';
	var $album_table_index = 'album_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_album_by_id($album_id)
	{
		$rowAlbum = $this->vigilantedblib->_get_record($this->album_table, $this->album_table_index, $album_id);
		$rsAlbum = $this->vigilantedblib->_db_return_rs($rowAlbum);
		return $rsAlbum;
	}
	
	function get_albums_by_artist_id($album_artist_id)
	{
		$this->db->order_by('album_title');
		$rowAlbums = $this->db->get_where($this->album_table, array('album_artist_id' => $album_artist_id));
		return $rowAlbums;
	}
	
	function add_album($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->album_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_album_by_id($album_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->album_table, $this->album_table_index, $album_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_album_by_id($album_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->album_table, $this->album_table_index, $album_id))
		{
			return true;
		}
		return false;
	}
}
?>