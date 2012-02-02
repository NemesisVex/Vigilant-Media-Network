<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MtView
 *
 * @author Greg Bueno
 */
class MtView {
	
	public $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		
		// Configure VmView for all pages on the site.
		$this->CI->vmview->layout_template = 'mt_global_layout.tpl';
		$this->CI->vmview->page_template = 'mt_global_page.tpl';
		$this->CI->vmview->protected_template = 'mt_root_content.tpl';
		$this->CI->vmview->protected_var = 'root_content';
		$this->CI->vmview->is_protected = true;
		$this->CI->vmview->per_page = 10;
		$this->CI->vmview->page_title_delim = ' &#8212; ';
		$this->CI->vmmodel_mtentry->blog_id = 22;
		$this->CI->mysmarty->assign('session', $this->CI->phpsession);
	}
}

?>
