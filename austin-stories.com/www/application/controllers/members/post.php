<?php

class Post extends CI_Controller
{
	var $rss_file;
	var $deny_level_masks = array(1 => 'Banned/rejected', 2 => 'Pending', 4 => 'Temporary');
	var $user_id;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('AsLib');
		$this->load->library('pagination');
		
		$this->load->model('As_aliases_model');
		$this->load->model('As_favorites_model');
		$this->load->model('As_portal_model');
		$this->load->model('As_sites_model');
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->rss_file = $_SERVER['DOCUMENT_ROOT'] . '/rss.xml';
		$this->aslib->breadcrumbs['my austin stories'] = '/index.php/members/';
		
		$this->user_id = $this->phpsession->get(null, 'user_id');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/austinstories/');
	}
	
	function browse()
	{
		$site_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'posts');
		$this->aslib->breadcrumbs['posts'] = $_SERVER['REQUEST_URI'];
		
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowPosts = $this->As_portal_model->get_posts_by_user_id($site_user_id);
		$total_rows = $rowPosts->num_rows();
		
		$page_config['base_url'] = '/index.php/members/post/browse/' . $site_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsPosts = $this->vigilantedblib->_db_return_smarty_array($rowPosts, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsPosts', $rsPosts);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mysmarty->assign('user_id', $site_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_post_browse.tpl');
	}
	
	function add($template = 'as_members_post_edit.tpl', $header = 'add a post')
	{
		$site_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'posts', $header);
		$this->aslib->breadcrumbs['posts'] = '/index.php/members/post/browse/' . $site_user_id . '/';
		$this->aslib->breadcrumbs[$header] = $_SERVER['REQUEST_URI'];
		
		$rsUser = $this->Mt_user_model->get_user_by_id($site_user_id);
		$this->mysmarty->assign('rsUser', $rsUser);
		
		$user_level_mask = intval($rsUser->user_level_mask);
		$deny_access = $this->vigilantecorelib->_check_mask($this->deny_level_masks, $user_level_mask);
		$user_access_mask = intval($rsUser->user_access_mask);
		if (($deny_access == true) || (($user_access_mask & 8)==0))
		{
			$this->phpsession->flashsave('error', '<strong>Sorry</strong>. Your account is not enabled to post to the site.');
			header('Location: /index.php/members/post/browse/' . $site_user_id . '/');
			die();
		}
		$this->mysmarty->assign('user_access_mask', $user_access_mask);
		
		$rowSites = $this->As_sites_model->get_sites_by_user_id($site_user_id);
		$rsSites = $this->vigilantedblib->_db_return_smarty_array($rowSites);
		
		$this->mysmarty->assign('rsSites', $rsSites);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mysmarty->assign('user_id', $site_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', $template);
	}
	
	function edit($post_id, $template = 'as_members_post_edit.tpl', $header = 'edit a post')
	{
		$rsPost = $this->As_portal_model->get_post_by_id($post_id);
		
		if (!empty($rsPost))
		{
			foreach ($rsPost as $field => $value)
			{
				$input[$field] = $value;
			}
			$this->mysmarty->assign('input', $input);
		}
		
		$this->mysmarty->assign('rsPost', $rsPost);
		$this->mysmarty->assign('post_id', $post_id);
		$this->add($template, $header);
	}
	
	function delete($album_id)
	{
		$this->edit($album_id, 'as_members_post_delete.tpl', 'delete a post');
	}
	
	function rss()
	{
		$site_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'posts', 'add a post from rss');
		$this->aslib->breadcrumbs['posts'] = '/index.php/members/post/browse/' . $site_user_id . '/';
		$this->aslib->breadcrumbs['add a post from rss'] = $_SERVER['REQUEST_URI'];
		
		$rowSites = $this->As_sites_model->get_sites_with_feeds_by_user_id($site_user_id);
		$has_feeds = $rowSites->num_rows() > 0 ? true : false;
		if ($has_feeds == true)
		{
			$e=0;
			foreach ($rowSites->result() as $rs)
			{
				if (!empty($rs->site_rss_feed))
				{
					$xml_feed = @fetch_rss($rs->site_rss_feed);
					$site_ids[$e] = $rs->site_id;
					$feeds[$e] = $xml_feed;
					$e++;
				}
			}
			$this->mysmarty->assign('site_ids', $site_ids);
			$this->mysmarty->assign('feeds', $feeds);
		}
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mysmarty->assign('user_id', $site_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_post_rss_browse.tpl');
	}
	
	function rss_add()
	{
		$this->aslib->_format_section_head('my austin stories', 'posts', 'add a post from rss');
		$this->aslib->breadcrumbs['posts'] = '/index.php/members/post/browse/' . $this->phpsession->get(null, 'user_id') . '/';
		
		$portal_headline = $this->input->get_post('portal_headline');
		$portal_url = $this->input->get_post('portal_url');
		$portal_user_id = $this->input->get_post('portal_user_id');
		
		if (false !== ($rsPost = $this->As_portal_model->check_rss_entry($portal_headline, $portal_url)))
		{
			$this->mysmarty->assign('portal_user_id', $portal_user_id);
			$this->mysmarty->assign('rsPost', $rsPost);
			$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_post_rss_edit.tpl');
		}
		else
		{
			$this->rss_edit($portal_user_id);
		}
	}
	
	function rss_edit()
	{
		$post_id = $this->input->get_post('portal_id');
		
		foreach ($_POST as $field => $value)
		{
			$input[$field] = $value;
		}
		
		$this->mysmarty->assign('post_id', $post_id);
		$this->mysmarty->assign('input', $input);
		$this->add();
	}
	
	// Processing methods
	
	function update($post_id)
	{
		$rsPost = $this->As_portal_model->get_post_by_id($post_id, true);
		
		$rsSite = $this->As_sites_model->get_site_by_id($rsPost->portal_site_id);
		if ($this->user_id != $rsSite->site_user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to update this post.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$input = $this->vigilantedblib->_db_build_update_data($rsPost);
		
		$portal_publish_status = $this->input->get_post('portal_publish_status');
		
		$input['portal_id'] = $post_id;
		$input['portal_publish_status'] = intval($portal_publish_status);
		
		if (!empty($input))
		{
			if (false !== $this->As_portal_model->update_post_by_id($post_id, $input))
			{
				$this->_export_rss_feed();
				$this->phpsession->flashsave('msg', '<em>' . $rsPost->portal_headline . '</em> was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create()
	{
		$portal_site_id = $this->input->get_post('portal_site_id');
		$rsSite = $this->As_sites_model->get_site_by_id($portal_site_id);
		if ($rsSite->site_user_id != $this->user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to create a post for this account.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$rsPost = $this->db->get('as_portal', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsPost);
		
		$portal_publish_status = $this->input->get_post('portal_publish_status');
		
		if (!empty($input))
		{
			$input['portal_publish_status'] = strval($portal_publish_status);
			if (false !== $this->As_portal_model->add_post($input))
			{
				if ($portal_publish_status==true) {$this->_export_rss_feed();}
				$this->phpsession->flashsave('msg', '<em>' . $input['portal_headline'] . '</em> was created.');
				$post_id = $this->db->insert_id();
				header('Location: /index.php/members/post/edit/' . $post_id . '/');
			}
		}
		
		die();
	}
	
	function remove($post_id)
	{
		$rsPost = $this->As_portal_model->get_post_by_id($post_id, true);
		$rsSite = $this->As_sites_model->get_site_by_id($rsPost->portal_site_id);
		if ($this->user_id != $rsSite->site_user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to delete this post.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$confirm = $this->input->get_post('confirm');
		$portal_headline = $this->input->get_post('portal_headline');
		$portal_id = $this->input->get_post('portal_id');
		
		if (empty($post_id))
		{
			if (!empty($portal_id))
			{
				$post_id = $portal_id;
				$confirm = 'Yes';
			}
			else
			{
				$this->phpsession->flashsave('error', 'No posts were specified for deletion.');
				header('Location: /index.php/members/post/browse/');
				die();
			}
		}
		
		$msg = is_array($post_id) ? (count($post_id) <= 1 ? count($post_id) . ' posts was ' : count($post_id) . ' posts were ') : '<em>' . $portal_headline . '</em> was';
		
		if ($confirm == 'Yes')
		{
			$this->As_portal_model->delete_post_by_id($post_id);
			$this->_export_rss_feed();
			$this->phpsession->flashsave('msg', $msg . ' deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $msg . ' not deleted.');
		}
		
		header('Location: /index.php/members/post/browse/');
		die();
	}
	
	// Private methods
	function _export_rss_feed($limit = 15)
	{
		$rowEntries = $this->As_portal_model->get_recent_posts($limit);
		$e = 0;
		foreach ($rowEntries->result() as $rsEntry)
		{
			$bodytext = '';
			$rsItems[$e]['portal_headline'] = $rsEntry->portal_headline;
			$rsItems[$e]['portal_url'] = htmlentities(strip_tags($rsEntry->portal_url));
			$rsItems[$e]['portal_date_added'] = date("Y-m-d\TH:i:s-08:00", strtotime($rsEntry->portal_date_added));
			$rsItems[$e]['site_name'] = $rsEntry->site_name;
			$rsItems[$e]['user_display_name'] = $this->vigilantecorelib->_member_get_display_name($rsEntry->user_first_name, $rsEntry->user_last_name, $rsEntry->user_login, $rsEntry->user_access_mask); //$rs->Email;
			$truncText = explode(" ", $rsEntry->portal_body_text);
			if (count($truncText) >= 50)
			{
				for ($i=0; $i<50; $i++)
				{
					$bodytext .= ($i+1 >= 50) ? $truncText[$i] . " ... " : $truncText[$i] . " ";
				}
			}
			else
			{
				$bodytext = $rsEntry->portal_body_text;
			}
			$rsItems[$e]['portal_body_text'] = $bodytext;
			$e++;
		}
		
		if (!empty($rsItems))
		{
			$this->mysmarty->assign('rsItems', $rsItems);
			$xml_out = $this->mysmarty->fetch('as_root_rss.tpl');
			
			$file = $this->rss_file;
			if (false !== file_exists($file)) {touch ($file);}
			if (false !== ($fp = fopen($file, "w")))
			{
				fwrite($fp, $xml_out);
				fclose($fp);
			}
		}
	}
}

?>