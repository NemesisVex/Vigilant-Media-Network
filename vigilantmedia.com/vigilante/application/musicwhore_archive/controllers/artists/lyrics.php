<?php

class Lyrics extends CI_Controller
{
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ArchiveLib');
		$this->load->library('MyAmazon');
		$this->load->model('Mw_artist_model');
		//$this->load->model('Mw_album_model');
		$this->load->model('Mw_release_model');
		$this->load->model('Mw_tracks_model');
		$this->load->model('Mw_ecommerce_model');
		$this->load->model('Mw_content_model');
		$this->load->model('Mw_lyrics_model');
		$this->load->model('Mw_mt_model');
		
		$this->archivelib->_format_side_navigation();
		$this->archivelib->mw_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
		$this->archivelib->mw_config['amazon_locale'] = $this->myamazon->amazon_locale;
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function browse($lyric_artist_id)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($lyric_artist_id, 'Lyrics');
		
		$rowTracks = $this->Mw_lyrics_model->get_lyrics_by_artist_id($lyric_artist_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('artist_id', $lyric_artist_id);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_lyrics_browse.tpl');
	}
	
	function lyric($lyric_id, $lyric_artist_id = '')
	{
		$rsLyric = $this->Mw_lyrics_model->get_lyric_by_id($lyric_id);
		
		if (empty($lyric_artist_id))
		{
			$lyric_artist_id = $rsLyric->lyric_artist_id;
		}
		
		$this->_build_lyric_view($rsLyric, $lyric_artist_id);
	}
	
	function track($map_track_id, $lyric_artist_id = '')
	{
		$rowLyric = $this->Mw_lyrics_model->get_lyric_mapped_to_track($map_track_id);
		$rsLyric = $this->vigilantedblib->_db_return_rs($rowLyric);
		
		header('Location: /index.php/artists/lyrics/lyric/' . $rsLyric->lyric_id . '/', true, 301);
	}
	
	function _build_lyric_view($rsLyric, $lyric_artist_id)
	{
		$rsArtist = $this->archivelib->_format_mw_section_head($lyric_artist_id, 'Lyrics');
		$lyric_path = $_SERVER['DOCUMENT_ROOT'] . '/lyrics/' . $rsArtist->artist_file_system . '/' . $rsLyric->lyric_file_name;
		if (false !== ($fp = fopen($lyric_path, 'r')))
		{
			$lyric_xml = fread($fp, filesize($lyric_path));
			fclose($fp);
		}
		
		if (!empty($lyric_xml))
		{
			$lyrics = simplexml_load_string($lyric_xml);
			$this->mysmarty->assign('lyrics', $lyrics);
			//$this->vigilantecorelib->debug_trace($lyrics->romajii->translator->translatorname);
			
			$romaji = '';
			if (!empty($lyrics->romajii->lyric))
			{
				foreach ($lyrics->romajii->lyric->children() as $section => $lyric)
				{
					$romaji .= $this->vigilantecorelib->parse_line_breaks($lyric);
				}
			}
			
			$eigo = '';
			if (!empty($lyrics->eigo->lyric))
			{
				foreach ($lyrics->eigo->lyric->children() as $section => $lyric)
				{
					$eigo .= $this->vigilantecorelib->parse_line_breaks($lyric);
				}
			}
			
			$kanji = '';
			if (!empty($lyrics->kanji->lyric))
			{
				foreach ($lyrics->kanji->lyric->children() as $section => $lyric)
				{
					$kanji .= $this->vigilantecorelib->parse_line_breaks($lyric);
				}
			}
			
			$this->mysmarty->assign('romaji', $romaji);
			$this->mysmarty->assign('eigo', $eigo);
			$this->mysmarty->assign('kanji', $kanji);
		}
		
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsLyric', $rsLyric);
		$this->mysmarty->assign('artist_id', $lyric_artist_id);
		$this->archivelib->_smarty_display_mw_page('amwb_artists_artist_lyrics.tpl');
	}
}

?>