<?php

class Favorite extends CI_Controller
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
	function browse($favorite_user_id)
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($favorite_user_id, 'Browse sites');
		$per_page = 50;
		$offset = $this->uri->segment(5);
		
		$rowFavorites = $this->Mt_as_favorites_model->get_favorites_by_favorite_user_id($favorite_user_id);
		$total_rows = $rowFavorites->num_rows();
		
		$page_config['base_url'] = '/index.php/austinstories/favorite/browse/' . $favorite_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsFavorites = $this->vigilantedblib->_db_return_smarty_array($rowFavorites, $per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsFavorites', $rsFavorites);
		$this->mysmarty->assign('favorite_user_id', $favorite_user_id);
		$this->mtlib->_smarty_display_mt_page('mt_austinstories_member_favorite_browse.tpl');
	}
	*/
	
	function add($favorite_user_id, $template = 'mt_austinstories_member_favorite_edit.tpl', $header = 'Add a favorite')
	{
		$rsUser = $this->mtlib->_format_austinstories_section_head($favorite_user_id, $header);
		
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('favorite_user_id', $favorite_user_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($favorite_id, $favorite_user_id = '', $template = 'mt_austinstories_member_favorite_edit.tpl', $header = 'Edit a favorite')
	{
		$rsFavorite = $this->Mt_as_favorites_model->get_favorite_by_id($favorite_id);
		if (empty($favorite_user_id)) {$favorite_user_id = $rsFavorite->favorite_favorite_user_id;}
		
		$this->mysmarty->assign('rsFavorite', $rsFavorite);
		$this->mysmarty->assign('favorite_id', $favorite_id);
		$this->add($favorite_user_id, $template, $header);
	}
	
	function delete($favorite_id, $favorite_user_id = '')
	{
		$this->edit($favorite_id, $favorite_user_id, 'mt_austinstories_member_favorite_delete.tpl', 'Delete a favorite');
	}
	
	// Processing methods
	
	/*
	function update($favorite_id, $favorite_user_id)
	{
		$rsFavorite = $this->Mt_as_favorites_model->get_favorite_by_id($favorite_id, true);
		$input = $this->vigilantedblib->_db_build_update_data($rsFavorite);
		
		$input['favorite_id'] = $favorite_id;
		$input['favorite_user_id'] = $favorite_user_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_as_favorites_model->update_favorite_by_id($favorite_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Favorite site was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create($favorite_user_id)
	{
		$rsFavorite = $this->db->get('as_users_favorites', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsFavorite);
		
		if (!empty($input))
		{
			$input['favorite_user_id'] = $favorite_user_id;
			if (false !== $this->Mt_as_favorites_model->add_favorite($input))
			{
				$this->phpsession->flashsave('msg', 'Favorite site was created.');
				$site_id = $this->db->insert_id();
				header('Location: /index.php/austinstories/member/edit/' . $favorite_user_id . '/');
			}
		}
		
		die();
	}
	*/
	
	function remove($favorite_id, $favorite_user_id)
	{
		$confirm = $this->input->get_post('confirm');
		$site_name = $this->input->get_post('site_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_as_favorites_model->delete_favorite_by_id($favorite_id);
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was deleted from favorites.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was not deleted from favorites.');
		}
		
		header('Location: /index.php/austinstories/member/edit/' . $favorite_user_id . '/');
		die();
	}
	
	// Private methods
}

?>