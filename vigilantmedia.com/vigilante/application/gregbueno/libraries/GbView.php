<?php
/**
 * GbView
 * 
 * Extension of VmView
 *
 * @author Greg Bueno
 */
class GbView {

	public $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('VmView', array('use_mobile_templates' => false));

		// Configure VmView for all pages on the site.
		$this->CI->vmview->layout_template = 'gb_global_layout.tpl';
		$this->CI->vmview->page_template = 'gb_global_page.tpl';
		$this->CI->vmview->page_title_delim = ': ';
		$this->CI->vmview->per_page = 10;
		
		$this->CI->mysmarty->assign('is_mobile', $this->CI->agent->is_mobile());
	}
}

?>
