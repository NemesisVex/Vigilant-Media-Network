<?php

class Aus extends CI_Controller
{
	var $error_codes = array('401' => 'Authentication required', '403' => 'Forbidden', '404' => 'Not found', '500' => 'Internal server error');
	var $blog_id = 9;
	var $bloggers_xml_uri = 'http://www.austinbloggers.org/blog/metablog.xml';
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('AsLib');
		$this->load->model('As_aliases_model');
		$this->load->model('As_favorites_model');
		$this->load->model('As_portal_model');
		$this->load->model('As_sites_model');
		$this->load->model('As_mt_model');
		$this->load->model('Mt_user_model');
	}
	
	function index()
	{
		$this->aslib->breadcrumbs = null;
		
		$rowPosts = $this->As_portal_model->get_recent_posts();
		$rsPosts = $this->vigilantedblib->_db_return_smarty_array($rowPosts);
		
		$rowNewSites = $this->As_sites_model->get_recent_sites();
		$rsNewSites = $this->vigilantedblib->_db_return_smarty_array($rowNewSites);
		
//		$rowEntries = $this->As_mt_model->get_latest_entries($this->blog_id);
//		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$feed = $this->_get_austinbloggers_feed(3);
		$this->mysmarty->assign('feed', $feed);
		
		$this->mysmarty->assign('rsPosts', $rsPosts);
		$this->mysmarty->assign('rsNewSites', $rsNewSites);
//		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->aslib->_smarty_display_as_page('as_root_index.tpl');
	}
	
	function bloggers()
	{
		$this->aslib->_format_section_head('austin bloggers meta-blog');
		$this->aslib->breadcrumbs['austin bloggers meta-blog'] = $_SERVER['REQUEST_URI'];
		
		$feed = $this->_get_austinbloggers_feed();
		
		$this->mysmarty->assign('feed', $feed);
		$this->aslib->_smarty_display_as_page('as_root_bloggers.tpl');
	}
	
	function about()
	{
		$this->aslib->_format_section_head('about');
		$this->aslib->breadcrumbs['about'] = $_SERVER['REQUEST_URI'];
		
		$this->aslib->_smarty_display_as_page('as_root_about.tpl');
	}
	
	function terms()
	{
		$this->aslib->_format_section_head('terms and conditions of use');
		$this->aslib->breadcrumbs['terms and conditions of use'] = $_SERVER['REQUEST_URI'];
		
		$this->aslib->_smarty_display_as_page('as_root_terms.tpl');
	}
	
	function contact()
	{
		$this->aslib->_format_section_head('contact');
		$this->aslib->breadcrumbs['contact'] = $_SERVER['REQUEST_URI'];
		
		$this->aslib->_smarty_display_as_page('as_root_contact.tpl');
	}
	
	function contact_sent()
	{
		$this->aslib->_format_section_head('contact');
		$this->aslib->breadcrumbs['contact'] = '/index.php/aus/contact/';
		
		$this->aslib->_smarty_display_as_page('as_root_contact_sent.tpl');
	}
	
	function error($code)
	{
		$this->aslib->_format_section_head('error', $code, $this->error_codes[$code]);
		$this->aslib->_smarty_display_as_page('as_error_' . $code . '.tpl');
	}
	
	function robots()
	{
		$subject = 'Austin Stories: Bad robot report';
		$message = $this->mysmarty->fetch('as_root_robots_email.tpl');
		
		$mail_config['protocol'] = 'mail';
		$mail_config['mailpath'] = '/usr/bin/mail';
		$mail_config['charset'] = 'utf-8';
		$mail_config['wordwrap'] = true;
		
		$this->email->initialize($mail_config);
		
		$this->email->from($this->aslib->webmaster_email, 'Austin Stories Webmaster');
		$this->email->to($this->aslib->webmaster_email);
		
		$this->email->subject($subject);
		$this->email->message($message);
		
		if (false !== $this->email->send())
		{
			header('Location: /');
			die();
		}
		
		echo $this->email->print_debugger();
	}
	
	//Processing methods
	function email()
	{
		$hidden_fields = array('i', 's', 'r', 'm');
		$shown_fields = array('realname' => 'n',
		'email' => 'a',
		'subject' => 't',
		'message' => 'b');
		$this->aslib->email($hidden_fields, $shown_fields);
	}
	
	//Private methods
	function _get_austinbloggers_feed($limit = '')
	{
		$xml = @fetch_rss($this->bloggers_xml_uri);
		$items = $xml->items;
		if (empty($limit)) {$limit = count($items);}
		
		$e=0;
		for ($i=0; $i<count($items); $i++)
		{
			if ($items[$i]['title'] != '(this entry has been removed)')
			{
				$feed[] = $items[$i];
				$e++;
			}
			if ($e>=$limit) {break;}
		}
		return $feed;
	}
}
?>