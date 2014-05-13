<?php

class News extends CI_Controller
{
	var $per_page = 10;
	var $news_start_year = 2003;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('AsLib');
		$this->load->model('As_mt_model');
		$this->aslib->breadcrumbs['news'] = '/index.php/news/';
	}
	
	// View methods
	
	function index()
	{
		$this->news();
	}
	
	function news()
	{
		$this->aslib->_format_section_head('site news');
		
		$offset = $this->uri->segment(3);
		
		$rowNews = $this->As_mt_model->get_latest_entries($this->aslib->blog_id);
		
		$page_config['base_url'] = '/index.php/news/more/';
		$page_config['uri_segment'] = 3;
		
		$this->_display_news_page($rowNews, $offset, $page_config);
	}
	
	function archives($y = '')
	{
		$offset = $this->uri->segment(4);
		$archiveNav = array();
		
		$rsNews = $this->As_mt_model->get_latest_entry($this->aslib->blog_id);
		$year_of_last_entry = date('Y', strtotime($rsNews->entry_created_on));
		
		if (empty($y)) {$y = $year_of_last_entry;}
		$this->aslib->_format_section_head('site news', 'archives');
		$this->aslib->breadcrumbs['archives'] = '/index.php/news/archives/';
		$this->aslib->breadcrumbs[$y] = $_SERVER['REQUEST_URI'];
		
		$rowNews = $this->As_mt_model->get_entries_by_year($y, $this->aslib->blog_id);
		
		$page_config['base_url'] = '/index.php/news/archives/' . $y . '/';
		$page_config['uri_segment'] = 4;
		
		for ($i=$year_of_last_entry; $i>=$this->news_start_year; $i--)
		{
			$archiveNav[] = $i;
		}
		
		$this->mysmarty->assign('displayDate', $y);
		$this->mysmarty->assign('archiveNav', $archiveNav);
		
		$this->_display_news_page($rowNews, $offset, $page_config, 'as_news_archives.tpl');
	}
	
	function entry($entry_id)
	{
		$this->aslib->_format_section_head('site news');
		
		$rsNews = $this->As_mt_model->get_entry_by_id($entry_id, $this->aslib->blog_id);
		
		$this->mysmarty->assign('rsNews', $rsNews);
		$this->aslib->_smarty_display_as_page('as_news_news.tpl');
	}
	
	// Processing methods
	
	// Private methods
	function _display_news_page($rowNews, $offset, $page_config, $display_page = 'as_news_index.tpl')
	{
		$page_config['total_rows'] = $rowNews->num_rows();
		$page_config['per_page'] = $this->per_page;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsNews = $this->vigilantedblib->_db_return_smarty_array($rowNews, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsNews', $rsNews);
		$this->aslib->_smarty_display_as_page($display_page);
	}
}

?>