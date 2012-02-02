<?php
class Mw_mt_model extends CI_Model
{
	var $blog_id = 4;
	
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
	
	function get_category($category_id)
	{
		if (false !== ($rowCategory = $this->vigilantedblib->_get_record('mt_category', 'category_id', $category_id)))
		{
			$rsCategory = $this->vigilantedblib->_db_return_rs($rowCategory);
			return $rsCategory;
		}
		return false;
	}
	
	function get_categories_with_entries($blog_id, $category_id = '')
	{
		$this->db->select('c.*');
		$this->db->from('mt_entry as e');
		$this->db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left');
		$this->db->join('mt_category as c', 'p.placement_category_id=c.category_id', 'left');
		$this->db->where('c.category_blog_id', $blog_id);
		!empty($category_id) ? $this->db->where_in('c.category_id', $category_id) : $this->db->where('c.category_id is not null');
		$this->db->group_by('c.category_id');
		$this->db->order_by('c.category_label');
		
		if (false !== ($rowCategories = $this->db->get()))
		{
			return $rowCategories;
		}
		return false;
	}
	
	function get_calendar($blog_id, $include_month = true, $limit_year = '')
	{
		$calendarQuery = '';
		$calendarQuery .= 'Select entry_created_on as entry_date, Year(entry_created_on) as entry_year, ';
		$calendarQuery .= ($include_month==false) ? 'Min(Month(entry_created_on)) ' : 'Month(entry_created_on) ';
		$calendarQuery .= 'as entry_month';
		$calendarQuery .= ' From mt_entry ';
		$calendarQuery .= (is_array($blog_id)) ? 'Where In (' . join(',', $blog_id) . ')' : 'Where entry_blog_id=' . $blog_id;
		$calendarQuery .= ' And entry_status=2 ';
		if (!empty($limit_year)) {$calendarQuery .= 'And Year(entry_created_on) = ' . $limit_year . ' ';}
		$calendarQuery .= 'Group By ';
		$calendarQuery .= ($include_month==false) ? 'Date_Format(entry_created_on, \'%Y\') ' : 'Date_Format(entry_created_on, \'%m/%Y\') ';
		$calendarQuery .= 'Order By Year(entry_created_on) Desc, Month(entry_created_on) Desc';
		
		if (false !== ($rowCalendar = $this->db->query($calendarQuery)))
		{
			return $rowCalendar;
		}
		return false;
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
	
	function get_entries_by_date($blog_id, $year, $month = '')
	{
		$newsQuery = '';
		$newsQuery .= 'Select e.*, cat.category_id, cat.category_label, p.placement_category_id, au.author_name ';
		$newsQuery .= 'From ((mt_entry as e Left Join mt_placement as p on e.entry_id=p.placement_entry_id) ';
		$newsQuery .= 'Left Join mt_category as cat on p.placement_category_id=cat.category_id) ';
		$newsQuery .= 'Left Join mt_author as au on e.entry_author_id=au.author_id ';
		$newsQuery .= 'Where Year(e.entry_created_on)=' . intval($year) . ' ';
		if (!empty($month)) {$newsQuery .= 'And Month(e.entry_created_on)=' . intval($month) . ' ';}
		$newsQuery .= 'And e.entry_status=2 ';
		$newsQuery .= 'And e.entry_blog_id=' . intval($blog_id) . ' ';
		$newsQuery .= 'Order By e.entry_created_on Desc';
		
		if (false !== ($rowEntries = $this->db->query($newsQuery)))
		{
			return $rowEntries;
		}
		return false;
	}
	
	function get_entry_by_id($entry_id, $blog_id = '', $simple = false)
	{
		if (empty($blog_id)) {$blog_id = $this->blog_id;}
		
		if ($simple == true)
		{
			$rowEntry = $this->db->get_where('mt_entry', array('entry_id' => $entry_id));
			if (false !== ($rsEntry = $this->vigilantedblib->_db_return_rs($rowEntry)))
			{
				return $rsEntry;
			}
		}
		else
		{
			$this->db->from('mt_entry as e');
			$this->db->join('mt_author as au', 'e.entry_author_id=au.author_id', 'left');
			$this->db->join('mt_placement as p', 'p.placement_entry_id=e.entry_id', 'left outer');
			$this->db->join('mt_category as cat', 'p.placement_category_id=cat.category_id', 'left outer');
			$this->db->join('mw_content as con', 'con.content_entry_id=e.entry_id', 'left outer');
			$this->db->where('e.entry_status', 2);
			$this->db->where('e.entry_blog_id', $blog_id);
			$this->db->where('e.entry_id', $entry_id);
			if (false !== ($rowEntry = $this->db->get()))
			{
				$rsEntry = $this->vigilantedblib->_db_return_rs($rowEntry);
				return $rsEntry;
			}
		}
		return false;
	}
}
?>