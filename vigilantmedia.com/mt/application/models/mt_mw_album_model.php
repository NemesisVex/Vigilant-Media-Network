<?php
class Mt_mw_album_model extends CI_Model
{
	var $album_table = 'mw_albums';
	var $album_table_index = 'album_id';
	var $mb_table = 'mw_albums_mb';
	var $mb_table_index = 'mb_id';
	var $discogs_table = 'mw_albums_discogs';
	var $discogs_table_index = 'discogs_id';
	
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
	
	function get_musicbrainz_by_album_id($mb_album_id)
	{
		$this->db->from('mw_albums_mb as mb');
		$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
		$this->db->where('mb.mb_album_id', $mb_album_id);
		if (false !== ($rowAlbums = $this->db->get()))
		{
			return $rowAlbums;
		}
		return false;
	}

	function get_album_by_mb_gid($mb_group_mb_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowAlbums = $this->vigilantedblib->_get_record($this->mb_table, 'mb_group_mb_gid', $mb_group_mb_id);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_group_mb_gid', $mb_group_mb_id);
			$this->db->group_by('mb_group_mb_gid');
			if (false !== ($rowAlbums = $this->db->get()))
			{
				return $rowAlbums;
			}
			return false;
		}
	}

	function get_albums_by_discogs_id($discogs_discog_id)
	{
		$this->db->from('mw_albums_discogs as d');
		$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left');
		$this->db->where('d.discogs_discog_id', $discogs_discog_id);
		if (false !== ($rowAlbums = $this->db->get()))
		{
			return $rowAlbums;
		}
		return false;
	}

	function get_discogs_by_album_and_release_id($discogs_album_id, $discogs_discog_id)
	{
		$this->db->from('mw_albums_discogs as d');
		$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left');
		$this->db->where('d.discogs_discog_id', $discogs_discog_id);
		$this->db->where('d.discogs_album_id', $discogs_album_id);
		if (false !== ($rowAlbums = $this->db->get()))
		{
			return $rowAlbums;
		}
		return false;
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
	
	function delete_albums_by_artist_id($album_artist_id)
	{
		$where_function = is_array($album_artist_id) ? 'where_in' : 'where';
		$this->db->$where_function('album_artist_id', $album_artist_id);
		if (false !== $this->db->delete($this->album_table))
		{
			return true;
		}
		return false;
	}
}
?>