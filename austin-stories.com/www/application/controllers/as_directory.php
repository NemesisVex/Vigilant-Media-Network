<?php

class As_directory extends CI_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('pagination');
		$this->load->library('AsLib');
		$this->load->model('As_aliases_model');
		$this->load->model('As_favorites_model');
		$this->load->model('As_portal_model');
		$this->load->model('As_sites_model');
		$this->load->model('Mt_user_model');
		$this->aslib->breadcrumbs['directory'] = '/index.php/directory/';
	}
	
	function index()
	{
		$this->aslib->_format_section_head('directory');
		
		$rowPosts = $this->As_portal_model->get_directory_posts();
		$rsPosts = $this->vigilantedblib->_db_return_smarty_array($rowPosts);
		
		$this->mysmarty->assign('rsPosts', $rsPosts);
		$this->aslib->_smarty_display_as_page('as_directory_index.tpl');
	}
	
	function posts($portal_site_id)
	{
		$segment = 4;
		$offset = $this->uri->segment($segment);
		
		$rsSite = $this->As_sites_model->get_site_by_id($portal_site_id);
		$this->aslib->_format_section_head('directory', $rsSite->site_name, 'posts');
		$this->aslib->breadcrumbs['posts'] = $_SERVER['REQUEST_URI'];
		
		$rowPosts = $this->As_portal_model->get_posts_by_site_id($portal_site_id);
		$total_rows = $rowPosts->num_rows();
		
		$page_config['base_url'] = '/index.php/directory/posts/' . $portal_site_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = $segment;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsPosts = $this->vigilantedblib->_db_return_smarty_array($rowPosts, $this->per_page, $offset);
		
		$this->mysmarty->assign('rsPosts', $rsPosts);
		$this->mysmarty->assign('page_links', $page_links);
		$this->aslib->_smarty_display_as_page('as_directory_posts.tpl');
	}
	
	function feed($portal_site_id)
	{
		$segment = 4;
		$this->per_page = 10;
		$offset = $this->uri->segment($segment);
		if (empty($offset)) {$offset = 0;}
		
		$rsSite = $this->As_sites_model->get_site_by_id($portal_site_id);
		$this->aslib->_format_section_head('directory', $rsSite->site_name, 'feed');
		$this->aslib->breadcrumbs['feed'] = $_SERVER['REQUEST_URI'];
		
		if (!empty($rsSite->site_rss_feed))
		{
			$xml = @fetch_rss($rsSite->site_rss_feed);
			$items = $xml->items;
			
			$total_rows = count($items);
			
			$page_config['base_url'] = '/index.php/directory/feed/' . $portal_site_id . '/';
			$page_config['total_rows'] = $total_rows;
			$page_config['per_page'] = $this->per_page;
			$page_config['uri_segment'] = $segment;
			$page_config['num_links'] = 5;
			$this->pagination->initialize($page_config);
			
			$page_links = $this->pagination->create_links();
			
			$items = array_slice($items, $offset, $this->per_page);
			//$this->vigilantecorelib->debug_trace(count($items));
			$this->mysmarty->assign('items', $items);
		}
		
		$this->aslib->_smarty_display_as_page('as_directory_rss.tpl');
	}
	//Processing methods
}
?>