<?php

/**
 * Ep4Model_MtEntry
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel_MtEntry.php');
class Ep4_MtEntry extends VmModel_MtEntry {

	protected $CI;
	public $category_news = 35;

	public function __construct() {
		$config = array('dsn' => 'mt');
		parent::__construct($config);

		$this->blog_id = 12;
	}

	public function get_latest_entries($blog_id = null, $limit = 5, $return_result = true) {
		$this->_limit_by_category($this->category_news);
		$rs = parent::get_latest_entries($blog_id, $limit, $return_result);
		return $rs;
	}

	public function get_latest_entry($blog_id = null, $return_result = true) {
		$this->_limit_by_category($this->category_news);
		$rs = parent::get_latest_entry($blog_id, $return_result);
		return $rs;
	}

	public function get_entries_by_year($y = 1996, $blog_id = null, $return_result = true) {
		$this->_limit_by_category($this->category_news);
		$rs = parent::get_entries_by_year($y, $blog_id, $return_result);
		return $rs;
	}

	private function _limit_by_category($category_id) {
		$this->db->join('mt_placement', 'mt_placement.placement_entry_id=mt_entry.entry_id', 'left outer');
		$this->db->join('mt_category', 'mt_placement.placement_category_id=mt_category.category_id', 'left outer');
		$this->db->where('category_id', $category_id);
	}
}

?>
