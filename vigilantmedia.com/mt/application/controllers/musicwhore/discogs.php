<?php

class Discogs extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->library('MtLib');
		$this->load->library('MyDiscogs');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
		$this->mysmarty->assign('api_key', $this->mydiscogs->api_key);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function albums($artist_id)
	{
		$filter_title = $this->input->get_post('filter_title');

		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Discogs discography');

		if (strtolower($rsArtist->artist_first_name) == 'the')
		{
			$artist_name = $rsArtist->artist_last_name . ', ' . $rsArtist->artist_first_name;
		}
		else
		{
			$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		}

		$this->mydiscogs->query_artist($artist_name);
		$results = $this->mydiscogs->results;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML url</a>');
		$release_list = $this->mydiscogs->results->artist->releases->release;
		//print_r($results);

		if (!empty($filter_title))
		{
			$filter_xpath = "/resp/artist/releases/release[title='$filter_title']";
			$release_list = $results->xpath($filter_xpath);
			$this->mysmarty->assign('filter_title', $filter_title);
		}

		$this->mysmarty->assign('results', $results);
		$this->mysmarty->assign('release_list', $release_list);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_album_browse.tpl');
	}

	function album($discogs_discog_id, $album_artist_id, $album_title = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Browse Discogs discography');

		$rowDiscogs = $this->Mt_mw_album_model->get_albums_by_discogs_id($discogs_discog_id);
		$rsDiscogs = $this->vigilantedblib->_db_return_smarty_array($rowDiscogs);

		$this->mydiscogs->query_release($discogs_discog_id);
		$results = $this->mydiscogs->results;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML url</a>');
		$release_info = $results->release;

		$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);

		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('rsDiscogs', $rsDiscogs);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('release_info', $release_info);
		$this->mysmarty->assign('album_title', urldecode($album_title));
		$this->mysmarty->assign('discogs_discog_id', $discogs_discog_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_album_edit.tpl');
	}
	
	function release($discogs_discog_id, $album_artist_id, $album_title = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Browse Discogs discography');
		
		$rsDiscogs = $this->Mt_mw_release_model->get_release_by_discogs_id($discogs_discog_id);

		$this->mydiscogs->query_release($discogs_discog_id);
		$results = $this->mydiscogs->results;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML url</a>');
		$release_info = $results->release;
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('rsDiscogs', $rsDiscogs);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('release_info', $release_info);
		$this->mysmarty->assign('album_title', urldecode($album_title));
		$this->mysmarty->assign('discogs_discog_id', $discogs_discog_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_release_edit.tpl');
	}
	
	function tracks()
	{
	}
	
	function browse($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Musicbrainz associations');

		$rowDiscogs = $this->Mt_mw_release_model->get_discogs_by_artist_id($artist_id);
		$rsDiscogs = $this->vigilantedblib->_db_return_smarty_array($rowDiscogs);

		$this->mysmarty->assign('rsDiscogs', $rsDiscogs);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_browse.tpl');
	}

	function edit($discog_id)
	{
		$rowDiscogs = $this->Mt_mw_release_model->get_release_by_discog_id($discog_id);
		$rsDiscogs = $this->vigilantedblib->_db_return_rs($rowDiscogs);
		//print_r($rsDiscogs);

		$discogs_discog_id = $rsDiscogs->discogs_discog_id;

		$this->mydiscogs->query_release($discogs_discog_id);
		$results = $this->mydiscogs->results;
		$release_info = $results->release;
		//print_r($release_info);
		$this->mysmarty->assign('release_info', $release_info);
		
		if (!empty($rsDiscogs->album_artist_id))
		{
			$album_artist_id = $rsDiscogs->album_artist_id;
			$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Edit Musicbrainz association');

			$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
			$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);

			if (!empty($rsDiscogs->discogs_album_id))
			{
				$release_album_id = $rsDiscogs->discogs_album_id;
				$release_id = $rsDiscogs->discogs_release_id;
				
				$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($release_album_id);
				$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);

				$this->mysmarty->assign('release_id', $release_id);
				$this->mysmarty->assign('rsReleases', $rsReleases);
			}

			$this->mysmarty->assign('rsDiscogs', $rsDiscogs);
		}

		$this->mysmarty->assign('discogs_id', $discog_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_edit.tpl');
	}

	// AJAX methods

	function album_releases($album_artist_id, $release_id = '')
	{
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);

		$this->mysmarty->assign('release_id', $release_id);
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$release_list = $this->mysmarty->fetch('mt_musicwhore_musicbrainz_album_releases.tpl');
		echo $release_list;
		die();
	}

	function titles($artist_id)
	{
		$q = strtolower($this->input->get_post('q'));

		$rsArtist = $this->Mt_mw_artist_model->get_artist_by_id($artist_id);

		if (strtolower($rsArtist->artist_first_name) == 'the')
		{
			$artist_name = $rsArtist->artist_last_name . ', ' . $rsArtist->artist_first_name;
		}
		else
		{
			$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		}

		$this->mydiscogs->query_artist($artist_name);
		$results = $this->mydiscogs->results;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mydiscogs->request_uri . '">XML url</a>');
		$release_list = $this->mydiscogs->results->artist->releases->release;

		foreach ($release_list as $release)
		{
			$title = strtolower($release->title);
			if (strpos($title, $q) !== false) {
				echo "$release->title|$release.id\n";
			}
		}
	}

	// Processing methods
	function map($discogs_discog_id, $artist_id)
	{
		$function = $this->input->get_post('function');
		$discogs_album_id = $this->input->get_post('discogs_album_id');
		$discogs_release_id = $this->input->get_post('discogs_release_id');

		if (empty($discogs_album_id))
		{
			$rsRelease = $this->Mt_mw_release_model->get_release_by_id($discogs_release_id, true);
			$discogs_album_id = $rsRelease->release_album_id;
		}
		
		$input['discogs_album_id'] = $discogs_album_id;
		$input['discogs_release_id'] = $discogs_release_id;
		$input['discogs_discog_id'] = $discogs_discog_id;
		
		// If an association with a release already exists, update, don't create
		$rsCheck = null;
		if ($discogs_release_id > 0)
		{
			if (false !== ($rowCheck = $this->Mt_mw_release_model->get_discogs_by_release_id($discogs_release_id)))
			{
				$rsCheck = $this->vigilantedblib->_db_return_rs($rowCheck);
			}
		}
		elseif (!empty($discogs_album_id) && !empty($discogs_discog_id))
		{
			if (false !== ($rowCheck = $this->Mt_mw_album_model->get_discogs_by_album_and_release_id($discogs_album_id, $discogs_discog_id)))
			{
				$rsCheck = $this->vigilantedblib->_db_return_rs($rowCheck);
			}
		}

		if (!empty($rsCheck->discogs_id))
		{
			$discogs_id = $rsCheck->discogs_id;
			$input['discogs_id'] = $discogs_id;
			$this->update($discogs_id, $input);
		}
		else
		{
			$this->create($input);
		}
	}
	
	function update($discogs_id, $input)
	{
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_release_model->update_discogs_map_by_id($discogs_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Discogs release information was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create($input)
	{
		if (false !== $this->Mt_mw_release_model->add_discogs_map($input))
		{
			$this->phpsession->flashsave('msg', 'Discogs release information was created.');
			$mb_id = $this->db->insert_id();
		}
		
		//header('Location: /index.php/musicwhore/release/edit/' . $release_id . '/' . $release_artist_id . '/');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function remove($discogs_id, $album_artist_id = '')
	{
		if (false !== $this->Mt_mw_release_model->delete_discogs_map_by_id($discogs_id))
		{
			$this->phpsession->flashsave('msg', 'Discogs release association was deleted.');
		}
		else
		{
			$this->phpsession->flashsave('error', 'Discogs release association was not deleted.');
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	// Private methods
	function _update_artist($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Find Musicbrainz artist ID');
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		
		$keywords = $this->input->get_post('keywords');
		if (empty($keywords)) {$keywords = $artist_name;}
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		
		$this->mymusicbrainz->query_artist($keywords);
		$artist_list = $this->mymusicbrainz->results->{'artist-list'};
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		
		$this->mysmarty->assign('artist_list', $artist_list);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_discogs_artist_edit.tpl');
	}
	
	function _search_artist()
	{
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_artist_add.tpl');
	}
}

?>