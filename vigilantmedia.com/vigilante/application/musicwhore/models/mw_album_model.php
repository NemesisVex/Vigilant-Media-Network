<?php
class Mw_album_model extends CI_Model
{
	var $album_table = 'mw_albums';
	var $album_table_index = 'album_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_album_by_id($album_id, $return_type = '')
	{
		if (false !== ($rowAlbum = $this->vigilantedblib->_get_record($this->album_table, $this->album_table_index, $album_id)))
		{
			switch ($return_type)
			{
				case 'row':
					return $rowAlbum;
					break;
				default:
					$rsAlbum = $this->vigilantedblib->_db_return_rs($rowAlbum);
					return $rsAlbum;
			}
		}
		return false;
	}
	
	function get_albums_by_artist_id($album_artist_id)
	{
		$this->db->order_by('album_title');
		if (false !== ($rowAlbums = $this->db->get_where($this->album_table, array('album_artist_id' => $album_artist_id))))
		{
			return $rowAlbums;
		}
		return false;
	}
	
	function get_album_formats()
	{
		$this->db->from('mw_albums_formats');
		$this->db->order_by('format_name');
		if (false !== ($rowFormats = $this->db->get()))
		{
			return $rowFormats;
		}
		return false;
	}
	
	function get_musicbrainz_by_album_id($album_id)
	{
		$this->db->from('mw_albums_mb as mb');
		$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
		$this->db->where('al.album_id', $album_id);
		if (false !== ($rowAlbums = $this->db->get()))
		{
			return $rowAlbums;
		}
		return false;
	}
}
?>