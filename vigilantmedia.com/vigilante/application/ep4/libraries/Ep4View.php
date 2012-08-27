<?php
/**
 * Description of Ep4View
 *
 * @author Greg Bueno
 */
class Ep4View {

	public $CI;

	public function __construct() {
		$this->CI =& get_instance();

		// Configure VmView for all pages on the site.
		$this->CI->vmview->layout_template = 'ep4_global_layout.tpl';
		$this->CI->vmview->page_template = 'ep4_global_page.tpl';
		$this->CI->vmview->page_title_delim = ' &raquo; ';
		$this->CI->vmview->per_page = 10;

		switch (ENVIRONMENT)
		{
			case 'development':
				$this->CI->vmview->config['ep4_mp3_root_path'] = OBSERVANTRECORDS_MP3_PATH;
				$this->CI->vmview->config['ep4_zip_root_path'] = OBSERVANTRECORDS_ZIP_PATH;
				$this->CI->vmview->config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_DEV;
				break;
			case 'testing':
				$this->CI->vmview->config['ep4_mp3_root_path'] = OBSERVANTRECORDS_MP3_PATH;
				$this->CI->vmview->config['ep4_zip_root_path'] = OBSERVANTRECORDS_ZIP_PATH;
				$this->CI->vmview->config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_TEST;
				break;
			case 'production':
				$this->CI->vmview->config['ep4_mp3_root_path'] = OBSERVANTRECORDS_MP3_PATH;
				$this->CI->vmview->config['ep4_zip_root_path'] = OBSERVANTRECORDS_ZIP_PATH;
				$this->CI->vmview->config['ep4_cover_root_path'] = OBSERVANTRECORDS_COVERS_PATH_PROD;
				break;
		}
	}
}

?>
