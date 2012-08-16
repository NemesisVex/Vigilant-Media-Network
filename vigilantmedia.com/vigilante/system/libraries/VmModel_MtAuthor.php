<?php

/**
 * VmModel_MtAuthor
 *
 * @author Greg Bueno
 */
class VmModel_MtAuthor extends VmModel {
	public $blog_id;

	public function __construct($params = null) {
		parent::__construct($params);

		$this->table_name = 'mt_author';
		$this->primary_index_field = 'author_id';
	}
}

?>
