<?php
class Gb_mt_model extends CI_Model
{
	var $entry_table = 'mt_entry';
	var $entry_table_index = 'entry_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// News methods
	function get_latest_entry($blog_id, $simple = false)
	{
		if ($simple == true)
		{
			$this->db->from($this->entry_table);
			$this->db->where('entry_blog_id', $blog_id);
			$this->db->where('entry_status', 2);
			$this->db->order_by('entry_authored_on', 'desc');
			$this->db->limit(1);
			if (false !== ($rowEntry = $this->db->get()))
			{
				$rs = $this->vigilantedblib->_db_return_rs($rowEntry);
				return $rs;
			}
		}
		else
		{
			$entryQuery = $this->_build_base_news_query();
			$entryQuery .= 'Where e.entry_blog_id=' . $blog_id  . ' ';
			$entryQuery .= 'And e.entry_status=2 ';
			$entryQuery .= 'Order By e.entry_authored_on Desc ';
			$entryQuery .= 'Limit 1 ';

			if (false !== ($rowEntry = $this->db->query($entryQuery)))
			{
				$rs = $this->vigilantedblib->_db_return_rs($rowEntry);
				return $rs;
			}
		}
		return false;
	}
	
	function get_entry_by_id($entry_id, $blog_id)
	{
		$entryQuery = $this->_build_base_news_query();
		$entryQuery .= 'Where e.entry_id=' . intval($entry_id) . ' ';
		$entryQuery .= 'And e.entry_blog_id=' . $blog_id  . ' ';
		$entryQuery .= 'And e.entry_status=2 ';

		if (false !== ($rowEntry = $this->db->query($entryQuery)))
		{
			$rs = $this->vigilantedblib->_db_return_rs($rowEntry);
			return $rs;
		}
		return false;
	}
	
	function get_adjacent_entry($date, $blog_id, $order_by = 'asc')
	{
		$direction = $order_by == 'desc' ? '<' : '>';
		$this->db->from($this->entry_table);
		$this->db->where('entry_blog_id', $blog_id);
		$this->db->where('entry_authored_on ' . $direction . ' ' . $this->db->escape($date));
		$this->db->order_by('entry_authored_on', $order_by);
		$this->db->limit(1);
		if (false !== ($rowEntry = $this->db->get()))
		{
			$rs = $this->vigilantedblib->_db_return_rs($rowEntry);
			return $rs;
		}
		return false;
	}
	
	function get_random_entry($blog_id)
	{
		$this->db->from($this->entry_table);
		$this->db->where('entry_blog_id', $blog_id);
		$this->db->order_by('Rand()');
		$this->db->limit(1);
		if (false !== ($rowEntry = $this->db->get()))
		{
			$rs = $this->vigilantedblib->_db_return_rs($rowEntry);
			return $rs;
		}
		return false;
	}
	
	function get_latest_entries($blog_id, $limit = 5)
	{
		$entryQuery = $this->_build_base_news_query();
		$entryQuery .= 'Where e.entry_blog_id=' . intval($blog_id) . ' ';
		$entryQuery .= 'And e.entry_status=2 ';
		$entryQuery .= 'Group By e.entry_id ';
		$entryQuery .= 'Order By e.entry_authored_on Desc ';
		if (!empty($limit)) {$entryQuery .= 'Limit ' . $limit;}
		if (false !== ($row = $this->db->query($entryQuery)))
		{
			return $row;
		}
		return false;
	}
	
	function get_entries_by_year($y = 2008, $blog_id)
	{
		$entryQuery = $this->_build_base_news_query();
		
		$entryQuery .= 'Where Year(e.entry_authored_on)=' . intval($y) . ' ';
		$entryQuery .= 'And e.entry_status=2 ';
		$entryQuery .= 'And e.entry_blog_id=' . intval($blog_id) . ' ';
		$entryQuery .= 'Group By e.entry_id ';
		$entryQuery .= 'Order By e.entry_authored_on Desc';
		
		if (false !== ($rowEntries = $this->db->query($entryQuery)))
		{
			return $rowEntries;
		}
		return false;
	}
	
