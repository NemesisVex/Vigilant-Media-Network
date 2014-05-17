<?php

class Asin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyAmazon');
		$this->load->library('pagination');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mtlib->mt_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}
	
	// View methods
	
	function index($keywords = '', $mode = '', $locale = 'us')
	{
		$this->mtlib->section_head = 'Central administration';
		$this->mtlib->section_label = 'Amazon ASIN/UPC Lookup';
		
		if (empty($locale)) {$locale = $this->input->get_post('locale');}
		if (empty($mode)) {$mode = $this->input->get_post('mode');}
		
		$this->mysmarty->assign('keywords', $keywords);
		$this->mysmarty->assign('locale', $locale);
		$this->mysmarty->assign('mode', $mode);
		$this->mtlib->_smarty_display_mt_page('mt_ecommerce_asin_lookup.tpl');
	}
	
	function search($keywords = '', $mode = '', $locale = '', $offset = 0)
	{
		if (empty($locale)) {$locale = $this->input->get_post('locale');}
		if (empty($mode)) {$mode = $this->input->get_post('mode');}
		if (empty($keywords)) {$keywords = $this->input->get_post('keywords');}
		
		$pg = ($offset / 10) + 1;
		
		$params['ResponseGroup'] = 'ItemAttributes';
		$params['ItemPage'] = $pg;
		
		$this->myamazon->__construct($locale);
		$this->myamazon->item_search($mode, $keywords, $params);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->auth_request_uri . '">XML URL</a>');
		$display = isset($this->myamazon->results->Items->Request->Errors) ? false : true;
		if ($display===true)
		{
			$items = $this->myamazon->results->Items->Item;
			
			$total_rows = $this->myamazon->results->Items->TotalResults;
			$per_page = count($items);
			
			$page_config['base_url'] = '/index.php/ecommerce/asin/search/' .  rawurlencode($keywords) . '/' . rawurlencode($mode) . '/' . rawurlencode($locale) . '/';
			$page_config['total_rows'] = $total_rows;
			$page_config['per_page'] = $per_page;
			$page_config['uri_segment'] = 7;
			$page_config['num_links'] = 5;
			//$this->vigilantecorelib->debug_trace($page_config['base_url']);
			$this->pagination->initialize($page_config);
			
			$page_links = $this->pagination->create_links();
			
			$this->mysmarty->assign('keywords', $keywords);
			$this->mysmarty->assign('items', $items);
			$this->mysmarty->assign('page_links', $page_links);
		}
		else
		{
			$this->mysmarty->assign('errors', $this->myamazon->results->Items->Request->Errors);
		}
		
		$this->mysmarty->assign('locale', $locale);
		$this->mysmarty->assign('mode', $mode);
		$this->mysmarty->assign('display', $display);
		$this->mysmarty->assign('auth_request_uri', $this->myamazon->auth_request_uri);
		$this->index($keywords, $mode, $locale);
	}
}
?>