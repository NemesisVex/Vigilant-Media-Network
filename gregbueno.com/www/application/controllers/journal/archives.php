<?php

class Archives extends CI_Controller
{
	var $per_page = 10;
	var $blog_id = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('GbLib');
		$this->load->model('Gb_mt_model');
		$this->mysmarty->assign('blog_id', $this->blog_id);
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		$rsEntry = $this->Gb_mt_model->get_latest_entry($this->blog_id);
		$year_of_last_entry = date('Y', strtotime($rsEntry->entry_created_on));
		
		$this->date($year_of_last_entry);
	}
	
	function date($y)
	{
		$segment = 4;
		
		$this->gblib->_format_section_head('Archive', $y);
		
		$rowEntries = $this->Gb_mt_model->get_entries_by_year($y, $this->blog_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('entry_header', $y);
		
		$this->_build_archive();
	}
	
	function category($category_id)
	{
		$segment = 4;
		
		$rowEntries = $this->Gb_mt_model->get_entries_by_category_id($category_id, $this->blog_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$rsCategory = $this->Gb_mt_model->get_category_by_id($category_id);
		
		$this->gblib->_format_section_head('Archive', $rsCategory->category_label);
		
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('entry_header', $rsCategory->category_label);
		
		$this->_build_archive();
	}
	
	function _build_archive()
	{
		$rowCalendar = $this->Gb_mt_model->get_calendar($this->blog_id, false);
		$rsCalendar = $this->vigilantedblib->_db_return_smarty_array($rowCalendar);
		
		$rowCategories = $this->Gb_mt_model->get_all_categories($this->blog_id);
		$rsCategories = $this->vigilantedblib->_db_return_smarty_array($rowCategories);
		
		$this->mysmarty->assign('rsCalendar', $rsCalendar);
		$this->mysmarty->assign('rsCategories', $rsCategories);
		
		$this->gblib->_smarty_display_journal_protected_page('gb_journal_archives.tpl');
	}
}
?>