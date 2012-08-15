<?php

/**
 * VmModel_MtAuthor
 *
 * @author Greg Bueno
 */
class VmModel_MtComment extends VmModel {

	public $blog_id;

	public function __construct($params = null) {
		parent::__construct($params);

		$this->table_name = 'mt_comment';
		$this->primary_index_field = 'comment_id';
	}

	public function get_comments_by_entry_id($comment_entry_id, $return_result = true) {
		$this->db->from($this->table_name);
		$this->db->where('comment_visible', true);
		$this->db->where('comment_entry_id', $comment_entry_id);
		$this->db->order_by('comment_created_on', 'Asc');

		if (false !== ($row = $this->db->get())) {
			return ($return_result === true) ? $this->return_smarty_array($row) : $row;
		}
		return false;
	}

	public function get_latest_comments($blog_id = null, $limit = 5, $return_result = true) {
		if (empty($blog_id)) {
			$blog_id = $this->blog_id;
		}

		$this->db->from($this->table_name);
		$this->db->join('mt_entry', $this->table_name . '.comment_entry_id=mt_entry.entry_id', 'left outer');
		$this->db->where('comment_blog_id', $blog_id);
		$this->db->where('comment_visible', true);
		$this->db->order_by('comment_created_on', 'desc');
		if (!empty($limit)) {
			$this->db->limit($limit);
		}
		if (false !== ($rowComments = $this->db->get())) {
			return ($return_result === true) ? $this->return_smarty_array($rowComments) : $rowComments;
		}
		return false;
	}

}

?>
