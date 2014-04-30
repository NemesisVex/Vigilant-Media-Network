<?php

class Index extends CI_Controller
{
	var $blog_id = 1;
	var $custom_map = array('1968' => '_040105_');
	
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
	}
	
	// View methods
	
	function index()
	{
		$rsEntry = $this->Gb_mt_model->get_latest_entry($this->blog_id, true);
		$this->_build_entry_page($rsEntry->entry_id, $rsEntry);
	}
	
	function entry($entry_id, $secret = '')
	{
		if ($entry_id == 'random')
		{
			$rsEntry = $this->Gb_mt_model->get_random_entry($this->blog_id);
			header('Location: /index.php/journal/entry/' . $rsEntry->entry_id . '/');
			die();
		}
		
		$rsEntry = $this->Gb_mt_model->get_entry_by_id($entry_id, $this->blog_id);
		$this->gblib->page_title .= $rsEntry->entry_title;
		if (!empty($secret)) {$this->gblib->page_title .= ' (secret)';}
		
		$this->_build_entry_page($entry_id, $rsEntry, $secret);
	}
	
	function about()
	{
		$this->gblib->_format_section_head('History');
		$this->gblib->_smarty_display_journal_protected_page('gb_journal_about.tpl');
	}
	
	function cast()
	{
		$this->gblib->_format_section_head('Cast');
		$this->gblib->_smarty_display_journal_protected_page('gb_journal_cast.tpl');
	}
	
	function links()
	{
		$this->gblib->_format_section_head('Links');
		$this->gblib->_smarty_display_journal_protected_page('gb_journal_links.tpl');
	}
	
	function contact()
	{
		$this->gblib->_format_section_head('Contact');
		$this->gblib->_smarty_display_journal_protected_page('gb_journal_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->gblib->_format_section_head('Contact');
		$this->gblib->_smarty_display_journal_protected_page('gb_sakufu_contact_sent.tpl');
	}
	
	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->gblib->email($hidden_fields, $shown_fields, mb_convert_encoding("&#26085;&#12293;&#12398;&#26412;", 'ISO-8859-1', 'UTF-8'), '/index.php/journal/contact/sent/');
	}
	
	// Private methods
	function _build_entry_page($entry_id, $rsEntry, $secret = '')
	{
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
		
		if (false !== ($rowPasEntries = $this->Gb_mt_model->get_entries_on_this_day($rsEntry->entry_created_on, $this->blog_id)))
		{
			$rsPastEntries = $this->vigilantedblib->_db_return_smarty_array($rowPasEntries);
			$this->mysmarty->assign('rsPastEntries', $rsPastEntries);
		}
		
		if ($this->phpsession->get(null, 'is_logged_in')==true)
		{
			$rsUser = $this->Mt_user_model->get_user_by_id($this->phpsession->get(null, 'user_id'));
			$this->mysmarty->assign('rsUser', $rsUser);
		}
		
		$this->mysmarty->assign('rsEntry', $rsEntry);
		$this->mysmarty->assign('rsComments', $rsComments);
		$this->mysmarty->assign('entry_id', $entry_id);
		
		if (!empty($secret))
		{
			$this->gblib->_smarty_display_journal_protected_page('gb_journal_entry_secret.tpl');
		}
		else
		{
			if (!empty($this->custom_map[$entry_id]))
			{
				$custom_prefix = $this->custom_map[$entry_id];
				$this->gblib->_smarty_display_journal_protected_page($custom_prefix . 'gb_journal_entry.tpl', $custom_prefix . 'gb_journal_layout.tpl');
			}
			else
			{
				$this->gblib->_smarty_display_journal_protected_page('gb_journal_entry.tpl');
			}
		}
	}
}

?>