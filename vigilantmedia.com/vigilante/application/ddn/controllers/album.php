<?php

class Album extends CI_Controller
{
	var $artist_db_obj;
	var $artist_id = 45;
	var $artist_format_nav;
	var $artist_name;
	var $locale = 'us';
	var $page_title = 'Social Network Discography';
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('DdnLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyDiscogs');
		$this->load->library('MyEcommerce');
		$this->load->library('MyLastFm');
		$this->load->library('MyMusicbrainz');
		$this->load->library('unit_test');
		$this->load->model('Mw_artist_model');
		$this->load->model('Mw_album_model');
		$this->load->model('Mw_release_model');
		
		//$this->ddnlib->_format_side_navigation();
		$this->ddnlib->ddn_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
		$this->ddnlib->ddn_config['amazon_locale'] = $this->myamazon->amazon_locale;
		$this->mysmarty->assign('content_side_template', 'ddn_album_side.tpl');

		// Get side bar info

		$rowProjects = $this->Mw_artist_model->get_artists_by_settings_mask(16);
		$rsProjects = $this->vigilantedblib->_db_return_smarty_array($rowProjects);
		$this->mysmarty->assign('rsProjects', $rsProjects);
	}
	
	// View methods
	
	function index()
	{
		$this->browse($this->artist_id);
	}
	
	function browse($album_artist_id, $format_mask = '')
	{
		$this->_setup_page_template($album_artist_id);
		if (empty($format_mask)) {$format_mask = $this->artist_format_nav[0]->album_format_mask;}

		$rowAlbums = $this->Mw_album_model->get_albums_by_artist_id($album_artist_id, $format_mask);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);

		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('format_mask', $format_mask);
		$this->ddnlib->_smarty_display_ddn_page('ddn_album.tpl');
	}
	
	function info($album_artist_id, $album_id)
	{
		$this->_setup_page_template($album_artist_id);

		/*
		 * Get album information from database.
		 */
		$rsAlbum = $this->Mw_album_model->get_album_by_id($album_id);
		$album_title = $rsAlbum->album_title;
		if (!empty($rsAlbum->album_alt_title)) {$album_title .= ' (' . $rsAlbum->album_alt_title . ')';}
		$this->mysmarty->assign('rsAlbum', $rsAlbum);
		$this->ddnlib->page_title .= ': ' . $album_title;
		
		$discogs_artist_name = (strtolower($this->artist_db_obj->artist_first_name) == 'the') ? $this->artist_db_obj->artist_last_name . ', ' . $this->artist_db_obj->artist_first_name : $this->artist_name;

		/*
		 * Get Discogs.com info.
		 */
		$this->_lookup_discogs($album_id, $discogs_artist_name);

		/*
		 * Get Musicbrainz info.
		 */
		$this->_lookup_musicbrainz($album_id);

		/*
		 * Get Last.fm info
		 */
		$lastfm_album = $this->_lookup_lastfm($album_title, $this->artist_name);
		$lastfm_image_xpath = "/lfm/album/image[@size='large']";
		$album_image = $lastfm_album->xpath($lastfm_image_xpath);
		$this->mysmarty->assign('album_image', $album_image);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		
		$this->ddnlib->_smarty_display_ddn_page('ddn_album_info.tpl');
	}

	function discogs($album_artist_id, $discogs_discog_id)
	{
		$this->_setup_page_template($album_artist_id);

		$this->mydiscogs->query_release($discogs_discog_id);
		$results = $this->mydiscogs->results->release;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML URI</a>');
		//print_r($results);
		$this->ddnlib->page_title .= ': ' . $results->title;

		$this->mysmarty->assign('discogs_discog_id', $discogs_discog_id);
		$this->mysmarty->assign('results', $results);
		$this->ddnlib->_smarty_display_ddn_page('ddn_album_discogs.tpl');
	}

	function musicbrainz($album_artist_id, $mb_gid)
	{
		$this->_setup_page_template($album_artist_id);

		$this->mymusicbrainz->get_release_by_id($mb_gid, 'artist counts release-events discs tracks release-groups artist-rels label-rels release-rels track-rels url-rels track-level-rels labels', 100);
		$results = $this->mymusicbrainz->results->release;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML URI</a>');
		//print_r($results);
		$this->ddnlib->page_title .= ': ' . $results->title;

		if ($results->asin)
		{
			$amazon = $this->_lookup_amazon(sprintf("%s", $results->asin));
			//print_r($amazon);
			$this->mysmarty->assign('amazon', $amazon);
		}
		
		$lastfm_album = $this->_lookup_lastfm('', '', $mb_gid);
		$lastfm_image_xpath = "/lfm/album/image[@size='large']";
		$album_image = $lastfm_album->xpath($lastfm_image_xpath);
		$this->mysmarty->assign('album_image', $album_image);
		//print_r($lastfm_album);

		$this->mysmarty->assign('mb_gid', $mb_gid);
		$this->mysmarty->assign('results', $results);
		$this->mysmarty->assign('lastfm_album', $lastfm_album);
		$this->ddnlib->_smarty_display_ddn_page('ddn_album_musicbrainz.tpl');
	}

	// Private methods
	
	function _lookup_amazon($asin = '', $locale = 'us', $response_group = 'Medium')
	{
		$params['ResponseGroup'] = $response_group;

		$this->myamazon->__construct($locale);
		$this->myamazon->item_lookup($asin, $params);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->myamazon->request_uri . '">XML URL</a>');
		$items = $this->myamazon->results->Items;

		$this->mysmarty->assign('request_uri', $this->myamazon->request_uri);
		$this->mysmarty->assign('locale', $locale);
		return $items;
	}

	function _lookup_discogs($album_id, $artist_name)
	{
		/*
		 * Get artist info from Discogs.com.
		 */
		$this->mydiscogs->query_artist($artist_name);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML URI</a>');
		$discogs_results = $this->mydiscogs->results;

		/*
		 * Get Discogs.com associations from database.
		 */
		$rowDiscogs = $this->Mw_album_model->get_discogs_by_album_id($album_id);
		$rsDiscogs = $this->vigilantedblib->_db_return_smarty_array($rowDiscogs);

		/*
		 * Map Discogs.com API results with database associations.
		 */
		if (!empty($rsDiscogs))
		{
			foreach ($rsDiscogs as $key => $rs)
			{
				$discog_id = $rs->discogs_discog_id;
				$discog_xpath = "/resp/artist/releases/release[@id=$discog_id]";
				$xpath_results = $discogs_results->xpath($discog_xpath);
				$rsDiscogs[$key]->xpath_results = $xpath_results;
			}

			/*
			 * Send results to the view.
			 */
			$this->mysmarty->assign('rsDiscogs', $rsDiscogs);
		}

		return $rsDiscogs;
	}

	function _lookup_musicbrainz($album_id)
	{
		/*
		 * Get Musicbrainz associations from the database.
		 */
		$rowMusicbrainz = $this->Mw_album_model->get_musicbrainz_by_album_id($album_id);
		$rsMusicbrainz = $this->vigilantedblib->_db_return_smarty_array($rowMusicbrainz);

		/*
		 * Get Musicbrainz info.
		 */
		if (!empty($rsMusicbrainz[0]->mb_group_mb_gid))
		{
			$mb_group_mb_gid = $rsMusicbrainz[0]->mb_group_mb_gid;
			$this->mymusicbrainz->get_release_group_by_id($mb_group_mb_gid, 'artist releases', 100);
			$mb_release_list = $this->mymusicbrainz->results->{'release-group'}->{'release-list'};
			$this->mysmarty->assign('mb_release_list', $mb_release_list);
			//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML URI</a>');
		}

		return $rsMusicbrainz;
	}

	function _lookup_lastfm($album_title = '', $artist_name = '', $mb_gid = '')
	{
		$this->mylastfm->album_get_info($album_title, $artist_name, $mb_gid);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mylastfm->request_uri . '">XML URI</a>');
		$lastfm_album = $this->mylastfm->results->album;
		$this->mysmarty->assign('lastfm_album', $lastfm_album);

		return $lastfm_album;
	}

	function _setup_page_template($album_artist_id)
	{
		$rsArtist = $this->Mw_artist_model->get_artist_by_id($album_artist_id);
		$this->artist_db_obj = $rsArtist;

		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		$this->artist_name = $artist_name;

		$this->ddnlib->_format_section_head($this->page_title, $artist_name);

		$rowFormats = $this->Mw_release_model->get_artist_releases_by_format_mask($album_artist_id);
		$rsFormats = $this->vigilantedblib->_db_return_smarty_array($rowFormats);
		$this->artist_format_nav = $rsFormats;

		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('rsFormats', $rsFormats);
	}
}
?>