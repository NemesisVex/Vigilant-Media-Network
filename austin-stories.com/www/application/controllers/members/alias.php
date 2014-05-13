<?php

class Alias extends CI_Controller
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
		$alias_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'aliases');
		$this->aslib->breadcrumbs['aliases'] = '/index.php/members/alias/browse/' . $alias_user_id . '/';;
		
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowAliases = $this->As_aliases_model->get_alias_by_user_id($alias_user_id);
		$total_rows = $rowAliases->num_rows();
		
		$page_config['base_url'] = '/index.php/austinstories/alias/browse/' . $alias_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsAliases = $this->vigilantedblib->_db_return_smarty_array($rowAliases, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsAliases', $rsAliases);
		$this->mysmarty->assign('alias_user_id', $alias_user_id);
		$this->mysmarty->assign('user_id', $alias_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_alias_browse.tpl');
	}
	
	function add($template = 'as_members_alias_edit.tpl', $header = 'add an alias')
	{
		$alias_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'aliases', $header);
		$this->aslib->breadcrumbs['aliases'] = '/index.php/members/alias/browse/' . $alias_user_id . '/';;
		$this->aslib->breadcrumbs[$header] = $_SERVER['REQUEST_URI'];
		
		$this->mysmarty->assign('alias_user_id', $alias_user_id);
		$this->mysmarty->assign('user_id', $alias_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', $template);
	}
	
	function edit($alias_id, $template = 'as_members_alias_edit.tpl', $header = 'edit an alias')
	{
		$rsAlias = $this->As_aliases_model->get_alias_by_id($alias_id);
		
		$this->mysmarty->assign('rsAlias', $rsAlias);
		$this->mysmarty->assign('alias_id', $alias_id);
		$this->add($template, $header);
	}
	
	function delete($alias_id)
	{
		$this->edit($alias_id, 'as_members_alias_delete.tpl', 'delete an alias');
	}
	
	// Processing methods
	
	function update($alias_id)
	{
		$rsAlias = $this->As_aliases_model->get_alias_by_id($alias_id);
		if ($rsAlias->alias_user_id != $this->user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to update this alias.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$input = $this->vigilantedblib->_db_build_update_data($rsAlias);
		
		$input['alias_id'] = $alias_id;
		$input['alias_user_id'] = $alias_user_id;
		
		if (!empty($input))
		{
			if (false !== $this->As_aliases_model->update_alias_by_id($alias_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Alias was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create()
	{
		$rsAlias = $this->db->get('as_users_aliases', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsAlias);
		
		if (!empty($input))
		{
			$input['alias_user_id'] = $this->user_id;
			if (false !== $this->As_aliases_model->add_alias($input))
			{
				$this->phpsession->flashsave('msg', 'Alias was created.');
				$site_id = $this->db->insert_id();
				header('Location: /index.php/members/alias/browse/');
			}
		}
		
		die();
	}
	
	function remove($alias_id)
	{
		$rsAlias = $this->As_aliases_model->get_alias_by_id($alias_id);
		if ($rsAlias->alias_user_id != $this->user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to delete this alias.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$confirm = $this->input->get_post('confirm');
		$alias_name = $this->input->get_post('alias_name');
		
		if ($confirm == 'Yes')
		{
			$this->As_aliases_model->delete_alias_by_id($alias_id);
			$this->As_portal_model->delete_post_by_alias_id($alias_id);
			$this->phpsession->flashsave('msg', '<strong>' . $alias_name . '</strong> was deleted as an alias.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $alias_name . '</strong> was not deleted as an alias.');
		}
		
		header('Location: /index.php/members/alias/browse/');
		die();
	}
	
	// Private methods
}

?>