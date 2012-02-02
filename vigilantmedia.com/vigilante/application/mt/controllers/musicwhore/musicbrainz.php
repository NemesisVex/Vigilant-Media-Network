<?php

class Musicbrainz extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyMusicbrainz');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/musicwhore/');
	}
	
	function artist($artist_id = '')
	{
		!empty($artist_id) ? $this->_update_artist($artist_id) : $this->_search_artist();
	}
	
	function albums($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Musicbrainz discography');

		$params = array('artistid' => $rsArtist->artist_mb_gid);
		$this->mymusicbrainz->query_release_group($params, 100);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		$release_list = $this->mymusicbrainz->results->{'release-group-list'}->{'release-group'};
		//print_r($release_list);
		$this->mysmarty->assign('release_list', $release_list);

		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_album_browse.tpl');
	}

	function album($album_artist_id, $mb_group_mb_gid, $album_title = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Browse Musicbrainz discography');

		$rowMusicBrainz = $this->Mt_mw_release_model->get_releases_by_mb_group_gid($mb_group_mb_gid);
		$rsMusicBrainz = $this->vigilantedblib->_db_return_smarty_array($rowMusicBrainz);

		$this->mymusicbrainz->get_release_group_by_id($mb_group_mb_gid, 'artist releases', 100);
		$results = $this->mymusicbrainz->results;
		$release_group = $results->{'release-group'};
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		//print_r($release_group);
		//die();

		$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);

		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('rsMusicBrainz', $rsMusicBrainz);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('album_title', urldecode($album_title));
		$this->mysmarty->assign('mb_group_mb_gid', $mb_group_mb_gid);
		$this->mysmarty->assign('release_group', $release_group);
		$this->mysmarty->assign('request_uri', $this->mymusicbrainz->request_uri);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_album_edit.tpl');
	}

	function releases($artist_id, $mb_group_mb_gid = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Musicbrainz discography');

		if (!empty($mb_group_mb_gid))
		{
			$this->mymusicbrainz->get_release_group_by_id($mb_group_mb_gid, 'artist releases', 100);
			$release_list = $this->mymusicbrainz->results->{'release-group'}->{'release-list'}->release;
		}
		else
		{
			$this->mymusicbrainz->get_artist_by_id($rsArtist->artist_mb_gid, 'sa-Official release-rels', 100);
			$release_list = $this->mymusicbrainz->results->artist->{'release-list'}->release;
		}

		//print_r($release_list);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		$this->mysmarty->assign('request_uri', $this->mymusicbrainz->request_uri);
		$this->mysmarty->assign('release_list', $release_list);
		
		$this->mysmarty->assign('mb_group_mb_gid', $mb_group_mb_gid);
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_release_browse.tpl');
	}
	
	function release($album_artist_id, $mb_gid, $mb_group_mb_gid = '', $album_title = '')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Browse Musicbrainz discography');
		
		$rowMusicBrainz = $this->Mt_mw_release_model->get_release_by_mb_gid($mb_gid);
		$rsMusicBrainz = $this->vigilantedblib->_db_return_smarty_array($rowMusicBrainz);

		$this->mymusicbrainz->get_release_by_id($mb_gid, 'artist release-events release-groups labels', 100);
		$results = $this->mymusicbrainz->results;
		$release_info = $results->release;
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		//print_r($results);
		//die();
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('rsMusicBrainz', $rsMusicBrainz);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('album_title', urldecode($album_title));
		$this->mysmarty->assign('mb_gid', $mb_gid);
		$this->mysmarty->assign('mb_group_mb_gid', $mb_group_mb_gid);
		$this->mysmarty->assign('release_info', $release_info);
		$this->mysmarty->assign('request_uri', $this->mymusicbrainz->request_uri);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_release_edit.tpl');
	}
	
	function tracks()
	{
	}
	
	function search()
	{
		$this->mtlib->_format_section_head('Musicwhore.org', 'Main administration', 'Add an artist');
		
		$keywords = array('name' => $this->input->get_post('keywords'));
		$this->mymusicbrainz->query_artist($keywords);
		$artist_list = $this->mymusicbrainz->results->{'artist-list'};
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		
		$this->mysmarty->assign('artist_list', $artist_list);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_artist_edit.tpl');
	}
	
	function setup()
	{
		$this->mtlib->_format_section_head('Musicwhore.org', 'Main administration', 'Add an artist');
		
		$artist_mb_gid = $this->input->get_post('artist_mb_gid');
		$this->mymusicbrainz->get_artist_by_id($artist_mb_gid);
		//$this->vigilantecorelib->debug_trace('<a href="' . $this->mymusicbrainz->request_uri . '">XML url</a>');
		$artist = $this->mymusicbrainz->results->artist;
		
		$artist_last_name = htmlspecialchars($artist->name);
		$artist_default_amazon_locale = 'us';
		$artist_file_system = strtolower(preg_replace("/\s/", '', $artist->{'sort-name'}));
		
		$this->mysmarty->assign('artist_last_name', $artist_last_name);
		$this->mysmarty->assign('artist_default_amazon_locale', $artist_default_amazon_locale);
		$this->mysmarty->assign('artist_file_system', $artist_file_system);
		$this->mysmarty->assign('artist_mb_gid', $artist_mb_gid);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_edit.tpl');
	}

	function browse($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, 'Browse Musicbrainz associations');

		$rowMusicBrainz = $this->Mt_mw_release_model->get_musicbrainz_by_artist_id($artist_id);
		$rsMusicBrainz = $this->vigilantedblib->_db_return_smarty_array($rowMusicBrainz);

		$this->mysmarty->assign('rsMusicBrainz', $rsMusicBrainz);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_browse.tpl');
	}

	function edit($mb_id)
	{
		$rowMusicBrainz = $this->Mt_mw_release_model->get_release_by_mb_id($mb_id);
		$rsMusicBrainz = $this->vigilantedblib->_db_return_rs($rowMusicBrainz);
		//print_r($rsMusicBrainz);

		$mb_album_mb_gid = $rsMusicBrainz->mb_album_mb_gid;

		$this->mymusicbrainz->get_release_by_id($mb_album_mb_gid, 'artist release-events release-groups labels', 100);
		$results = $this->mymusicbrainz->results;
		$release_info = $results->release;
		$this->mysmarty->assign('release_info', $release_info);
		
		if (!empty($rsMusicBrainz->album_artist_id))
		{
			$album_artist_id = $rsMusicBrainz->album_artist_id;
			$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Edit Musicbrainz association');

			$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
			$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
			$this->mysmarty->assign('rsAlbums', $rsAlbums);

			if (!empty($rsMusicBrainz->mb_album_id))
			{
				$release_album_id = $rsMusicBrainz->mb_album_id;
				$release_id = $rsMusicBrainz->mb_release_id;
				
				$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($release_album_id);
				$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);

				$this->mysmarty->assign('release_id', $release_id);
				$this->mysmarty->assign('rsReleases', $rsReleases);
			}

			$this->mysmarty->assign('rsMusicBrainz', $rsMusicBrainz);
		}

		$this->mysmarty->assign('mb_id', $mb_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_edit.tpl');
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

	// Processing methods
	function map($mb_album_mb_gid, $artist_id)
	{
		//$function = $this->input->get_post('function');
		$mb_album_id = $this->input->get_post('mb_album_id');
		$mb_release_id = $this->input->get_post('mb_release_id');
		$mb_group_mb_gid = $this->input->get_post('mb_group_mb_gid');

		if (empty($mb_album_id))
		{
			$rsRelease = $this->Mt_mw_release_model->get_release_by_id($mb_release_id, true);
			$mb_album_id = $rsRelease->release_album_id;
		}
		
		$input['mb_album_id'] = $mb_album_id;
		$input['mb_release_id'] = $mb_release_id;
		$input['mb_album_mb_gid'] = $mb_album_mb_gid;
		$input['mb_group_mb_gid'] = $mb_group_mb_gid;

		// If an association with a release already exists, update, don't create
		if (false !== ($rowCheck = $this->Mt_mw_release_model->get_musicbrainz_by_release_id($mb_release_id)))
		{
			$rsCheck = $this->vigilantedblib->_db_return_rs($rowCheck);
		}
		
		if (!empty($rsCheck->mb_id))
		{
			$mb_id = $rsCheck->mb_id;
			$input['mb_id'] = $mb_id;
			$this->update($mb_id, $input);
		}
		else
		{
			$this->create($input);
		}
	}
	
	function update($mb_id, $input = '')
	{
		if (empty($input))
		{
			$rowMusicbrainz = $this->Mt_mw_release_model->get_musicbrainz_by_mb_id($mb_id);
			$input = $this->vigilantedblib->_db_build_update_data($rowMusicbrainz);
		}
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_release_model->update_musicbrainz_map_by_id($mb_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Musicbrainz release information was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create($input)
	{
		if (false !== $this->Mt_mw_release_model->add_musicbrainz_map($input))
		{
			$this->phpsession->flashsave('msg', 'Musicbrainz release information was created.');
			$mb_id = $this->db->insert_id();
		}
		
		//header('Location: /index.php/musicwhore/release/edit/' . $release_id . '/' . $release_artist_id . '/');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function remove($mb_id, $album_artist_id = '')
	{
		$this->Mt_mw_release_model->delete_musicbrainz_map_by_id($mb_id);
		$this->phpsession->flashsave('msg', 'Musicbrainz release association was deleted.');
		
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
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_artist_edit.tpl');
	}
	
	function _search_artist()
	{
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_musicbrainz_artist_add.tpl');
	}
}

?>