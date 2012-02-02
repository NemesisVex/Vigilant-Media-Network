<?php

class Site extends CI_Controller
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
		$rsUser = $this->mtlib->_format_austinstories_section_head($site_user_id, 'Browse sites');
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowSites = $this->Mt_as_sites_model->get_sites_by_user_id($site_user_id);
		$total_rows = $rowSites->num_rows();
		
		$page_config['base_url'] = '/index.php/austinstories/site/browse/' . $site_user_id . '/';
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
		//$this->mtlib->_smarty_display_mt_page('mt_austinstories_member_site_browse.tpl');
	}
	
	function add($site_user_id, $template = 'mt_austinstories_member_site_edit.tpl', $header = 'Add a site')
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($site_user_id, $header);
		
		$rowAliases = $this->Mt_as_aliases_model->get_alias_by_user_id($site_user_id);
		$rsAliases = $this->vigilantedblib->_db_return_smarty_array($rowAliases);
		
		$this->mysmarty->assign('rsAliases', $rsAliases);
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('site_user_id', $site_user_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($site_id, $site_user_id = '', $template = 'mt_austinstories_member_site_edit.tpl', $header = 'Edit a site')
	{
		$rsSite = $this->Mt_as_sites_model->get_site_by_id($site_id);
		if (empty($site_user_id)) {$site_user_id = $rsSite->site_user_id;}
		
		$this->mysmarty->assign('rsSite', $rsSite);
		$this->mysmarty->assign('site_id', $site_id);
		$this->add($site_user_id, $template, $header);
	}
	
	function delete($site_id, $site_user_id = '')
	{
		$this->edit($site_id, $site_user_id, 'mt_austinstories_member_site_delete.tpl', 'Delete a site');
	}
	
	// Processing methods
	
	function update($site_id, $site_user_id)
	{
		$rsSite = $this->Mt_as_sites_model->get_site_by_id($site_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsSite);
		
		$site_in_directory = $this->input->get_post('site_in_directory');
		
		$input['site_id'] = $site_id;
		$input['site_user_id'] = $site_user_id;
		$input['site_in_directory'] = intval($site_in_directory);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_sites_model->update_site_by_id($site_id, $input))
			{
				$this->phpsession->flashsave('msg', $rsSite->site_name . ' was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create($site_user_id)
	{
		$rsSite = $this->db->get('as_sites', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsSite);
		
		if (!empty($input))
		{
			$input['site_user_id'] = $site_user_id;
			if (false !== $this->Mt_as_sites_model->add_site($input))
			{
				$this->phpsession->flashsave('msg', $input['site_name'] . ' was created.');
				$site_id = $this->db->insert_id();
				header('Location: /index.php/austinstories/site/edit/' . $site_id . '/' . $site_user_id . '/');
			}
		}
		
		die();
	}
	
	function remove($site_id, $site_user_id)
	{
		$confirm = $this->input->get_post('confirm');
		$site_name = $this->input->get_post('site_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_as_portal_model->delete_post_by_site_id($site_id);
			$this->Mt_as_sites_model->delete_site_by_id($site_id);
			$this->Mt_as_favorites_model->delete_favorite_by_site_id($site_id);
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was not deleted.');
		}
		
		header('Location: /index.php/austinstories/member/edit/' . $site_user_id . '/');
		die();
	}
	
	// Private methods
}
?>