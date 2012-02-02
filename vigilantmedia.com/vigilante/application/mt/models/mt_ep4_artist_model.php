<?php
class Mt_ep4_artist_model extends CI_Model
{
	var $artist_table = 'ep4_artists';
	var $artist_table_index = 'artist_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// Music methods
	function get_all_artists()
	{
		$this->db->order_by('artist_last_name', 'asc');
		if (false !== ($rowArtists = $this->db->get($this->artist_table)))
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
	
	function add_artist($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->artist_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_artist_by_id($artist_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->artist_table, $this->artist_table_index, $artist_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_artist_by_id($artist_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->artist_table, $this->artist_table_index, $artist_id))
		{
			return true;
		}
		return false;
	}
}
?>