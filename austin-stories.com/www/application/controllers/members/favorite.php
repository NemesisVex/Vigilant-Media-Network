<?php

class Favorite extends CI_Controller
{
	var $per_page = 50;
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
		$favorite_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'favorites', 'delete a favorite site');
		$this->aslib->breadcrumbs['favorites'] = '/index.php/members/favorite/browse/' . $favorite_user_id . '/';
		$this->aslib->breadcrumbs['delete a favorite'] = $_SERVER['REQUEST_URI'];
		$offset = $this->uri->segment(5);
		
		$rowFavorites = $this->As_favorites_model->get_favorites_by_user_id($favorite_user_id);
		$total_rows = $rowFavorites->num_rows();
		
		$page_config['base_url'] = '/index.php/members/favorite/browse/' . $favorite_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsFavorites = $this->vigilantedblib->_db_return_smarty_array($rowFavorites, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsFavorites', $rsFavorites);
		$this->mysmarty->assign('favorite_user_id', $favorite_user_id);
		$this->mysmarty->assign('user_id', $favorite_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_favorite_browse.tpl');
	}
	
	function sites()
	{
		$favorite_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'favorites', 'add a favorite site');
		$this->aslib->breadcrumbs['favorites'] = '/index.php/members/favorite/browse/' . $favorite_user_id . '/';
		$this->aslib->breadcrumbs['add a favorite'] = $_SERVER['REQUEST_URI'];
		$offset = $this->uri->segment(5);
		
		$rowSites = $this->As_favorites_model->get_all_visible_sites();
		$total_rows = $rowSites->num_rows();
		
		$page_config['base_url'] = '/index.php/members/favorite/sites/' . $favorite_user_id . '/';
		$page_config['total_rows'] = $total_rows;
		$page_config['per_page'] = $this->per_page;
		$page_config['uri_segment'] = 5;
		$page_config['num_links'] = 5;
		$this->pagination->initialize($page_config);
		
		$page_links = $this->pagination->create_links();
		
		$rsSites = $this->vigilantedblib->_db_return_smarty_array($rowSites, $this->per_page, $offset);
		
		$this->mysmarty->assign('page_links', $page_links);
		$this->mysmarty->assign('rsSites', $rsSites);
		$this->mysmarty->assign('favorite_user_id', $favorite_user_id);
		$this->mysmarty->assign('user_id', $favorite_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', 'as_members_favorite_sites.tpl');
	}
	
	function add($template = 'as_members_favorite_edit.tpl', $header = 'add a favorite')
	{
		$favorite_user_id = $this->user_id;
		
		$this->aslib->_format_section_head('my austin stories', 'favorites', $header);
		
		$rsUser = $this->Mt_user_model->get_user_by_id($favorite_user_id);
		$this->mysmarty->assign('rsUser', $rsUser);
		
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('favorite_user_id', $favorite_user_id);
		$this->mysmarty->assign('user_id', $favorite_user_id);
		$this->aslib->_smarty_display_as_protected_page('members_content', $template);
	}
	
	function edit($favorite_id, $template = 'as_members_favorite_edit.tpl', $header = 'edit a favorite')
	{
		$rsFavorite = $this->As_favorites_model->get_favorite_by_id($favorite_id);
		
		$this->mysmarty->assign('rsFavorite', $rsFavorite);
		$this->mysmarty->assign('favorite_id', $favorite_id);
		$this->add($template, $header);
	}
	
	function delete($favorite_id)
	{
		$this->edit($favorite_id, 'as_members_favorite_delete.tpl', 'delete a favorite');
	}
	
	// Processing methods
	
	function create()
	{
		$favorite_user_id = $this->user_id;
		$favorite_site_ids = $this->input->get_post('favorite_site_ids');
		
		if (!empty($favorite_site_ids))
		{
			foreach ($favorite_site_ids as $favorite_site_id)
			{
				$input['favorite_site_id'] = $favorite_site_id;
				$input['favorite_user_id'] = $favorite_user_id;
				$this->_create_favorite($input);
			}
			$this->phpsession->flashsave('msg', 'Your favorite sites were created.');
		}
		else
		{
			$this->phpsession->flashsave('error', 'Please make sure you selected at least one favorite site.');
		}
		
		header('Location: /index.php/members/favorite/browse/');
		die();
	}
	
	function remove($favorite_id)
	{
		$rsFavorite = $this->As_favorites_model->get_favorite_by_id($favorite_id);
		if ($rsFavorite->favorite_user_id != $this->user_id)
		{
			$this->phpsession->flashsave('error', 'You do not have permission to delete this alias.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			die();
		}
		
		$confirm = $this->input->get_post('confirm');
		$site_name = $this->input->get_post('site_name');
		
		if ($confirm == 'Yes')
		{
			$this->As_favorites_model->delete_favorite_by_id($favorite_id);
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was deleted from favorites.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<strong>' . $site_name . '</strong> was not deleted from favorites.');
		}
		
		header('Location: /index.php/members/favorite/browse/');
		die();
	}
	
	// Private methods
	function _create_favorite($input)
	{
		if (false !== $this->As_favorites_model->add_favorite($input))
		{
			$site_id = $this->db->insert_id();
			return $site_id;
		}
		return false;
	}
}

?>