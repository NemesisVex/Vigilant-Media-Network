<?php

class Site extends CI_Controller
{
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
		
		$this->aslib->_format_section_head('my austin stories', 'browse sites');
		$this->aslib->breadcrumbs['sites'] = $_SERVER['REQUEST_URI'];
		
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowSites = $this->As_sites_model->get_sites_by_user_id($site_user_id);
		$total_rows = $rowSites->num_rows();
		
		$page_config['base_url'] = '/index.php/members/site/browse/' . $site_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsSites = $this->vigilantedblib->_db_return_smarty_array($rowSites, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsSites', $rsSites);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mysmarty->assign('user_id', $site_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_site_browse.tpl');
	}
	
	function add($template = 'as_members_site_edit.tpl', $header = 'add a site')
	{
		$site_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'sites', $header);
		$this->aslib->breadcrumbs['sites'] = '/index.php/members/sites/browse/' . $site_user_id . '/';
		$this->aslib->breadcrumbs[$header] = $_SERVER['REQUEST_URI'];
		
		$rsUser = $this->Mt_user_model->get_user_by_id($site_user_id);
		$this->mysmarty->assign('rsUser', $rsUser);
		
		$rowAliases = $this->As_aliases_model->get_alias_by_user_id($site_user_id);
		$rsAliases = $this->vigilantedblib->_db_return_smarty_array($rowAliases);
		
		$this->mysmarty->assign('rsAliases', $rsAliases);
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mysmarty->assign('user_id', $site_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', $template);
	}
	
	function edit($site_id, $template = 'as_members_site_edit.tpl', $header = 'edit a site')
	{
		$rsSite = $this->As_sites_model->get_site_by_id($site_id);
		
		$this->mysmarty->assign('rsSite', $rsSite);
		$this->mysmarty->assign('site_id', $site_id);
		$this->add($template, $header);
	}
	
	function delete($site_id)
	{
		$this->edit($site_id, 'as_members_site_delete.tpl', 'delete a site');
	}
	
	// Processing methods
	
	function update($site_id)
	{
		$rsSite = $this->As_sites_model->get_site_by_id($site_id);
		if ($this->user_id != $rsSite->site_user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to update this site.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$input = $this->vigilantedblib->_db_build_update_data($rsSite);
		
		$site_in_directory = $this->input->get_post('site_in_directory');
		$site_alias_id = $this->input->get_post('site_alias_id');
		
		$input['site_id'] = $site_id;
		$input['site_user_id'] = $this->user_id;
		$input['site_in_directory'] = intval($site_in_directory);
		$input['site_alias_id'] = intval($site_alias_id);
		
		if (!empty($input))
		{
			if (false !== $this->As_sites_model->update_site_by_id($site_id, $input))
			{
				$this->phpsession->flashsave('msg', $rsSite->site_name . ' was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create()
	{
		$rsSite = $this->db->get('as_sites', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsSite);
		
		if (!empty($input))
		{
			$input['site_user_id'] = $this->user_id;
			if (false !== $this->As_sites_model->add_site($input))
			{
				$this->phpsession->flashsave('msg', $input['site_name'] . ' was created.');
				$site_id = $this->db->insert_id();
				header('Location: /index.php/members/site/edit/' . $site_id . '/');
			}
		}
		
		die();
	}
	
	function remove($site_id)
	{
		$rsSite = $this->As_sites_model->get_site_by_id($site_id);
		if ($this->user_id != $rsSite->site_user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to delete this site.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$confirm = $this->input->get_post('confirm');
		$site_name = $this->input->get_post('site_name');
		
		if ($confirm == 'Yes')
		{
			$this->As_portal_model->delete_post_by_site_id($site_id);
			$this->As_sites_model->delete_site_by_id($site_id);
			$this->As_favorites_model->delete_favorite_by_site_id($site_id);
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was not deleted.');
		}
		
		header('Location: /index.php/members/site/browse/');
		die();
	}
	
	// Private methods
	function _check_session($site_user_id)
	{
		$this->vigilantecorelib->debug_trace($this->rsUser->user_id);
		$this->vigilantecorelib->debug_trace($this->user_id);
		$this->vigilantecorelib->debug_trace($site_user_id);
		die();
	}
}
?>