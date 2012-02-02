<?php

/**
 * Description of ObservantView
 *
 * @author Greg Bueno
 */
class ObservantView {
	
	public $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		
		// Configure VmView for all pages on the site.
		$this->CI->vmview->layout_template = 'obr_global_layout.tpl';
		$this->CI->vmview->page_template = 'obr_global_page.tpl';
		$this->CI->vmview->per_page = 10;
		$this->CI->vmview->page_title_delim = ' &raquo; ';
		$this->CI->vmmodel_mtentry->blog_id = 22;
	}
}

?>
