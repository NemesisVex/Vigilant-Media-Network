<?php

/**
 * Description of obr_album_format
 *
 * @author Greg Bueno
 */
require_once(BASEPATH . 'libraries/VmModel.php');

class Obr_Album_Format extends VmModel {
	
	public function __construct($params = null) {
		parent::__construct($params);

		$this->table_name = 'ep4_albums_formats';
		$this->primary_index_field = 'format_id';
	}
	
}

?>
