<?php
class Mw_release_model extends CI_Model
{
	var $release_table = 'mw_albums_releases';
	var $release_table_index = 'release_id';
	var $mb_table = 'mw_albums_mb';
	var $mb_table_index = 'mb_id';
	var $itunes_merchant_id = 7;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_release_by_id($release_id, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->release_table, $this->release_table_index, $release_id);
		}
		else
		{
			$this->_build_release_query();
			$this->db->where('r.release_id', $release_id);
			$rowRelease = $this->db->get();
		}
		$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
		return $rsRelease;
	}
	
	function get_release_by_mb_gid($mb_gid, $simple = false)
	{
		if ($simple == true)
		{
			$rowRelease = $this->vigilantedblib->_get_record($this->mb_table, 'mb_album_mb_gid', $mb_gid);
		}
		else
		{
			$this->db->from('mw_albums_mb as mb');
			$this->db->join('mw_albums_releases as r', 'mb.mb_release_id=r.release_id', 'left');
			$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
			$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
			$this->db->where('mb.mb_album_mb_gid', $mb_gid);
			if (false !== ($rowRelease = $this->db->get()))
			{
				$rsRelease = $this->vigilantedblib->_db_return_rs($rowRelease);
				return $rsRelease;
			}
			return false;
		}
	}
	
	function get_mb_gids_by_release_id($mb_release_id)
	{
		if (false !== ($rowMusicbrainz = $this->vigilantedblib->_get_record($this->mb_table, 'mb_release_id', $mb_release_id)))
		{
			return $rowMusicbrainz;
		}
		return false;
	}
	
	function get_releases_by_album_id($album_id, $fields = '*', $release_country_name = '')
	{
		$this->db->select($fields);
		$this->db->from('mw_albums_releases as r');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left');
		$this->db->join('mw_albums_formats as f', 'r.release_format_id=f.format_id', 'left outer');
		$this->db->where('al.album_id', $album_id);
		if (!empty($release_country_name))
		{
			$this->db->where('r.release_country_name', $release_country_name);
		}
		$this->db->order_by('r.release_release_date', 'desc');
		
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return $rowReleases;
	}
	
	function get_releases_by_artist_id($album_artist_id, $album_format_mask = 2)
	{
		$this->_build_release_query();
		$this->db->where('al.album_format_mask', $album_format_mask);
		$this->db->where('al.album_artist_id', $album_artist_id);
		$this->db->or_where('al.album_soloist_id', $album_artist_id);
		$this->db->or_where('al.album_conductor_id', $album_artist_id);
		$this->db->or_where('al.album_ensemble_id', $album_artist_id);
		$this->db->order_by('al.album_release_date', 'desc');
		$this->db->order_by('al.album_id', 'asc');
		$this->db->order_by('r.release_release_date', 'desc');
		$this->db->order_by('r.release_catalog_num', 'asc');
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}
	
	function get_artist_releases_by_format_mask($album_artist_id)
	{
		$this->db->select('album_format_mask');
		$this->db->from('mw_albums as al');
		$this->db->where('al.album_format_mask is not null');
		$this->db->where('al.album_artist_id', $album_artist_id);
		$this->db->or_where('al.album_soloist_id', $album_artist_id);
		$this->db->or_where('al.album_conductor_id', $album_artist_id);
		$this->db->or_where('al.album_ensemble_id', $album_artist_id);
		$this->db->group_by('album_format_mask');
		$this->db->order_by('album_format_mask');
		if (false !== ($rowReleases = $this->db->get()))
		{
			return $rowReleases;
		}
		return false;
	}
	
	function get_itunes_by_release_id($release_id)
	{
		$this->db->from('mw_albums_releases as r');
		$this->db->join('mw_ecommerce as e', 'e.ecommerce_field_id=r.release_id');
		$this->db->where('e.ecommerce_field_type', 'release_id');
		$this->db->where('e.ecommerce_merchant_id', $this->itunes_merchant_id);
		$this->db->where('r.release_id', $release_id);
		if (false !== ($rowITunes = $this->db->get()))
		{
			$rsITunes = $this->vigilantedblib->_db_return_rs($rowITunes);
			return $rsITunes;
		}
		return false;
	}
	
	function get_formats()
	{
		$this->db->order_by('format_name', 'asc');
		$rowFormats = $this->db->get('mw_albums_formats');
		return $rowFormats;
	}
	
	// Private methods
	
	function _build_release_query()
	{
		$this->db->select('al.*, r.*, f.*,
		s.artist_last_name as soloist_artist_last_name, s.artist_first_name as soloist_artist_first_name, s.artist_soloist_part as soloist_part,
		c.artist_last_name as conductor_last_name, c.artist_first_name as conductor_artist_first_name,
		e.artist_last_name as ensemble_artist_last_name');
		$this->db->from('mw_albums_releases as r');
		$this->db->join('mw_albums as al', 'r.release_album_id=al.album_id', 'left outer');
		$this->db->join('mw_albums_formats as f', 'f.format_id=r.release_format_id', 'left');
		$this->db->join('mw_artists as s', 'al.album_soloist_id=s.artist_id', 'left');
		$this->db->join('mw_artists as c', 'al.album_conductor_id=c.artist_id', 'left');
		$this->db->join('mw_artists as e', 'al.album_ensemble_id=e.artist_id', 'left');
	}
}
?>