<?php

class Mw extends CI_Controller
{
	var $page_title;
	var $webmaster_email = 'greg@gregbueno.com';
	var $per_page = 10;
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	var $blog_id = 8;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('MwLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyEcommerce');
		$this->load->model('Mw_mt_model');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_release_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_ecommerce_model');
		
		$this->mwlib->_format_side_navigation($this->blog_id);
		$this->mwlib->mw_config['blog_id'] = $this->blog_id;
		$this->mwlib->mw_config['site_name'] = 'Musicwhore.org';
	}
	
	// View methods
	
	function index()
	{
		$this->mwlib->section_head = 'Latest';
		
		$segment = 3;
		$offset = $this->uri->segment($segment);
		
		//$rsCount = $this->Mw_mt_model->get_entry_count($this->blog_id);
		
		$rowEntries = $this->Mw_mt_model->get_latest_entries($this->blog_id, 30);
		
		$page_config['base_url'] = '/index.php/mw/index/';
		$page_config['total_rows'] = $rowEntries->num_rows();
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = $segment;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries, $this->per_page, $offset);
		
		$rowLatest = $this->Mw_mt_model->get_latest_comments($this->blog_id);
		$rsLatest = $this->vigilantedblib->_db_return_smarty_array($rowLatest);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('rsLatest', $rsLatest);
		$this->mwlib->_smarty_display_mw_page('mw_root_index.tpl');
	}
	
	function about()
	{
		$this->mwlib->_format_section_head('About');
		$this->mwlib->_smarty_display_mw_page('mw_root_about.tpl');
	}
	
	function collection()
	{
		$this->mwlib->_format_section_head('Collection');
		$this->mwlib->_smarty_display_mw_page('mw_root_collection.tpl');
	}

	function contact()
	{
		$this->mwlib->_format_section_head('Contact');
		$this->mwlib->_smarty_display_mw_page('mw_root_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->mwlib->_format_section_head('Contact');
		$this->mwlib->_smarty_display_mw_page('mw_root_contact_sent.tpl');
	}
	
	function terms()
	{
		$this->mwlib->_format_section_head('About', 'Terms and conditions of use');
		$this->mwlib->_smarty_display_mw_page('mw_root_terms.tpl');
	}
	
	function error($code)
	{
		$this->mwlib->_format_section_head('Error', $code, $this->error_codes[$code]);
		$this->mwlib->_smarty_display_mw_page('mw_error_' . $code . '.tpl');
	}
	
	function category($category_id)
	{
		$offset = $this->uri->segment(4);
		
		$rsCategory = $this->Mw_mt_model->get_category($category_id);
		
		$this->mwlib->_format_section_head($rsCategory->category_label);
		
		$rowEntries = $this->Mw_mt_model->get_entries_by_category_id($category_id);
		
		$page_config['base_url'] = '/index.php/mw/category/' . $category_id . '/';
		
		$this->_display_news_page($rowEntries, $offset, 4, $page_config);
	}
	
	function date($month = '', $year = '')
	{
		$text_date = date('F Y', strtotime($month . '/1/' . $year));
		$offset = $this->uri->segment(5);
		
		$this->mwlib->_format_section_head($text_date);
		
		$rowDates = $this->Mw_mt_model->get_calendar($this->blog_id, true, $year);
		$rsDates = $this->vigilantedblib->_db_return_smarty_array($rowDates);
		
		$rowEntries = $this->Mw_mt_model->get_entries_by_date($this->blog_id, $year, $month);
		
		$page_config['base_url'] = '/index.php/mw/date/' . $month . '/' . $year . '/';
		
		$this->mysmarty->assign('rsDates', $rsDates);
		$this->_display_news_page($rowEntries, $offset, 5, $page_config);
	}
	
	function entry($entry_id, $preview = false)
	{
		if (false !== ($rsEntry = $this->Mw_mt_model->get_entry_by_id($entry_id, $this->blog_id)))
		{
			//$this->vigilantecorelib->debug_trace($this->db->last_query());
			$this->mwlib->_format_section_head($rsEntry->entry_title);
			$rowComments = $this->Mw_mt_model->get_comments_by_entry_id($entry_id);
			$rsComments = $this->vigilantedblib->_db_return_smarty_array($rowComments);

			$rowTags = $this->Mw_mt_model->get_tags_by_entry_id($entry_id);
			$rsTags = $this->vigilantedblib->_db_return_smarty_array($rowTags);

			$rowLatest = $this->Mw_mt_model->get_latest_comments($this->blog_id);
			$rsLatest = $this->vigilantedblib->_db_return_smarty_array($rowLatest);

			$this->mysmarty->assign('rsEntry', $rsEntry);
			$this->mysmarty->assign('rsComments', $rsComments);
			$this->mysmarty->assign('rsTags', $rsTags);
			$this->mysmarty->assign('rsLatest', $rsLatest);
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

					if (false !== ($rsLinks = $this->mwlib->_build_buy_links($rsMap->content_release_id, $rsArtist->artist_default_amazon_locale, 'release_id', $rsMap->album_format_mask)))
					{
						$this->mysmarty->assign('rsLinks', $rsLinks);
					}
					
					if (!empty($rsAlbum->release_asin_num))
					{
						$amazon_url = $this->myamazon->build_amazon_url($rsAlbum->release_asin_num, $rsArtist->artist_default_amazon_locale);
						$this->mysmarty->assign('amazon_url', $amazon_url);
						
						$items = $this->_lookup($rsAlbum->release_asin_num, $rsArtist->artist_default_amazon_locale, 'Large');
						$display = empty($items->Request->Errors) ? true : false;
						
						/*
						if ($display == true)
						{
							$amazon_discs = $items->Item->Tracks->Disc;
							foreach ($amazon_discs as $disc)
							{
								$disc_num = intval($disc['Number']);
								foreach ($disc->Track as $track)
								{
									$track_num = intval($track['Number']);
									if (empty($track_out[$disc_num][$track_num]['track_song_title'])) {$track_out[$disc_num][$track_num]['track_song_title'] = $track;}
								}
							}
						}
						*/
						
						$image_uri = $items->Item->SmallImage->URL;
						$this->mysmarty->assign('image_uri', $image_uri);
					}
				}
			}
		}
		
		$this->mysmarty->assign('preview', $preview);
		$this->mysmarty->assign('entry_id', $entry_id);
		$this->mwlib->_smarty_display_mw_page('mw_root_entry.tpl');
	}
	
	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->mwlib->email($hidden_fields, $shown_fields, $this->mwlib->mw_config['site_name'], '/index.php/mw/contact/sent/');
	}
	
	function dl($file, $save = true)
	{
		$path = $this->mwlib->mw_config['mp3_dir_path'] . '/' . $file;
		$now = strtotime('now');
		
		if (file_exists($path) && !empty($file))
		{
			$modified_date = filemtime($path);
			$delete_date = strtotime('+1 week', $modified_date);
			$size = filesize($path);
			
			if ($now < $delete_date)
			{
				$this->_output_audio_file($path, $file, $save);
				die();
			}
			else
			{
				if (file_exists($path)) {unlink($path);}
			}
		}
	}
	
	// Private methods
	function _display_news_page($rowEntries, $offset, $segment, $page_config, $display_page = 'mw_root_browse.tpl')
	{
		$page_config['total_rows'] = $rowEntries->num_rows();
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = $segment;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mwlib->_smarty_display_mw_page($display_page);
	}
	
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
	
	function _output_audio_file($path, $filename = '', $save = false)
	{
		$size = filesize($path);
		if (false !== ($fp = fopen($path, 'rb')))
		{
			$disposition = $save == true ? 'attachment' : 'inline';
			
			header('Cache-Control: private');
			header('Content-Disposition: ' . $disposition . '; filename="' . $filename. '"');
			header('Content-Length: ' . $size);
			header('Content-Type: audio/mpeg');
			
			while (!feof($fp))
			{
				echo fread($fp, 131072);
			}
			fclose($fp);
		}
	}
}

?>