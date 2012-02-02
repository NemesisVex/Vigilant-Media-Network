<?php

class Content extends CI_Controller
{
	var $blog_id = 4;
	var $blog_ids = array(4, 8);
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('ArchiveLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyEcommerce');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_album_model');
		$this->load->model('Mw_release_model');
		$this->load->model('Mw_ecommerce_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_mt_model');
		
		$this->archivelib->_format_side_navigation();
	}
	
	// View methods
	
	function index()
	{
		header('Location: /');
	}
	
	function category($category_id)
	{
		$offset = $this->uri->segment(4);
		
		$rsCategory = $this->Mw_mt_model->get_category($category_id);
		
		$this->archivelib->_format_section_head('Entries', $rsCategory->category_label);
		
		$rowEntries = $this->Mw_mt_model->get_entries_by_category_id($category_id);
		
		$page_config['base_url'] = '/index.php/content/category/' . $category_id . '/';
		
		$this->_display_news_page($rowEntries, $offset, 4, $page_config);
	}
	
	function date($month = '', $year = '')
	{
		$text_date = date('F Y', strtotime($month . '/1/' . $year));
		$offset = $this->uri->segment(5);
		
		$this->archivelib->_format_section_head('Entries', $text_date);
		
		$rowDates = $this->Mw_mt_model->get_calendar($this->blog_id, true, $year);
		$rsDates = $this->vigilantedblib->_db_return_smarty_array($rowDates);
		
		$rowEntries = $this->Mw_mt_model->get_entries_by_date($this->blog_id, $year, $month);
		
		$page_config['base_url'] = '/index.php/content/date/' . $month . '/' . $year . '/';
		
		$this->mysmarty->assign('rsDates', $rsDates);
		$this->_display_news_page($rowEntries, $offset, 5, $page_config);
	}
	
	function entry($entry_id)
	{
		$rsEntry = $this->Mw_mt_model->get_entry_by_id($entry_id, $this->blog_id, true);
		
		$this->archivelib->_format_section_head('Entries', $rsEntry->entry_title);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		
		if ($rsEntry->entry_blog_id==8)
		{
			header('Location: ' . $this->archivelib->mw_config['to_musicwhore'] . '/index.php/mw/entry/' . intval($entry_id) . '/');
			die();
		}
		
		if (false !== ($rowMaps = $this->Mw_content_model->get_maps_by_entry_id($entry_id)))
		{
			if ($rowMaps->num_rows() == 1)
			{
				$rsMap = $this->vigilantedblib->_db_return_rs($rowMaps);
				
				if (false !== ($rsAlbum = $this->Mw_release_model->get_release_by_id($rsMap->content_release_id)))
				{
					$this->mysmarty->assign('rsAlbum', $rsAlbum);
					
					$rsArtist = $this->Mw_artist_model->get_artist_by_id($rsAlbum->album_artist_id);
					$this->mysmarty->assign('rsArtist', $rsArtist);
						
					if (false !== ($rsLinks = $this->archivelib->_build_buy_links($rsMap->content_release_id, $rsArtist->artist_default_amazon_locale)))
					{
						$this->mysmarty->assign('rsLinks', $rsLinks);
					}
					
					if (!empty($rsAlbum->release_asin_num))
					{
						$amazon_url = $this->myamazon->build_amazon_url($rsAlbum->release_asin_num, $rsArtist->artist_default_amazon_locale);
						$this->mysmarty->assign('amazon_url', $amazon_url);
						
						$items = $this->_lookup($rsAlbum->release_asin_num, $rsArtist->artist_default_amazon_locale, 'Large');
						$display = empty($items->Request->Errors) ? true : false;
						
						if ($display == true)
						{
							$track_out = $items->Item->Tracks->Disc;
							$this->mysmarty->assign('track_out', $track_out);
						}
						
						$image_uri = $items->Item->SmallImage->URL;
						$this->mysmarty->assign('image_uri', $image_uri);
					}
				}
			}
		}
		
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->archivelib->_smarty_display_mw_page('amwb_content_entry.tpl');
	}
	
	// Private methods
	function _lookup($asin = '', $locale = 'us', $response_group = 'ItemAttributes')
	{
		$params['ResponseGroup'] = $response_group;
		
		$this->myamazon->__construct($locale);
		$this->myamazon->item_lookup($asin, $params);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->request_uri . '">XML URL</a>');
		$items = $this->myamazon->results->Items;
		
		$this->mysmarty->assign('request_uri', $this->myamazon->request_uri);
		$this->mysmarty->assign('locale', $locale);
		return $items;
	}
	
	function _display_news_page($rowEntries, $offset, $segment, $page_config, $display_page = 'amwb_content_browse.tpl')
	{
		$page_config['total_rows'] = $rowEntries->num_rows();
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = $segment;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->archivelib->_smarty_display_mw_page($display_page);
	}
}

?>