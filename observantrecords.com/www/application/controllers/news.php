<?php

class News extends CI_Controller
{
	public $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('VmModel_MtEntry', array('dsn' => 'mt'));
		$this->load->library('ObservantView');
	}
	
	// View methods
	
	function index()
	{
		$this->news();
	}
	
	function news()
	{
		$segment = 3;
		$this->vmview->format_section_head('Blog');
		
		$offset = $this->uri->segment($segment);
		
		$rowNews = $this->vmmodel_mtentry->get_latest_entries(null, 5, false);
		
		$page_config['base_url'] = '/index.php/news/more/';
		$page_config['uri_segment'] = $segment;
		
		$this->_display_news_page($rowNews, $offset, $page_config);
	}
	
	function archives($y = '')
	{
		$offset = $this->uri->segment(4);
		
		$rsLatest = $this->vmmodel_mtentry->get_latest_entry();
		$year_of_last_entry = false !== $rsLatest ? date('Y', strtotime($rsLatest->entry_created_on)) : date("Y");
		
		if (empty($y)) {$y = $year_of_last_entry;}
		
		$this->vmview->format_section_head('Blog', 'Archive', $y);
		
		$rowNews = $this->vmmodel_mtentry->get_entries_by_year($y, null, false);
		
		$page_config['base_url'] = '/index.php/news/archives/' . $y . '/';
		$page_config['uri_segment'] = 4;
		
		$rowCalendar = $this->vmmodel_mtentry->get_calendar(null, false);
		$archiveNav = null;
		foreach ($rowCalendar->result() as $rsCalendar)
		{
			$archiveNav[] = $rsCalendar->entry_year;
		}
		
		$this->mysmarty->assign('displayDate', $y);
		$this->mysmarty->assign('archiveNav', $archiveNav);
		
		$this->_display_news_page($rowNews, $offset, $page_config, 'obr_news_archives.tpl');
	}
	
	function entry($entry_id)
	{
		$rsNews = $this->vmmodel_mtentry->retrieve_by_id($entry_id);
		$this->vmview->format_section_head('Blog', $rsNews->entry_title);
		
		$this->mysmarty->assign('rsNews', $rsNews);
		$this->vmview->display('obr_news_news.tpl');
	}
	
	function newsletter($code = '', $name = '', $address = '')
	{
		$this->output->set_status_header(410);
	}
	
	// Processing methods
	
	// Private methods
	function _display_news_page($rowNews, $offset, $page_config, $display_page = 'obr_news_index.tpl')
	{
		$page_config['total_rows'] = $rowNews->num_rows();
		$page_config['per_page'] = $this->per_page;
		$this->pagination->initialize($page_config);
		
		$rsNews = $this->vmmodel_mtentry->return_smarty_array($rowNews, $this->per_page, $offset);
		
		$page_links = $this->pagination->create_links();
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsNews', $rsNews);
		$this->vmview->display($display_page);
	}
}

?>