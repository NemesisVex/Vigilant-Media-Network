<?php
class Mt_mw_release_model extends CI_Model
{
	var $release_table = 'mw_albums_releases';
	var $release_table_index = 'release_id';
	var $mb_table = 'mw_albums_mb';
	var $mb_table_index = 'mb_id';
	var $discogs_table = 'mw_albums_discogs';
	var $discogs_table_index = 'discogs_id';
	
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
			$this->db->from('mw_albums_releases as r');
			$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_artists as ar', 'al.album_artist_id=ar.artist_id', 'left');
			$this->db->where('r.release_id', $release_id);
			$rowRelease = $this->db->get();
		}
		$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
		return $rsRelease;
	}
	
	function get_release_by_mb_gid($mb_album_mb_gid, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->mb_table, 'mb_album_mb_gid', $mb_album_mb_gid);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_album_mb_gid', $mb_album_mb_gid);
			if (false !== ($rowRelease = $this->db->get()))
			{
				return $rowRelease;
			}
			return false;
		}
	}

	function get_release_by_mb_id($mb_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->mb_table, 'mb_id', $mb_id);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left outer');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left outer');
			$this->db->where('mb.mb_id', $mb_id);
			if (false !== ($rowRelease = $this->db->get()))
			{
				return $rowRelease;
			}
			return false;
		}
	}

	function get_releases_by_mb_group_gid($mb_group_mb_gid, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->mb_table, 'mb_group_mb_gid', $mb_group_mb_gid);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_group_mb_gid', $mb_group_mb_gid);
			if (false !== ($rowRelease = $this->db->get()))
			{
				return $rowRelease;
			}
			return false;
		}
	}

	function get_musicbrainz_by_release_id($mb_release_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowReleases = $this->vigilantedblib->_get_record($this->mb_table, 'mb_release_id', $mb_release_id);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_release_id', $mb_release_id);
			if (false !== ($rowReleases = $this->db->get()))
			{
				return $rowReleases;
			}
			return false;
		}
	}

	function get_musicbrainz_by_mb_id($mb_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowReleases = $this->vigilantedblib->_get_record($this->mb_table, 'mb_id', $mb_id);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_id', $mb_id);
			if (false !== ($rowReleases = $this->db->get()))
			{
				return $rowReleases;
			}
			return false;
		}
	}

	function get_musicbrainz_by_artist_id($album_artist_id)
	{
		$this->db->from('mw_albums_mb as mb');
		$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left outer');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->join('mw_albums as al', 'mb.mb_album_id=al.album_id', 'left outer');
		$this->db->join('mw_artists as ar', 'al.album_artist_id=ar.artist_id', 'left');
		$this->db->where('al.album_artist_id', $album_artist_id);
		$this->db->order_by('al.album_release_date', 'desc');
		$this->db->order_by('r.release_release_date', 'desc');
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}
	
	function get_release_by_discog_id($discogs_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->discogs_table, 'discog_id', $discogs_id);
		}
		else
		{
			$this->db->from('mw_albums_discogs as d');
			$this->db->join('mw_albums_releases as r', 'd.discogs_release_id=r.release_id', 'left outer');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left outer');
			$this->db->where('d.discogs_id', $discogs_id);
			if (false !== ($rowRelease = $this->db->get()))
			{
				return $rowRelease;
			}
			return false;
		}
	}

	function get_discogs_by_artist_id($album_artist_id)
	{
		$this->db->from('mw_albums_discogs as d');
		$this->db->join('mw_albums_releases as r', 'd.discogs_release_id=r.release_id', 'left outer');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left outer');
		$this->db->join('mw_artists as ar', 'al.album_artist_id=ar.artist_id', 'left');
		$this->db->where('al.album_artist_id', $album_artist_id);
		$this->db->order_by('al.album_release_date', 'desc');
		$this->db->order_by('r.release_release_date', 'desc');
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}

	function get_discogs_by_release_id($discogs_release_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowReleases = $this->vigilantedblib->_get_record($this->discogs_table, 'discogs_release_id', $discogs_release_id);
		}
		else
		{
			$this->db->from('mw_albums_discogs as d');
			$this->db->join('mw_albums_releases as r', 'd.discogs_release_id=r.release_id', 'left outer');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left outer');
			$this->db->where('d.discogs_release_id', $discogs_release_id);
			if (false !== ($rowReleases = $this->db->get()))
			{
				return $rowReleases;
			}
			return false;
		}
	}

	function get_release_by_discogs_id($discogs_discog_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->discogs_table, 'discogs_discog_id', $discogs_discog_id);
		}
		else
		{
			$this->db->from('mw_albums_discogs as d');
			$this->db->join('mw_albums_releases as r', 'd.discogs_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'd.discogs_album_id=al.album_id', 'left');
			$this->db->where('d.discogs_discog_id', $discogs_discog_id);
			if (false !== ($rowRelease = $this->db->get()))
			{
				$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
				return $rsRelease;
			}
			return false;
		}
	}

	function get_releases_by_album_id($album_id, $fields = '*')
	{
		$this->db->select($fields);
		$this->db->from('mw_albums_releases as r');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->where('al.album_id', $album_id);
		$this->db->order_by('r.release_release_date', 'desc');
		$rowReleases = $this->db->get();
		return $rowReleases;
	}
	
	function get_releases_by_artist_id($album_artist_id, $fields = '*')
	{
		$this->db->select($fields);
		$this->db->from('mw_albums_releases as r');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
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
	
	function add_musicbrainz_map($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->mb_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function add_discogs_map($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->discogs_table, $input)))
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
	
	function update_musicbrainz_map_by_id($mb_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->mb_table, $this->mb_table_index, $mb_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function update_discogs_map_by_id($discogs_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->discogs_table, $this->discogs_table_index, $discogs_id, $input))
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
	
	function delete_musicbrainz_map_by_id($mb_id)
	{
		$where_function = is_array($mb_id) ? 'where_in' : 'where';
		$this->db->$where_function('mb_id', $mb_id);
		if (false !== $this->db->delete($this->mb_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_discogs_map_by_id($discogs_id)
	{
		$where_function = is_array($discogs_id) ? 'where_in' : 'where';
		$this->db->$where_function('discogs_id', $discogs_id);
		if (false !== $this->db->delete($this->discogs_table))
		{
			return true;
		}
		return false;
	}

	function delete_musicbrainz_map_by_album_id($mb_album_id)
	{
		$where_function = is_array($mb_album_id) ? 'where_in' : 'where';
		$this->db->$where_function('mb_album_id', $mb_album_id);
		if (false !== $this->db->delete($this->mb_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_musicbrainz_map_by_release_id($mb_release_id)
	{
		$where_function = is_array($mb_release_id) ? 'where_in' : 'where';
		$this->db->$where_function('mb_release_id', $mb_release_id);
		if (false !== $this->db->delete($this->mb_table))
		{
			return true;
		}
		return false;
	}
}
?>