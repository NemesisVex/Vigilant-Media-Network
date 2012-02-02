<?php
class Mw_content_model extends CI_Model
{
	var $content_map_table = 'mw_content';
	var $content_map_table_index = 'content_id';
	var $blog_id = 4; //archive only
	var $blog_ids = array(4, 8); //archive and current
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_maps_by_entry_id($entry_id)
	{
		$this->db->from('mw_content as c');
		$this->db->join('mt_entry as e', 'c.content_entry_id=e.entry_id', 'left');
		$this->db->join('mw_albums as al', 'c.content_album_id=al.album_id', 'left outer');
		$this->db->join('mw_artists as ar', 'c.content_artist_id=ar.artist_id', 'left outer');
		$this->db->where('e.entry_id', $entry_id);
		$rowEntries = $this->db->get();
		return $rowEntries;
	}
	
	function get_content_map_by_id($content_id)
	{
		$rowContent = $this->vigilantedblib->_get_record($this->content_map_table, $this->content_map_table_index, $content_id);
		$rsContent = $this->vigilantedblib->_db_return_rs($rowContent);
		return $rsContent;
	}
	
	function get_content_by_artist_id($content_artist_id, $blog_id = '')
	{
		if (empty($blog_id)) {$blog_id = $this->blog_ids;}
		$where = is_array($blog_id) ? 'where_in' : 'where';
		
		$this->db->from('mt_entry as e');
		$this->db->join('mw_content as con', 'con.content_entry_id=e.entry_id', 'left');
		$this->db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left');
		$this->db->join('mt_category as c', 'p.placement_category_id=c.category_id', 'left');
		$this->db->where('e.entry_status', 2);
		$this->db->where('e.entry_created_on <= Now()');
		$this->db->$where('e.entry_blog_id', $blog_id);
		$this->db->where('con.content_artist_id', $content_artist_id);
		$this->db->order_by('e.entry_created_on', 'desc');
		if (false !== ($rowEntries = $this->db->get()))
		{
			return $rowEntries;
		}
		return false;
	}
	
	function get_content_by_film_initial($filter = 'a', $blog_id = '')
	{
		if (empty($blog_id)) {$blog_id = $this->blog_ids;}
		$where = is_array($blog_id) ? 'where_in' : 'where';
		
		$this->db->from('mt_entry as e');
		$this->db->join('mw_content as con', 'con.content_entry_id=e.entry_id', 'left');
		$this->db->join('mw_films as f', 'con.content_film_id=f.film_id', 'left');
		//$this->db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left outer');
		//$this->db->join('mt_category as c', 'p.placement_category_id=c.category_id', 'left outer');
		$this->db->where('e.entry_status', 2);
		$this->db->where('e.entry_created_on <= Now()');
		$this->db->like('f.film_title', $filter, 'after');
		$this->db->order_by('f.film_title', 'asc');
		if (false !== ($rowEntries = $this->db->get()))
		{
			return $rowEntries;
		}
		return false;
	}
}
?>