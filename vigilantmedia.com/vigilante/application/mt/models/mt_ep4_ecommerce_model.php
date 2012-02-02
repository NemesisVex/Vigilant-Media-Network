<?php
class Mt_ep4_ecommerce_model extends CI_Model
{
	var $ecommerce_table = 'ep4_ecommerce';
	var $ecommerce_table_index = 'ecommerce_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_ecommerce_links_by_release_id($ecommerce_release_id, $ecommerce_track_id = '')
	{
		$this->db->where('ecommerce_release_id', $ecommerce_release_id);
		!empty($ecommerce_track_id) ? $this->db->where('ecommerce_track_id', $ecommerce_track_id) : $this->db->where('ecommerce_track_id', 0);
		$this->db->order_by('ecommerce_list_order');
		if (false !== ($rowEcomm = $this->db->get($this->ecommerce_table)))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_link_by_id($ecommerce_id)
	{
		if (false !== ($rowEcomm = $this->vigilantedblib->_get_record($this->ecommerce_table, $this->ecommerce_table_index, $ecommerce_id)))
		{
			$rsEcomm = $this->vigilantedblib->_db_return_rs($rowEcomm);
			return $rsEcomm;
		}
		return false;
	}
	
	function add_ecommerce_link($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->ecommerce_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_ecommerce_link_by_id($ecommerce_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->ecommerce_table, $this->ecommerce_table_index, $ecommerce_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_ecommerce_link_by_id($ecommerce_id)
	{
		$where_function = is_array($ecommerce_id) ? 'where_in' : 'where';
		$this->db->$where_function('ecommerce_id', $ecommerce_id);
		if (false !== $this->db->delete($this->ecommerce_table))
		{
			return true;
		}
		return false;
	}
}
?>