	function get_entries_by_category_id($category_id, $blog_id)
	{
		$entryQuery = $this->_build_base_news_query();
		
		$entryQuery .= 'Where p.placement_category_id=' . intval($category_id) . ' ';
		$entryQuery .= 'And e.entry_status=2 ';
		$entryQuery .= 'Group By e.entry_id ';
		$entryQuery .= 'Order By e.entry_authored_on Desc';
		
		if (false !== ($rowEntries = $this->db->query($entryQuery)))
		{
			return $rowEntries;
		}
		return false;
	}
	
	function get_entries_on_this_day($date, $blog_id)
	{
		$year = date("Y", strtotime($date));
		$month = date("m", strtotime($date));
		$day = date("d", strtotime($date));
		
		$entryQuery = '';
		$entryQuery .= 'Select * From mt_entry ';
		$entryQuery .= 'Where (Month(entry_authored_on)=' . $month . ' ';
		$entryQuery .= 'And Dayofmonth(entry_authored_on)=' . $day . ' ';
		$entryQuery .= 'And Year(entry_authored_on)<>' . $year. ') ';
		$entryQuery .= 'And entry_blog_id=' . $blog_id . ' ';
		$entryQuery .= 'And entry_status=2 ';
		$entryQuery .= 'Order By entry_authored_on Desc';
		
		if (false !== ($rowEntries = $this->db->query($entryQuery)))
		{
			return $rowEntries;
		}
		return false;
	}
	
	function get_calendar($blog_id, $include_month = true, $limit_year = '')
	{
		$calendarQuery = '';
		$calendarQuery .= 'Select entry_authored_on as entry_date, Year(entry_authored_on) as entry_year, ';
		$calendarQuery .= ($include_month==false) ? 'Min(Month(entry_authored_on)) ' : 'Month(entry_authored_on) ';
		$calendarQuery .= 'as entry_month';
		$calendarQuery .= ' From mt_entry ';
		$calendarQuery .= (is_array($blog_id)) ? 'Where In (' . join(',', $blog_id) . ')' : 'Where entry_blog_id=' . $blog_id;
		$calendarQuery .= ' And entry_status=2 ';
		if (!empty($limit_year)) {$calendarQuery .= 'And Year(entry_authored_on) = ' . $limit_year . ' ';}
		$calendarQuery .= 'Group By ';
		$calendarQuery .= ($include_month==false) ? 'Date_Format(entry_authored_on, \'%Y\') ' : 'Date_Format(entry_authored_on, \'%m/%Y\') ';
		$calendarQuery .= 'Order By Year(entry_authored_on) Desc, Month(entry_authored_on) ';
		
		if (false !== ($rowCalendar = $this->db->query($calendarQuery)))
		{
			return $rowCalendar;
		}
		return false;
	}
	
	function get_all_categories($blog_id)
	{
		$this->db->order_by('category_label');
		$rowCategories = $this->db->get_where('mt_category', array('category_blog_id' => $blog_id));
		return $rowCategories;
	}
	
	function get_category_by_id($category_id)
	{
		if (false !== ($rowCategory = $this->vigilantedblib->_get_record('mt_category', 'category_id', $category_id)))
		{
			$rsCategory = $this->vigilantedblib->_db_return_rs($rowCategory);
			return $rsCategory;
		}
		return false;
	}
	
	function get_comments_by_entry_id($comment_entry_id)
	{
		$this->db->from('mt_comment');
		$this->db->where('comment_visible', true);
		$this->db->where('comment_entry_id', $comment_entry_id);
		$this->db->order_by('comment_created_on', 'Asc');
		if (false !== ($rowComments = $this->db->get()))
		{
			return $rowComments;
		}
		return false;
	}
	
	//Private methods
	function _build_base_news_query()
	{
		$entryQuery = '';
		$entryQuery .= "Select e.*, cat.*, au.*, Sum(c.comment_visible) as comment_count ";
		$entryQuery .= "From (((mt_entry as e Left Join mt_author as au on e.entry_author_id=au.author_id) ";
		$entryQuery .= "Left Outer Join mt_comment as c on e.entry_id=c.comment_entry_id) ";
		$entryQuery .= "Left Outer Join mt_placement as p on e.entry_id=p.placement_entry_id) ";
		$entryQuery .= "Left Outer Join mt_category as cat on p.placement_category_id=cat.category_id ";
		return $entryQuery;
	}
}
?>