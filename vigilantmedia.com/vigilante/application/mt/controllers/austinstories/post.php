<?php

class Post extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('pagination');
		
		$this->load->model('Mt_as_aliases_model');
		$this->load->model('Mt_as_favorites_model');
		$this->load->model('Mt_as_portal_model');
		$this->load->model('Mt_as_sites_model');
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/austinstories/');
	}
	
	function browse($site_user_id)
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($site_user_id, 'Browse posts');
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowPosts = $this->Mt_as_portal_model->get_posts_by_user_id($site_user_id);
		$total_rows = $rowPosts->num_rows();
		
		$page_config['base_url'] = '/index.php/austinstories/post/browse/' . $site_user_id . '/';
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
		$this->mtlib->_smarty_display_mt_page('mt_austinstories_member_post_browse.tpl');
	}
	
	function add($site_user_id, $template = 'mt_austinstories_member_post_edit.tpl', $header = 'Add a post')
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($site_user_id, $header);
		
		$rowSites = $this->Mt_as_sites_model->get_sites_by_user_id($site_user_id);
		$rsSites = $this->vigilantedblib->_db_return_smarty_array($rowSites);
		
		$this->mysmarty->assign('rsSites', $rsSites);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($post_id, $site_user_id = '', $template = 'mt_austinstories_member_post_edit.tpl', $header = 'Edit a post')
	{
		$rsPost = $this->Mt_as_portal_model->get_post_by_id($post_id);
		if (empty($site_user_id)) {$site_user_id = $rsPost->site_user_id;}
		
		$this->mysmarty->assign('rsPost', $rsPost);
		$this->mysmarty->assign('post_id', $post_id);
		$this->add($site_user_id, $template, $header);
	}
	
	function delete($album_id, $album_artist_id = '')
	{
		$this->edit($album_id, $album_artist_id, 'mt_austinstories_member_post_delete.tpl', 'Delete a post');
	}
	
	// Processing methods
	
	function update($post_id)
	{
		$rsPost = $this->Mt_as_portal_model->get_post_by_id($post_id, true);
		$input = $this->vigilantedblib->_db_build_update_data($rsPost);
		
		$portal_publish_status = $this->input->get_post('portal_publish_status');
		
		$input['portal_id'] = $post_id;
		$input['portal_publish_status'] = intval($portal_publish_status);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_portal_model->update_post_by_id($post_id, $input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $rsPost->portal_headline . '</em> was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create($site_user_id)
	{
		$rsPost = $this->db->get('as_portal', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsPost);
		
		if (!empty($input))
		{
			$input['site_user_id'] = $site_user_id;
			if (false !== $this->Mt_as_portal_model->add_post($input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $input['portal_headline'] . '</em> was created.');
				$post_id = $this->db->insert_id();
				header('Location: /index.php/austinstories/post/edit/' . $post_id . '/' . $site_user_id . '/');
			}
		}
		
		die();
	}
	
	function remove($post_id ='', $site_user_id = '')
	{
		$confirm = $this->input->get_post('confirm');
		$portal_headline = $this->input->get_post('portal_headline');
		$portal_id = $this->input->get_post('portal_id');
		
		if (empty($site_user_id)) {$site_user_id = $this->input->get_post('site_user_id');}
		
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
				header('Location: /index.php/austinstories/post/browse/' . $site_user_id . '/');
				die();
			}
		}
		
		$msg = is_array($post_id) ? count($post_id) . ' posts were ' : '<em>' . $portal_headline . '</em> was';
		
		if ($confirm == 'Yes')
		{
			$this->Mt_as_portal_model->delete_post_by_id($post_id);
			$this->phpsession->flashsave('msg', $msg . ' deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $msg . ' not deleted.');
		}
		
		header('Location: /index.php/austinstories/post/browse/' . $site_user_id . '/');
		die();
	}
	
	// Private methods
}

?>