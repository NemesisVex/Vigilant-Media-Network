<?php
class Ep4_news_model extends CI_Model
{
	var $blog_id = 12;
	var $category_news = 35;
	var $category_wrp_release = 36;
	var $category_wrp_track = 37;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_latest_news_item($category_id = '', $blog_id = '')
	{
		$this->_build_base_news_query($category_id, $blog_id);
		$this->db->where('e.entry_status', 2);
		$this->db->order_by('e.entry_created_on', 'desc');
		$this->db->limit(1);
		if (false !== ($row = $this->db->get()))
		{
			$rs = $this->vigilantedblib->_db_return_rs($row);
			return $rs;
		}
		return false;
	}
	
	function get_news_item_by_id($entry_id, $category_id = '', $blog_id = '')
	{
		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		
		$this->db->select('e.*,cat.category_label,p.placement_category_id');
		$this->db->from('mt_entry as e');
		$this->db->join('mt_placement as p', 'e.entry_id=p.placement_entry_id', 'left');
		$this->db->join('mt_category as cat', 'p.placement_category_id=cat.category_id', 'left');
		$this->db->where('e.entry_blog_id', $blog_id);
		$this->db->where('e.entry_id', $entry_id);
		if (false !== ($row = $this->db->get()))
		{
			$rs = $this->vigilantedblib->_db_return_rs($row);
			return $rs;
		}
		return false;
	}
	
	function get_latest_news_items($category_id = '', $blog_id = '', $limit = '')
	{
		$this->_build_base_news_query($category_id, $blog_id);
		$this->db->where('e.entry_status', 2);
		$this->db->order_by('e.entry_created_on', 'desc');
		if (!empty($limit))
		{
			$this->db->limit($limit);
		}
		if (false !== ($row = $this->db->get()))
		{
			return $row;
		}
		return false;
	}
	
	function get_news_items_by_year($y = 2008, $category_id = '', $blog_id = '')
	{
		if (empty($category_id)) {$category_id = $this->category_news;}
		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		
		$newsQuery = '';
		$newsQuery .= 'Select e.*, cat.category_label, p.placement_category_id ';
		$newsQuery .= 'From (mt_entry as e Left Join mt_placement as p on e.entry_id=p.placement_entry_id) ';
		$newsQuery .= 'Left Join mt_category as cat on p.placement_category_id=cat.category_id ';
		$newsQuery .= 'Where Year(e.entry_created_on)=' . intval($y) . ' ';
		$newsQuery .= 'And e.entry_status=2 ';
		$newsQuery .= 'And cat.category_id=' . intval($category_id) .' ';
		$newsQuery .= 'And e.entry_blog_id=' . intval($blog_id) . ' ';
		$newsQuery .= 'Order By e.entry_created_on Desc';
		
		if (false !== ($row = $this->db->query($newsQuery)))
		{
			return $row;
		}
		return false;
	}
	
	// Private methods
	
	function _build_base_news_query($category_id = '', $blog_id = '')
	{
		if (empty($category_id)) {$category_id = $this->category_news;}
		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		
		$where = is_array($category_id) ? 'where_in' : 'where';
		
		$this->db->select('e.*,cat.category_label,p.placement_category_id');
		$this->db->from('mt_entry as e');
		$this->db->join('mt_placement as p', 'e.entry_id=p.placement_entry_id', 'left');
		$this->db->join('mt_category as cat', 'p.placement_category_id=cat.category_id', 'left');
		$this->db->where('e.entry_blog_id', $blog_id);
		$this->db->$where('cat.category_id', $category_id);
	}
}
?>