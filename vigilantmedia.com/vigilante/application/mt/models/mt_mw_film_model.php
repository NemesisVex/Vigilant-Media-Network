<?php
class Mt_mw_film_model extends CI_Model
{
	var $film_table = 'mw_films';
	var $film_table_index = 'film_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// Music methods
	function get_all_films($filter = '')
	{
		$this->db->order_by('film_title', 'asc');
		if (!empty($filter)) {$this->db->like('film_title', $filter, 'after');}
		if (false !== ($rowFilms = $this->db->get($this->film_table)))
		{
			return $rowFilms;
		}
		return false;
	}
	
	function get_all_films_group_by_initial()
	{
		//Select Upper(Substring(artist_last_name From 1 For 1)) as nav From mw_artists Group By nav Order By nav
		$this->db->select('Upper(Substring(film_title From 1 For 1)) as nav');
		$this->db->from($this->film_table);
		$this->db->group_by('nav');
		$this->db->order_by('nav');
		if (false !== ($rowFilms = $this->db->get()))
		{
			return $rowFilms;
		}
		return false;
	}
	
	function get_film_by_id($film_id)
	{
		$rowArtist = $this->vigilantedblib->_get_record($this->film_table, $this->film_table_index, $film_id);
		$rsArtist = $this->vigilantedblib->_db_return_rs($rowArtist);
		return $rsArtist;
	}
	
	function add_film($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->film_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_film_by_id($film_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->film_table, $this->film_table_index, $film_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_film_by_id($film_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->film_table, $this->film_table_index, $film_id))
		{
			return true;
		}
		return false;
	}
}
?>