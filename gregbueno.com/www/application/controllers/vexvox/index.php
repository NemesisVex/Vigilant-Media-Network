<?php

class Index extends CI_Controller
{
	var $per_page = 10;
	var $news_start_year = 2007;
	var $blog_id = 13;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('GbLib');
		$this->load->model('Gb_mt_model');
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('blog_id', $this->blog_id);
		$this->mysmarty->assign('session', $this->phpsession);

		if (false !== $this->phpsession->get(null, 'is_logged_in'))
		{
			$user_id = $this->phpsession->get(null, 'user_id');
			$rsUser = $this->Mt_user_model->get_user_by_id($user_id);
			$this->mysmarty->assign('rsUser', $rsUser);
		}

		$rowCalendar = $this->Gb_mt_model->get_calendar($this->blog_id, false);
		$rsCalendar = $this->vigilantedblib->_db_return_smarty_array($rowCalendar);

		$rowCategories = $this->Gb_mt_model->get_all_categories($this->blog_id);
		$rsCategories = $this->vigilantedblib->_db_return_smarty_array($rowCategories);

		$this->mysmarty->assign('rsCalendar', $rsCalendar);
		$this->mysmarty->assign('rsCategories', $rsCategories);
	}
	
	// View methods
	
	function index()
	{
		$segment = 3;
		$offset = $this->uri->segment($segment);

		$rowEntries = $this->Gb_mt_model->get_latest_entries($this->blog_id);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		
		$page_config['base_url'] = '/index.php/vexvox/index/';

		$this->_display_vexvox_page($rowEntries, $offset, $segment, $page_config, 'gb_vexvox_index.tpl');
	}
	
	function entry($entry_id)
	{
		if ($entry_id == 'random')
		{
			$rsEntry = $this->Gb_mt_model->get_random_entry($this->blog_id);
			header('Location: /index.php/vexvox/entry/' . $rsEntry->entry_id . '/');
			die();
		}
		
		$rsEntry = $this->Gb_mt_model->get_entry_by_id($entry_id, $this->blog_id);
		$this->gblib->page_title .= $rsEntry->entry_title;
		
		$rowComments = $this->Gb_mt_model->get_comments_by_entry_id($entry_id);
		$rsComments = $this->vigilantedblib->_db_return_smarty_array($rowComments);
		
		if (false !== ($rsPrevious = $this->Gb_mt_model->get_adjacent_entry($rsEntry->entry_created_on, $this->blog_id, 'desc')))
		{
			$this->mysmarty->assign('rsPrevious', $rsPrevious);
		}
		
		if (false !== ($rsNext = $this->Gb_mt_model->get_adjacent_entry($rsEntry->entry_created_on, $this->blog_id)))
		{
			$this->mysmarty->assign('rsNext', $rsNext);
		}
		
		if ($this->phpsession->get(null, 'is_logged_in')==true)
		{
			$rsUser = $this->Mt_user_model->get_user_by_id($this->phpsession->get(null, 'user_id'));
			$this->mysmarty->assign('rsUser', $rsUser);
		}
		
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->mysmarty->assign('rsComments', $rsComments);
		$this->mysmarty->assign('entry_id', $entry_id);
		$this->gblib->_smarty_display_vexvox_page('gb_vexvox_entry.tpl');
	}
	
	function date($y)
	{
		/*
		$segment = 4;

		$this->gblib->_format_section_head('Archive', $y);

		$rowEntries = $this->Gb_mt_model->get_entries_by_year($y, $this->blog_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);

		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('entry_header', $y);

		$this->_build_archive();
		 *
		 */
		$offset = $this->uri->segment(4);

		$this->gblib->_format_section_head($y);

		$rowEntries = $this->Gb_mt_model->get_entries_by_year($y, $this->blog_id);

		$page_config['base_url'] = '/index.php/vexvox/date/' . $y . '/';

		$this->_display_vexvox_page($rowEntries, $offset, 4, $page_config);
	}

	function category($category_id)
	{
		/*
		 *
		$segment = 4;

		$rowEntries = $this->Gb_mt_model->get_entries_by_category_id($category_id, $this->blog_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);

		$rsCategory = $this->Gb_mt_model->get_category_by_id($category_id);

		$this->gblib->_format_section_head('Archive', $rsCategory->category_label);

		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('entry_header', $rsCategory->category_label);

		$this->_build_archive();
		 */

		$offset = $this->uri->segment(4);

		$rsCategory = $this->Gb_mt_model->get_category_by_id($category_id);

		$this->gblib->_format_section_head($rsCategory->category_label);

		$rowEntries = $this->Gb_mt_model->get_entries_by_category_id($category_id, $this->blog_id);

		$page_config['base_url'] = '/index.php/vexvox/category/' . $category_id . '/';

		$this->_display_vexvox_page($rowEntries, $offset, 4, $page_config);
	}

	function about()
	{
		$this->gblib->_format_section_head('History');
		$this->gblib->_smarty_display_sakufu_page('gb_vexvox_about.tpl');
	}
	
	function contact()
	{
		$this->gblib->_format_section_head('Contact');
		$this->gblib->_smarty_display_sakufu_page('gb_vexvox_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->gblib->_format_section_head('Contact');
		$this->gblib->_smarty_display_sakufu_page('gb_vexvox_contact_sent.tpl');
	}
	
	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->gblib->email($hidden_fields, $shown_fields, 'VexVox;', '/index.php/vexvox/contact/sent/');
	}
	
	// Private methods
	function _display_vexvox_page($rowEntries, $offset, $segment, $page_config, $display_page = 'gb_vexvox_index.tpl')
	{
		$page_config['total_rows'] = $rowEntries->num_rows();
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = $segment;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->gblib->_smarty_display_vexvox_page($display_page);
	}
}

?>