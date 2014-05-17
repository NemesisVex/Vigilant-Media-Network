<?php

class Member extends CI_Controller
{
	var $ep4_config = array();
	
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
	
	function edit($user_id)
	{
		//$this->mtlib->_format_section_head('Austin Stories', 'Member administration');
		$rsUser = $this->mtlib->_format_austinstories_section_head($user_id);
		
		$rowSites = $this->Mt_as_sites_model->get_sites_by_user_id($user_id);
		$rsSites = $this->vigilantedblib->_db_return_smarty_array($rowSites);
		
		$rowAliases = $this->Mt_as_aliases_model->get_alias_by_user_id($user_id);
		$rsAliases = $this->vigilantedblib->_db_return_smarty_array($rowAliases);
		
		$rowFavorites = $this->Mt_as_favorites_model->get_favorites_by_user_id($user_id);
		$rsFavorites = $this->vigilantedblib->_db_return_smarty_array($rowFavorites);
		
		$rowPosts = $this->Mt_as_portal_model->get_posts_by_user_id($user_id, 10);
		$rsPosts = $this->vigilantedblib->_db_return_smarty_array($rowPosts);
		
		$this->mysmarty->assign('rsAliases', $rsAliases);
		$this->mysmarty->assign('rsFavorites', $rsFavorites);
		$this->mysmarty->assign('rsPosts', $rsPosts);
		$this->mysmarty->assign('rsSites', $rsSites);
		$this->mysmarty->assign('rsUser', $rsUser);
		$this->mysmarty->assign('user_id', $user_id);
		$this->mtlib->_smarty_display_mt_page('mt_austinstories_member_edit.tpl');
	}
	
	// Processing methods
}

?>