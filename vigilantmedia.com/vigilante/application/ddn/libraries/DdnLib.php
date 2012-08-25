<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DdnLib
{
	var $blog_id = 5;
	var $webmaster_email = 'greg@gregbueno.com';
	var $site_name = '';
	var $page_title;
	var $section_head;
	var $section_label;
	var $section_sublabel;
	var $ddn_config;
	var $google_map_key = 'ABQIAAAAenOcDWY3GB5qVSPOQiBt_xRPto5laNqVxgk7rNaULMnh65830hSw2SmWLSmHjjpbku0UcRlTK_fhGQ';
	var $ilike_key = 'dk01f-vkzjoPTYBdQlTrTix12naqJFz02t45NiCsPywVyuQ=';
	
	function __construct()
	{
		$CI =& get_instance();
		switch (ENVIRONMENT)
		{
			case 'development':
				$this->ddn_config['google_map_key'] = 'ABQIAAAAenOcDWY3GB5qVSPOQiBt_xS-obO4ViuHZ5qc-smcREWmAs02qBTq0YtPkqmAgwPrL4BbTY2Bh__eUg';
				$this->ddn_config['ilike_key'] = 'dk013GWHtWSd7L_9R0MGcfOKynz_RgDDJa5SXwxwFAJ1WBQ=';
				$this->ddn_config['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
				$this->ddn_config['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
				$this->ddn_config['to_mt'] = 'http://dev.mt.vigilantmedia.com';
				$this->ddn_config['to_gregbueno'] = 'http://dev.gregbueno.com';
				$this->ddn_config['to_eponymous4'] = 'http://dev.eponymous4.com';
				$this->ddn_config['to_ep4'] = 'http://dev.eponymous4.gregbueno.com';
				$this->ddn_config['to_archive'] = 'http://dev.archive.musicwhore.org';
				$this->ddn_config['to_musicwhore'] = 'http://dev.musicwhore.org';
				$this->ddn_config['to_filmwhore'] = 'http://dev.filmw.musicwhore.org';
				$this->ddn_config['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
				$this->ddn_config['to_journalcon'] = 'http://dev.journalcon.austin-stories.com';
				$this->ddn_config['to_austinstories'] = 'http://dev.austin-stories.com';
				break;
			case 'test':
				$this->ddn_config['google_map_key'] = $this->google_map_key;
				$this->ddn_config['ilike_key'] = $this->ilike_key;
				$this->ddn_config['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
				$this->ddn_config['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
				$this->ddn_config['to_mt'] = 'http://test.mt.vigilantmedia.com';
				$this->ddn_config['to_gregbueno'] = 'http://test.gregbueno.com';
				$this->ddn_config['to_eponymous4'] = 'http://test.eponymous4.com';
				$this->ddn_config['to_ep4'] = 'http://test.eponymous4.gregbueno.com';
				$this->ddn_config['to_archive'] = 'http://test.archive.musicwhore.org';
				$this->ddn_config['to_musicwhore'] = 'http://test.musicwhore.org';
				$this->ddn_config['to_filmwhore'] = 'http://test.film.musicwhore.org';
				$this->ddn_config['to_tvwhore'] = 'http://test.tv.musicwhore.org';
				$this->ddn_config['to_journalcon'] = 'http://test.journalcon.austin-stories.com';
				$this->ddn_config['to_austinstories'] = 'http://test.austin-stories.com';
				break;
			case 'production':
				$this->ddn_config['google_map_key'] = $this->google_map_key;
				$this->ddn_config['ilike_key'] = $this->ilike_key;
				$this->ddn_config['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
				$this->ddn_config['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
				$this->ddn_config['to_mt'] = 'http://mt.vigilantmedia.com';
				$this->ddn_config['to_gregbueno'] = 'http://www.gregbueno.com';
				$this->ddn_config['to_eponymous4'] = 'http://www.eponymous4.com';
				$this->ddn_config['to_ep4'] = 'http://eponymous4.gregbueno.com';
				$this->ddn_config['to_archive'] = 'http://archive.musicwhore.org';
				$this->ddn_config['to_musicwhore'] = 'http://www.musicwhore.org';
				$this->ddn_config['to_filmwhore'] = 'http://www.filmwhore.org';
				$this->ddn_config['to_tvwhore'] = 'http://www.tvwhore.org';
				$this->ddn_config['to_journalcon'] = 'http://www.journalcon.com';
				$this->ddn_config['to_austinstories'] = 'http://www.austin-stories.com';
				break;
		}
	}
	
	function email($hidden_fields, $shown_fields, $site_name = 'Gregbueno.com', $redirect = '/index.php/gb/contact/sent/')
	{
		$CI =& get_instance();
		$CI->vigilantecorelib->email($this->webmaster_email, $hidden_fields, $shown_fields, $site_name, $redirect);
	}

	function build_tour_xml($rowTourDates)
	{
		// Start XML file, create parent node
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parent_node = $dom->appendChild($node);

		// Iterate through the rows, adding XML nodes for each
		foreach ($rowTourDates->result() as $rsTourDate)
		{
			// ADD TO XML DOCUMENT NODE
			$node = $dom->createElement("marker");
			$newnode = $parent_node->appendChild($node);
			$newnode->setAttribute("name", $rsTourDate->geocode_location);
			$newnode->setAttribute("address", $rsTourDate->geocode_address);
			$newnode->setAttribute("lat", $rsTourDate->geocode_lat);
			$newnode->setAttribute("lng", $rsTourDate->geocode_lon);
			$newnode->setAttribute("type", 'concert');
		}

		if (false !== ($xml = $dom->saveXML()))
		{
			return $xml;
		}
		
		return false;
	}

	// Private methods
	function _smarty_display_ddn_protected_page($content_var, $content_template, $wrapper_template, $page = 'ddn_global_page.tpl')
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('config', $this->ddn_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_protected_page($content_var, $content_template, $wrapper_template, $page);
	}
	
	function _smarty_display_ddn_page($page, $wrapper = 'ddn_global_page.tpl')
	{
		$CI =& get_instance();
		
		$CI->mysmarty->assign('config', $this->ddn_config);
		$CI->mysmarty->assign('page_title', $this->page_title);
		$CI->mysmarty->assign('section_head', $this->section_head);
		$CI->mysmarty->assign('section_label', $this->section_label);
		$CI->mysmarty->assign('section_sublabel', $this->section_sublabel);
		$CI->vigilantesmartylib->_smarty_display_page($page, $wrapper);
	}
	
	function _format_section_head($section_head = '', $section_label = '', $section_sublabel = '')
	{
		$this->section_head = $section_head;
		$this->section_label = $section_label;
		$this->section_sublabel = $section_sublabel;
		
		if (!empty($section_head)) {$this->page_title .= $section_head;}
		if (!empty($section_label)) {$this->page_title .= ': ' . $section_label;}
		if (!empty($section_sublabel)) {$this->page_title .= ': ' . $section_sublabel;}
	}

}
?>