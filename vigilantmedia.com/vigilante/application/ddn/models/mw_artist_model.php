<?php
class Mw_artist_model extends CI_Model
{
	var $artist_table = 'mw_artists';
	var $artist_table_index = 'artist_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// Music methods
	function get_all_artists($filter = '', $artist_setting_mask = 16)
	{
		if (!empty($artist_setting_mask))
		{
			$this->db->where('(artist_settings_mask & '. $artist_setting_mask .')=' . $artist_setting_mask);
		}
		$this->db->order_by('artist_last_name', 'asc');
		if (!empty($filter)) {$this->db->like('artist_last_name', $filter, 'after');}
		
		if (false !== ($rowArtists = $this->db->get($this->artist_table)))
		{
			return $rowArtists;
		}
		return false;
	}
	
	function get_all_artists_group_by_initial($artist_setting_mask = 16)
	{
		//Select Upper(Substring(artist_last_name From 1 For 1)) as nav From mw_artists Group By nav Order By nav
		$this->db->select('Upper(Substring(artist_last_name From 1 For 1)) as nav');
		$this->db->from($this->artist_table);
		if (!empty($artist_setting_mask))
		{
			$this->db->where('(artist_settings_mask & '. $artist_setting_mask .')=' . $artist_setting_mask);
		}
		$this->db->group_by('nav');
		$this->db->order_by('nav');
		
		if (false !== ($rowArtists = $this->db->get()))
		{
			return $rowArtists;
		}
		return false;
	}
	
	function get_artist_by_id($artist_id)
	{
		$rowArtist = $this->vigilantedblib->_get_record($this->artist_table, $this->artist_table_index, $artist_id);
		$rsArtist = $this->vigilantedblib->_db_return_rs($rowArtist);
		return $rsArtist;
	}
	
	function get_artists_by_settings_mask($settings_mask, $order_by = 'artist_last_name asc')
	{
		$this->db->from($this->artist_table);
		$this->db->where('(artist_settings_mask & ' . $settings_mask . ') = ' . $settings_mask);
		if (!empty($order_by)) {$this->db->order_by($order_by);}
		if (false !== ($rowArtists = $this->db->get()))
		{
			return $rowArtists;
		}
	}
}
?>