<?php

class Amazon extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyEcommerce');
		$this->load->library('MyAmazon');
		$this->load->library('pagination');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
		$this->mtlib->mt_config['amazon_locale'] = $this->myamazon->amazon_locale;
		$this->mtlib->mt_config['itunes_locale'] = $this->myecommerce->itunes_locale;
		$this->mtlib->mt_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function browse($artist_id, $mode = '', $locale = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Amazon catalog');
		$artist_name = (($rsArtist->artist_settings_mask & 2)==2) ? $rsArtist->artist_asian_name_utf8 : $this->vigilantecorelib->format_artist_name_object($rsArtist, false);
		
		$keywords = $this->input->get_post('keywords');
		$locale_input = $this->input->get_post('locale');
		$mode_input = $this->input->get_post('mode');
		$offset = $this->uri->segment(7);
		
		if (empty($locale)) {$locale = !empty($locale_input) ? $locale_input : $rsArtist->artist_default_amazon_locale;}
		if (empty($mode)) {$mode = !empty($mode_input) ? $mode_input : 'Music';}
		if (empty($keywords)) {$keywords = $artist_name;}
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		
		$items = $this->_search($keywords, $mode, $locale, $offset);
		$display = empty($items->Request->Errors) ? true : false;
		
		if ($display == true)
		{
			$total_rows = $items->TotalResults;
			$per_page = count($items->Item);
			
			$page_config['base_url'] = '/index.php/musicwhore/amazon/browse/' . $artist_id .'/' . $mode . '/' . '/' . $locale . '/';
			$page_config['total_rows'] = $total_rows;
			$page_config['per_page'] = $per_page;
			$page_config['uri_segment'] = 7;
			$page_config['num_links'] = 5;
			//$this->vigilantecorelib->debug_trace($page_config['base_url']);
			$this->pagination->initialize($page_config);
			
			$page_links = $this->pagination->create_links();
			$this->mysmarty->assign('page_links', $page_links);
			
			$this->mysmarty->assign('items', $items->Item);
		}
		else
		{
			$this->mysmarty->assign('error_message', $items->Request->Errors->Error->Message);
		}
		
		$this->mysmarty->assign('keywords', $keywords);
		$this->mysmarty->assign('display', $display);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_amazon_browse.tpl');
	}
	
	//Private methods
	function _search($keywords = '', $mode = 'Music', $locale = 'us', $offset = 0, $response_group = 'ItemAttributes')
	{
		$keywords = urldecode($keywords);
		$pg = ($offset / 10) + 1;
		
		$params['ResponseGroup'] = $response_group;
		$params['ItemPage'] = $pg;
		
		$this->myamazon->__construct($locale);
		$this->myamazon->item_search($mode, $keywords, $params);
		$items = $this->myamazon->results->Items;
		
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->request_uri . '">XML URL</a>');
		$this->mysmarty->assign('auth_request_uri', $this->myamazon->auth_request_uri);
		$this->mysmarty->assign('locale', $locale);
		$this->mysmarty->assign('mode', $mode);
		
		return $items;
	}
	
	function _lookup($asin = '', $locale = 'us', $response_group = 'ItemAttributes')
	{
		$params['ResponseGroup'] = $response_group;
		
		$this->myamazon->__construct($locale);
		$this->myamazon->item_lookup($asin, $params);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->request_uri . '">XML URL</a>');
		$items = $this->myamazon->results->Items->Item;
		
		$this->mysmarty->assign('request_uri', $this->myamazon->request_uri);
		$this->mysmarty->assign('locale', $locale);
		return $items;
	}
}

?>