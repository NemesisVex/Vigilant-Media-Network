<?php
class Mt_mw_song_model extends CI_Model
{
	var $song_table = 'mw_songs';
	var $song_table_index = 'song_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_songs()
	{
		$this->db->order_by('song_title', 'asc');
		if (false !== ($rowSongs = $this->db->get($this->song_table)))
		{
			return $rowSongs;
		}
		return false;
	}
	
	function get_song_by_id($song_id)
	{
		$rowSong = $this->vigilantedblib->_get_record($this->song_table, $this->song_table_index, $song_id);
		$rsSong = $this->vigilantedblib->_db_return_rs($rowSong);
		return $rsSong;
	}
	
	function add_song($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->song_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_song_by_id($song_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->song_table, $this->song_table_index, $song_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_song_by_id($song_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->song_table, $this->song_table_index, $song_id))
		{
			return true;
		}
		return false;
	}
}
?>