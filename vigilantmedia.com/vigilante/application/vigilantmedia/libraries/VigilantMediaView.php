<?php

/**
 * VigilantMediaView
 *
 * Configures VmView library.
 *
 * @author gbueno
 */
class VigilantMediaView {

	public $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('VmView', array('use_mobile_templates' => false));

		// Configure VmView for all pages on the site.
		$this->CI->vmview->layout_template = 'vm_global_layout.tpl';
		$this->CI->vmview->page_template = 'vm_global_page.tpl';
		$this->CI->vmview->page_title_delim = ' &raquo; ';
		$this->CI->vmview->per_page = 10;
	}
}

?>
