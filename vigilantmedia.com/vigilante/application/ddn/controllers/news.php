<?php

class News extends CI_Controller
{
	var $per_page = 10;
	var $news_start_year = 2009;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('DdnLib');
		$this->load->model('Ddn_mt_model');
		$this->ddnlib->breadcrumbs['news'] = '/index.php/news/';
	}
	
	// View methods
	
	function index()
	{
		$this->news();
	}
	
	function news()
	{
		$this->ddnlib->_format_section_head('Site news');
		
		$offset = $this->uri->segment(3);
		
		$rowNews = $this->Ddn_mt_model->get_latest_entries($this->ddnlib->blog_id);
		
		$page_config['base_url'] = '/index.php/news/more/';
		$page_config['uri_segment'] = 3;
		
		$this->_display_news_page($rowNews, $offset, $page_config);
	}
	
	function archives($m, $y)
	{
		$offset = $this->uri->segment(5);
		$archive_nav = array();
		$display_date = date('M. Y', strtotime("$m/1/$y"));
		
		$this->ddnlib->_format_section_head('Site news', 'Archives: ' . $display_date);
		
		$rowNews = $this->Ddn_mt_model->get_entries_by_date($this->ddnlib->blog_id, $y, $m);

		$page_config['base_url'] = '/index.php/news/archives/' . $y . '/';
		$page_config['uri_segment'] = 5;
		
		$this->mysmarty->assign('display_date', $display_date);
		$this->mysmarty->assign('archive_nav', $archive_nav);
		
		$this->_display_news_page($rowNews, $offset, $page_config, 'ddn_news_archives.tpl');
	}
	
	function entry($entry_id)
	{
		$this->ddnlib->_format_section_head('Site news');
		
		$rsNews = $this->Ddn_mt_model->get_entry_by_id($entry_id, $this->ddnlib->blog_id);
		
		$rowDates = $this->Ddn_mt_model->get_calendar($this->ddnlib->blog_id);
		$rsDates = $this->vigilantedblib->_db_return_smarty_array($rowDates);

		$this->mysmarty->assign('rsNews', $rsNews);
		$this->mysmarty->assign('rsDates', $rsDates);
		$this->mysmarty->assign('content_side_template', 'ddn_news_side.tpl');
		$this->ddnlib->_smarty_display_ddn_page('ddn_news_news.tpl');
	}
	
	// Processing methods
	
	// Private methods
	function _display_news_page($rowNews, $offset, $page_config, $display_page = 'ddn_news_index.tpl', $content_side_template = 'ddn_news_side.tpl')
	{
		$page_config['total_rows'] = $rowNews->num_rows();
		$page_config['per_page'] = $this->per_page;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsNews = $this->vigilantedblib->_db_return_smarty_array($rowNews, $this->per_page, $offset);
		
		$rowDates = $this->Ddn_mt_model->get_calendar($this->ddnlib->blog_id);
		$rsDates = $this->vigilantedblib->_db_return_smarty_array($rowDates);

		$this->mysmarty->assign('content_side_template', $content_side_template);
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsNews', $rsNews);
		$this->mysmarty->assign('rsDates', $rsDates);
		$this->ddnlib->_smarty_display_ddn_page($display_page);
	}
}

?>