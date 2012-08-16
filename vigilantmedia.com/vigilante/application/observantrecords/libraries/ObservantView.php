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
		$this->CI->vmview->protected_template = 'obr_root_content.tpl';
		$this->CI->vmview->protected_var = 'root_content';
		$this->CI->vmmodel_mtentry->blog_id = 22;
		
		$this->CI->mysmarty->assign('session', $this->CI->phpsession);
	}
}

?>
