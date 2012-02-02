<?php
class Ep4_ecommerce_model extends CI_Model
{
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_cd_ecommerce_links($release_id)
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->where('e.ecommerce_track_id', 0);
		$this->db->where('e.ecommerce_release_id', $release_id);
		$this->db->order_by('e.ecommerce_list_order','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_digital_ecommerce_links($release_id)
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->where('e.ecommerce_track_id <>', 0);
		$this->db->where('e.ecommerce_release_id', $release_id);
		$this->db->order_by('e.ecommerce_list_order','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_track_ecommerce_links($ecommerce_track_id)
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->where('e.ecommerce_track_id', $ecommerce_track_id);
		$this->db->order_by('e.ecommerce_list_order');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_links_by_album_id($album_id, $exclude_format = '')
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->join('ep4_albums_releases as r', 'e.ecommerce_release_id=r.release_id', 'left');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		if (!empty($exclude_format)) {$this->db->where('r.release_format_id <>', $exclude_format);}
		$this->db->where('e.ecommerce_track_id', 0);
		$this->db->where('al.album_id', $album_id);
		$this->db->order_by('e.ecommerce_list_order','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_links_by_release_id($release_id, $exclude_format = '')
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->join('ep4_albums_releases as r', 'e.ecommerce_release_id=r.release_id', 'left');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		if (!empty($exclude_format)) {$this->db->where('r.release_format_id <>', $exclude_format);}
		$this->db->where('e.ecommerce_track_id', 0);
		$this->db->where('r.release_id', $release_id);
		$this->db->order_by('e.ecommerce_list_order','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_links_with_tracks_by_release_id($release_id, $exclude_format = '', $ecommerce_label = '')
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->join('ep4_tracks as t', 'e.ecommerce_track_id=t.track_id', 'left');
		$this->db->join('ep4_albums_releases as r', 't.track_release_id=r.release_id', 'left');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		if (!empty($exclude_format)) {$this->db->where('r.release_format_id <>', $exclude_format);}
		if (!empty($ecommerce_label)) {$this->db->where('e.ecommerce_label', $ecommerce_label);}
		$this->db->where('r.release_id', $release_id);
		$this->db->order_by('t.track_track_num','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_links_by_track_id($track_id, $exclude_format = '', $null_track_id = 'null')
	{
		$this->db->from('ep4_ecommerce as e');
		$this->db->join('ep4_albums_releases as r', 'e.ecommerce_release_id=r.release_id', 'left');
		$this->db->join('ep4_albums as al', 'r.release_album_id=al.album_id', 'left');
		if (!empty($exclude_format)) {$this->db->where('r.release_format_id <>', $exclude_format);}
		$this->db->where('e.ecommerce_track_id', $track_id);
		$this->db->order_by('e.ecommerce_list_order','asc');
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
}
?>