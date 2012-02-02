<?php

class Artist extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyEcommerce');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_personell_model');
		$this->load->model('Mw_related_model');
		//$this->load->model('Mw_album_model');
		$this->load->model('Mw_release_model');
		$this->load->model('Mw_tracks_model');
		$this->load->model('Mw_ecommerce_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_lyrics_model');
		$this->load->model('Mw_mt_model');
		
		$this->archivelib->_format_side_navigation();
		$this->archivelib->mw_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/artists/artist/browse/a/');
	}
	
	function browse($filter = 'a')
	{
		$this->archivelib->section_head = 'Artists';
		$this->archivelib->page_title = 'Artists: ' . strtoupper($filter);
		
		$rowArtists = $this->Mw_artist_model->get_all_artists($filter);
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mysmarty->assign('filter', $filter);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_browse.tpl');
	}
	
	function info($artist_id)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($artist_id);
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		
		$rowMembers = $this->Mw_personell_model->get_members_by_artist_id($artist_id);
		$rsMembers = $this->vigilantedblib->_db_return_smarty_array($rowMembers);
		
		$rowEntries = $this->Mw_content_model->get_content_by_artist_id($artist_id);
		$entry_count = $rowEntries->num_rows();
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		if ($entry_count > 5) {$rsEntries = array_slice($rsEntries, 0, 5);}
		
		$rowRelations = $this->Mw_related_model->get_related_by_artist_id($artist_id, 'related');
		$rsRelations = $this->vigilantedblib->_db_return_smarty_array($rowRelations);
		
		$rowSimilars = $this->Mw_related_model->get_related_by_artist_id($artist_id, 'similar');
		$rsSimilars = $this->vigilantedblib->_db_return_smarty_array($rowSimilars);
		//$this->vigilantecorelib->debug_trace($this->db->last_query());
		
		$artist_image_path = $this->archivelib->mw_config['img_artist_root'] . '/' . $rsArtist->artist_file_system . '.jpg';
		if (file_exists($artist_image_path))
		{
			$artist_image = $rsArtist->artist_file_system . '.jpg';
			$this->mysmarty->assign('artist_image', $artist_image);
		}
		
		if ($rsArtist->artist_itunes_id)
		{
			$itunes_url = $this->myecommerce->build_itunes_artist_url($rsArtist->artist_itunes_id);
			$this->mysmarty->assign('itunes_url', $itunes_url);
		}
		
		if ($rsArtist->artist_yesasia_id)
		{
			$yesasia_url = $this->myecommerce->build_yesasia_artist_url($rsArtist->artist_yesasia_id);
			$this->mysmarty->assign('yesasia_url', $yesasia_url);
		}
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsMembers', $rsMembers);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('rsRelations', $rsRelations);
		$this->mysmarty->assign('rsSimilars', $rsSimilars);
		$this->mysmarty->assign('entry_count', $entry_count);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_info.tpl');
	}
	
	function profile($artist_id)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($artist_id);
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		
		$rowMembers = $this->Mw_personell_model->get_members_by_artist_id($artist_id);
		$rsMembers = $this->vigilantedblib->_db_return_smarty_array($rowMembers);
		
		$artist_image_path = $this->archivelib->mw_config['img_artist_root'] . '/' . $rsArtist->artist_file_system . '.jpg';
		if (file_exists($artist_image_path))
		{
			$artist_image = $rsArtist->artist_file_system . '.jpg';
			$this->mysmarty->assign('artist_image', $artist_image);
		}
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsMembers', $rsMembers);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_profile.tpl');
	}
}
?>