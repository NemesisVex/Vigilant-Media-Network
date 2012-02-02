<?php

/**
 * VmModel_MtEntry
 *
 * @author Greg Bueno
 */
class VmModel_MtEntry extends VmModel {

	public $blog_id;

	public function __construct() {
		parent::__construct();
		$this->table_name = 'mt_entry';
		$this->primary_index_field = 'entry_id';

		$this->CI->load->library('VmModel_MtAuthor');
		$this->CI->load->library('VmModel_MtCategory');
	}

	public function get_calendar($blog_id = null, $include_month = true, $limit_year = null, $return_smarty_array = false, $limit = null, $offset = 1) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$calendar_query = '';
		$calendar_query .= 'Select entry_authored_on as entry_date, Year(entry_authored_on) as entry_year, ';
		$calendar_query .= ( $include_month == false) ? 'Min(Month(entry_authored_on)) ' : 'Month(entry_authored_on) ';
		$calendar_query .= 'as entry_month';
		$calendar_query .= ' From mt_entry ';
		$calendar_query .= ( is_array($blog_id)) ? 'Where In (' . join(',', $blog_id) . ')' : 'Where entry_blog_id=' . $blog_id;
		$calendar_query .= ' And entry_status=2 ';
		if (!empty($limit_year)) {
			$calendar_query .= 'And Year(entry_authored_on) = ' . $limit_year . ' ';
		}
		$calendar_query .= 'Group By ';
		$calendar_query .= ( $include_month == false) ? 'Date_Format(entry_authored_on, \'%Y\') ' : 'Date_Format(entry_authored_on, \'%m/%Y\') ';
		$calendar_query .= 'Order By Year(entry_authored_on) Desc, Month(entry_authored_on) ';

