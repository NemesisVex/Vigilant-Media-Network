<?php

class Content extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_mt_model');
		
		$this->archivelib->_format_side_navigation();
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/artists/artist/browse/a/');
	}
	
	function browse($content_artist_id)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($content_artist_id, 'Entries');
		
		$rowEntries = $this->Mw_content_model->get_content_by_artist_id($content_artist_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		$this->mysmarty->assign('content_artist_id', $content_artist_id);
		$this->mysmarty->assign('artist_id', $content_artist_id);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_entries.tpl');
	}
	
	function album($content_album_id)
	{
		if (false !== ($rsContent = $this->Mw_content_model->get_content_by_album_id($content_album_id)))
		{
			header('Location: /index.php/content/entry/' . $rsContent->content_entry_id . '/', true, 301);
			die();
		}
		else
		{
			header('HTTP/1.1 410 Gone', true, 410);
			header('Status: 410 Gone');
			die();
		}
	}
}

?>