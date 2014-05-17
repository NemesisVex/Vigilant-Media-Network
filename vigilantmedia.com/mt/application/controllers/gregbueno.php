<?php

class Gregbueno extends CI_Controller
{
	var $ep4_config = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_ep4_artist_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		$this->mtlib->section_head = 'Gregbueno.com';
		$this->mtlib->section_label = 'Main administration';
		$this->mtlib->page_title .= ' &#151; Gregbueno.com &#151; Main administration';
		
		$rowArtists = $this->Mt_ep4_artist_model->get_all_artists();
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mtlib->_smarty_display_mt_page('mt_gregbueno.tpl');
	}
	
	// Processing methods
}

?>