		if (false !== ($row = $this->CI->db->query($calendar_query))) {
			return ($return_smarty_array == true) ? $this->return_smarty_array($row, $limit, $offset) : $row;
		}
		return false;
	}

	public function retrieve_by_id($entry_id, $return_result = true) {
		if (false !== ($rsEntry = parent::retrieve_by_id($entry_id, $return_result))) {
			if ($return_result === true) {
				$rsAuthor = $this->CI->vmmodel_mtauthor->retrieve_by_id($rsEntry->entry_author_id);
				$rsCategory = $this->CI->vmmodel_mtcategory->get_entry_categories($rsEntry->entry_id, true);
				$rs = (object) array_merge((array) $rsEntry, (array) $rsAuthor, (array) $rsCategory);
				return $rs;
			} else {
				return $rsEntry;
			}
		}
		return false;
	}

	public function get_latest_entry($blog_id = null, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->where('entry_status', 2);
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->order_by('entry_authored_on', 'desc');
		$this->CI->db->limit(1);

		if (false !== ($rowEntry = $this->CI->db->get())) {
			if ($return_result === true) {
				if ($rowEntry->num_rows() > 0) {
					$rsEntry = $rowEntry->row();
					$rsCategory = $this->CI->vmmodel_mtcategory->get_entry_categories($rsEntry->entry_id, true);
					$rs = (object) array_merge((array) $rsEntry, (array) $rsCategory);
					return $rs;
				}
			} else {
				return $rowEntry;
			}
		}
		return false;
	}

	public function get_latest_entries($blog_id = null, $limit = 5, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->select('*');
		$this->CI->db->select('sum(mt_comment.comment_visible) as comment_count');
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->join('mt_comment', 'mt_comment.comment_entry_id = ' . $this->table_name . '.entry_id', 'left outer');
		$this->CI->db->where('entry_status', 2);
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->group_by('entry_id');
		$this->CI->db->order_by('entry_authored_on', 'desc');
		if (!empty($limit)) {
			$this->CI->db->limit($limit);
		}

		if (false !== ($rowEntries = $this->CI->db->get())) {
			if ($return_result === true) {
				$entry_ids = array();
				foreach ($rowEntries->result() as $rs) {
					$entry_ids[] = $rs->entry_id;
				}
				if (count($entry_ids) > 0) {
					$rsCategories = $this->CI->vmmodel_mtcategory->get_entry_categories($entry_ids, true, true);
				}
				$rsEntries = $this->return_smarty_array($rowEntries);

				if (!empty($rsCategories)) {
					$rs = array();
					foreach ($rsEntries as $rsEntry) {
						foreach ($rsCategories as $rsCategory) {
							if ($rsEntry->entry_id == $rsCategory->placement_entry_id) {
								$merged_rs = (object) array_merge((array) $rsCategory, (array) $rsEntry);
								$rs[] = $merged_rs;
							}
						}
					}
					return $rs;
				}
				return $rsEntries;
			} else {
				return $rowEntries;
			}
		}
		return false;
	}

	public function get_entries_by_category_id($category_id, $blog_id = null, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->select('*');
		$this->CI->db->select('sum(mt_comment.comment_visible) as comment_count');
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->join('mt_comment', 'mt_comment.comment_entry_id = ' . $this->table_name . '.entry_id', 'left outer');
		$this->CI->db->join('mt_placement', 'mt_placement.placement_entry_id = ' . $this->table_name . '.entry_id', 'left outer');
		$this->CI->db->join('mt_category', 'mt_category.category_id = mt_placement.placement_category_id', 'left outer');
		$this->CI->db->where('category_id', $category_id);
		$this->CI->db->where('entry_status', 2);
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->group_by('entry_id');
		$this->CI->db->order_by('entry_authored_on', 'desc');

		if (false !== ($row = $this->CI->db->get())) {
			return ($return_result === true) ? $this->return_smarty_array($row) : $row;
		}
		return false;
	}

	public function get_entries_by_year($y = 1996, $blog_id = null, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->select('*');
		$this->CI->db->select('sum(mt_comment.comment_visible) as comment_count');
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->join('mt_comment', 'mt_comment.comment_entry_id = ' . $this->table_name . '.entry_id', 'left outer');
		$this->CI->db->where('Year(entry_authored_on) = ' . intval($y));
		$this->CI->db->where('entry_status', 2);
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->group_by('entry_id');
		$this->CI->db->order_by('entry_authored_on', 'desc');

		if (false !== ($rowEntries = $this->CI->db->get())) {
			if ($return_result === true) {
				$entry_ids = array();
				foreach ($rowEntries->result() as $rs) {
					$entry_ids[] = $rs->entry_id;
				}
				if (count($entry_ids) > 0) {
					$rsCategories = $this->CI->vmmodel_mtcategory->get_entry_categories($entry_ids, true, true);
				}
				$rsEntries = $this->return_smarty_array($rowEntries);

				if (!empty($rsCategories)) {
					$rs = array();
					foreach ($rsEntries as $rsEntry) {
						foreach ($rsCategories as $rsCategory) {
							if ($rsEntry->entry_id == $rsCategory->placement_entry_id) {
								$merged_rs = (object) array_merge((array) $rsCategory, (array) $rsEntry);
								$rs[] = $merged_rs;
							}
						}
					}

					return $rs;
				}
				return $rsEntries;
			} else {
				return $rowEntries;
			}
		}
		return false;
	}

	public function get_entries_by_year_month($y = 1996, $m = 1, $blog_id = null, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->select('*');
		$this->CI->db->select('sum(mt_comment.comment_visible) as comment_count');
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->join('mt_comment', 'mt_comment.comment_entry_id = ' . $this->table_name . '.entry_id', 'left outer');
		$this->CI->db->where('Year(entry_authored_on) = ' . intval($y));
		$this->CI->db->where('Month(entry_authored_on) = ' . intval($m));
		$this->CI->db->where('entry_status', 2);
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->group_by('entry_id');
		$this->CI->db->order_by('entry_authored_on', 'desc');

		if (false !== ($rowEntries = $this->CI->db->get())) {
			if ($return_result === true) {
				$entry_ids = array();
				foreach ($rowEntries->result() as $rs) {
					$entry_ids[] = $rs->entry_id;
				}
				$rsCategories = $this->CI->vmmodel_mtcategory->get_entry_categories($entry_ids, true, true);
				$rsEntries = $this->return_smarty_array($rowEntries);

				if (!empty($rsCategories)) {
					$rs = array();
					foreach ($rsEntries as $rsEntry) {
						foreach ($rsCategories as $rsCategory) {
							if ($rsEntry->entry_id == $rsCategory->placement_entry_id) {
								$merged_rs = (object) array_merge((array) $rsCategory, (array) $rsEntry);
								$rs[] = $merged_rs;
							}
						}
					}

					return $rs;
				}
				return $rsEntries;
			} else {
				return $rowEntries;
			}
		}
		return false;
	}

	public function get_random_entry($blog_id = null, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->order_by('Rand()');
		$this->CI->db->limit(1);

		if (false !== ($rowEntry = $this->CI->db->get())) {
			if ($return_result === true) {
				$rsEntry = $rowEntry->row();
				$rsCategory = $this->CI->vmmodel_mtcategory->get_entry_categories($rsEntry->entry_id, true);
				$rs = (object) array_merge((array) $rsEntry, (array) $rsCategory);
				return $rs;
			} else {
				return $rowEntry;
			}
		}
		return false;
	}

	function get_adjacent_entry($date, $blog_id = null, $order_by = 'asc', $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$direction = ($order_by == 'desc') ? '<' : '>';
		$this->CI->db->from($this->table_name);
		$this->CI->db->join('mt_author', 'mt_author.author_id = ' . $this->table_name . '.entry_author_id', 'left');
		$this->CI->db->where('entry_blog_id', $blog_id);
		$this->CI->db->where('entry_authored_on ' . $direction . ' ' . $this->CI->db->escape($date));
		$this->CI->db->order_by('entry_authored_on', $order_by);
		$this->CI->db->limit(1);

		if (false !== ($rowEntry = $this->CI->db->get())) {
			if ($return_result === true) {
				if ($rowEntry->num_rows() > 0) {
					$rsEntry = $rowEntry->row();
					$rsCategory = $this->CI->vmmodel_mtcategory->get_entry_categories($rsEntry->entry_id, true);
					$rs = (object) array_merge((array) $rsEntry, (array) $rsCategory);
					return $rs;
				}
			} else {
				return $rowEntry;
			}
		}
		return false;
	}

	public function get_entry_count($blog_id = null) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}
		
		$this->CI->db->select('Count(*) as entry_count');
		$this->CI->db->from($this->table_name);
		$this->CI->db->where('entry_blog_id', $blog_id);
		if (false !== ($row = $this->CI->db->get())) {
			$rs = $this->return_rs($row);
			return $rs;
		}
	}

}

?>
