<?php
class Mt_mw_related_model extends CI_Model
{
	var $related_table = 'mw_artists_related';
	var $related_table_index = 'related_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_related_by_id($related_id, $return_type = '')
	{
		if (false !== ($rowRelated = $this->vigilantedblib->_get_record($this->related_table, $this->related_table_index, $related_id)))
		{
			switch ($return_type)
			{
				case 'row':
					return $rowRelated;
					break;
				default:
					$rsRelated = $this->vigilantedblib->_db_return_rs($rowRelated);
					return $rsRelated;
			}
		}
		return false;
	}
	
	function get_related_by_artist_id($related_artist_id)
	{
		$this->db->from($this->related_table . ' as r');
		$this->db->join('mw_artists as ar', 'r.related_relation_id=ar.artist_id');
		$this->db->where('r.related_artist_id', $related_artist_id);
		$this->db->order_by('ar.artist_last_name', 'asc');
		$this->db->order_by('ar.artist_first_name', 'asc');
		if (false !== ($rowRelations = $this->db->get()))
		{
			return $rowRelations;
		}
		return false;
	}
	
	function get_reciprocal_related_by_artist_id($related_relation_id)
	{
		$this->db->from($this->related_table . ' as r');
		$this->db->join('mw_artists as ar', 'r.related_artist_id=ar.artist_id');
		$this->db->where('r.related_relation_id', $related_relation_id);
		$this->db->order_by('ar.artist_last_name', 'asc');
		$this->db->order_by('ar.artist_first_name', 'asc');
		if (false !== ($rowRelations = $this->db->get()))
		{
			return $rowRelations;
		}
		return false;
	}
	
	function add_related($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->related_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_related_by_id($related_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->related_table, $this->related_table_index, $related_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_related_by_id($related_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->related_table, $this->related_table_index, $related_id))
		{
			return true;
		}
		return false;
	}
	
	function delete_related_by_artist_id($related_artist_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->related_table, 'related_artist_id', $related_artist_id))
		{
			return true;
		}
		return false;
	}
	
	function delete_related_by_relation_id($related_relation_id)
	{
		if (false !== $this->vigilantedblib->_delete_record($this->related_table, 'related_relation_id', $related_relation_id))
		{
			return true;
		}
		return false;
	}
}
?>