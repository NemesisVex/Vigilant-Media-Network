<?php

/**
 * VmModel_MtAuthor
 *
 * @author Greg Bueno
 */
class VmModel_MtAuthor extends VmModel {
	public $blog_id;
	
	public function __construct() {
		parent::__construct();
		
		$this->table_name = 'mt_author';
		$this->primary_index_field = 'author_id';
	}
}

?>
