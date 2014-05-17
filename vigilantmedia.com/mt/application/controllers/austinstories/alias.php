<?php

class Alias extends CI_Controller
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
	
	/*
	function browse($alias_user_id)
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($alias_user_id, 'Browse aliases');
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowAliases = $this->Mt_as_aliases_model->get_alias_by_user_id($alias_user_id);
		$total_rows = $rowFavorites->num_rows();
		
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
		$this->mtlib->_smarty_display_mt_page('mt_austinstories_member_alias_browse.tpl');
	}
	*/
	
	function add($alias_user_id, $template = 'mt_austinstories_member_alias_edit.tpl', $header = 'Add an alias')
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($alias_user_id, $header);
		
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('alias_user_id', $alias_user_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($alias_id, $alias_user_id = '', $template = 'mt_austinstories_member_alias_edit.tpl', $header = 'Edit an alias')
	{
		$rsAlias = $this->Mt_as_aliases_model->get_alias_by_id($alias_id);
		if (empty($alias_user_id)) {$alias_user_id = $rsFavorite->favorite_alias_user_id;}
		
		$this->mysmarty->assign('rsAlias', $rsAlias);
		$this->mysmarty->assign('alias_id', $alias_id);
		$this->add($alias_user_id, $template, $header);
	}
	
	function delete($alias_id, $alias_user_id = '')
	{
		$this->edit($alias_id, $alias_user_id, 'mt_austinstories_member_alias_delete.tpl', 'Delete an alias');
	}
	
	// Processing methods
	
	function update($alias_id, $alias_user_id)
	{
		$rsAlias = $this->Mt_as_aliases_model->get_alias_by_id($alias_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsAlias);
		
		$input['alias_id'] = $alias_id;
		$input['alias_user_id'] = $alias_user_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_aliases_model->update_alias_by_id($alias_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Alias was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	/*
	function create($alias_user_id)
	{
		$rsAlias = $this->db->get('as_users_aliases', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsAlias);
		
		if (!empty($input))
		{
			$input['alias_user_id'] = $alias_user_id;
			if (false !== $this->Mt_as_aliases_model->add_alias($input))
			{
				$this->phpsession->flashsave('msg', 'Alias was created.');
				$site_id = $this->db->insert_id();
				header('Location: /index.php/austinstories/member/edit/' . $alias_user_id . '/');
			}
		}
		
		die();
	}
	*/
	
	function remove($alias_id, $alias_user_id)
	{
		$confirm = $this->input->get_post('confirm');
		$alias_name = $this->input->get_post('alias_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_as_aliases_model->delete_alias_by_id($alias_id);
			$this->Mt_as_portal_model->delete_post_by_alias_id($alias_id);
			$this->phpsession->flashsave('msg', '<strong>' . $alias_name . '</strong> was deleted as an alias.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $alias_name . '</strong> was not deleted as an alias.');
		}
		
		header('Location: /index.php/austinstories/member/edit/' . $alias_user_id . '/');
		die();
	}
	
	// Private methods
}

?>