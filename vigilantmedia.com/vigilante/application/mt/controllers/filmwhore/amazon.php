<?php

class Amazon extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyAmazon');
		$this->load->library('pagination');
		$this->load->model('Mt_mw_film_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mtlib->mt_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/filmwhore/');
	}
	
	function browse($film_id, $mode = '', $locale = '')
	{
		$rsFilm = $this->mtlib->_format_fw_section_head($film_id, 'Browse Amazon catalog');
		$film_title = $this->vigilantecorelib->format_film_title_object($rsFilm);
		
		$locale_input = $this->input->get_post('locale');
		$mode_input = $this->input->get_post('mode');
		$offset = $this->uri->segment(7);
		
		if (empty($locale)) {$locale = false !== $locale_input ? $locale_input : 'us';}
		if (empty($mode)) {$mode = false !== $mode_input ? $mode_input : 'DVD';}
		
		$base_url = '/index.php/filmwhore/amazon/browse/' . $film_id . '/' . $mode . '/' . '/' . $locale . '/';
		
		$this->mysmarty->assign('film_id', $film_id);
		$this->mysmarty->assign('film_title', $film_title);
		$this->mysmarty->assign('rsFilm', $rsFilm);
		
		$this->search($film_title, $mode, $locale, $offset, $base_url);
	}
	
	function search($keywords = '', $mode = '', $locale = '', $offset = '', $base_url = '')
	{
		$keywords_input = $this->input->get_post('keywords');
		$locale_input = $this->input->get_post('locale');
		$mode_input = $this->input->get_post('mode');
		$offset_input = $this->uri->segment(7);
		
		if (empty($keywords)) {$keywords = urldecode($keywords_input);}
		if (empty($locale)) {$locale = false !== $locale_input ? $locale_input : 'us';}
		if (empty($mode)) {$mode = false !== $mode_input ? $mode_input : 'DVD';}
		if (empty($offset)) {$offset = $offset_input;}
		if (empty($base_url)) {$base_url = '/index.php/filmwhore/amazon/search/' . rawurlencode(rawurlencode($keywords)) .'/' . $mode . '/' . '/' . $locale . '/';}
		
		$items = $this->_search($keywords, $mode, $locale, $offset);
		$display = empty($items->Request->Errors) ? true : false;
		
		if ($display == true)
		{
			$total_rows = $items->TotalResults;
			$per_page = count($items->Item);
			
			$page_config['base_url'] = $base_url;
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
		$this->mtlib->_smarty_display_mt_page('mt_filmwhore_amazon_browse.tpl');
	}
	
	function import($asin, $locale = '')
	{
		$rsFilm = $this->mtlib->_format_section_head('Filmwhore.org', 'Main administration', 'Add a film');
		$locale_input = $this->input->get_post('locale');
		
		$field_map = array('film_title' => 'Title', 'film_ean_num' => 'EAN', 'film_release_date' => 'ReleaseDate');
		
		if (empty($locale)) {$locale = !empty($locale_input) ? $locale_input : $rsFilm->artist_default_amazon_locale;}
		
		$items = $this->_lookup($asin, $locale);
		$display = empty($items->Request->Errors) ? true : false;
		
		if ($display == true)
		{
			foreach($field_map as $db_field => $amazon_field)
			{
				$this->mysmarty->assign($db_field, $items->ItemAttributes->$amazon_field);
			}
			$this->mysmarty->assign('film_asin_num', $asin);
			$this->mtlib->_smarty_display_mt_page('mt_filmwhore_film_edit.tpl');
		}
		else
		{
			$this->mysmarty->assign('error_message', $items->Request->Errors->Error->Message);
			$this->mtlib->_smarty_display_mt_page('mt_filmwhore_amazon_browse.tpl');
		}
	}
	
	function film($film_id, $asin, $locale = 'us', $film_title = '')
	{
		$rsFilm = $this->mtlib->_format_fw_section_head($film_id, 'Browse Amazon catalog');
		
		$this->mysmarty->assign('rsFilm', $rsFilm);
		$this->mysmarty->assign('film_id', $film_id);
		$this->mysmarty->assign('film_title', $film_title);
		$this->mysmarty->assign('asin', $asin);
		$this->mysmarty->assign('locale', $locale);
		
		if (false !== ($items = $this->_lookup($asin, $locale)))
		{
			$this->mysmarty->assign('film_ean_num', $items->ItemAttributes->EAN);
			$this->mysmarty->assign('film_asin_num', $asin);
			$this->mtlib->_smarty_display_mt_page('mt_filmwhore_amazon_film_edit.tpl');
		}
		else
		{
			$this->mtlib->_smarty_display_mt_page('mt_filmwhore_amazon_browse.tpl');
		}
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
		
		$this->mysmarty->assign('locale', $locale);
		return $items;
	}
}

?>