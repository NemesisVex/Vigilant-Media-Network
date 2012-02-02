<?php
class Mt_mt_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_categories($blog_id)
	{
		$this->db->order_by('category_label');
		$rowCategories = $this->db->get_where('mt_category', array('category_blog_id' => $blog_id));
		return $rowCategories;
	}
	
	function get_entries_by_category_id($category_id, $order_by = 'e.entry_created_on Desc')
	{
		$this->db->from('mt_entry as e');
		$this->db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left');
		$this->db->join('mt_category as c', 'p.placement_category_id=c.category_id', 'left');
		$this->db->where('c.category_id', $category_id);
		$this->db->order_by($order_by);
		$rowEntries = $this->db->get();
		return $rowEntries;
	}
	
	function get_entry_by_id($entry_id)
	{
		$rowEntry = $this->db->get_where('mt_entry', array('entry_id' => $entry_id));
		$rsEntry = $this->vigilantedblib->_db_return_rs($rowEntry);
		return $rsEntry;
	}
}
?>