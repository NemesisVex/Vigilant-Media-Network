<?php

class Album extends CI_Controller
{
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyAmazon');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
		$this->mtlib->mt_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/gregbueno/');
	}
	
	function browse($album_artist_id, $function = 'edit', $asin = '')
	{
		$header = $function == 'delete' ? 'Delete an album' : 'Edit an album';
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, $header);
		
		$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
		
		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mysmarty->assign('asin', $asin);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_browse.tpl');
	}
	
	function options($album_artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Add an album');
		
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_options.tpl');
	}
	
	function add($album_artist_id, $asin = '', $template = 'mt_musicwhore_album_edit.tpl', $header = 'Add an album')
	{
		if (empty($album_artist_id)) {$album_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, $header);
		
		$rowFormats = $this->Mt_mw_album_model->get_album_formats();
		$rsFormats = $this->vigilantedblib->_db_return_smarty_array($rowFormats);
		
		$rowClassicalArtists = $this->Mt_mw_artist_model->get_artists_by_settings_mask(8);
		$rsClassicalArtists = $this->vigilantedblib->_db_return_smarty_array($rowClassicalArtists);
		
		if (!empty($asin))
		{
			$locale = $rsArtist->artist_default_amazon_locale;
			$results = $this->mtlib->_lookup_asin($asin, $locale);
			$items = $results->Items->Item;
			$display = empty($items->Request->Errors) ? true : false;

			if ($display == true)
			{
				$this->mysmarty->assign('album_title', $items->ItemAttributes->Title);
				$this->mysmarty->assign('album_label', $items->ItemAttributes->Label);
				$this->mysmarty->assign('album_release_date', $items->ItemAttributes->ReleaseDate);
				$this->mysmarty->assign('auth_request_uri', $this->myamazon->auth_request_uri);
			}
		}

		$this->mysmarty->assign('rsClassicalArtists', $rsClassicalArtists);
		$this->mysmarty->assign('rsFormats', $rsFormats);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($album_id, $album_artist_id = '', $asin = '', $template = 'mt_musicwhore_album_edit.tpl', $header = 'Edit an album')
	{
		$rsAlbum = $this->Mt_mw_album_model->get_album_by_id($album_id);
		
		if (empty($album_artist_id))
		{
			$album_artist_id = !empty($rsAlbum->album_artist_id) ? $rsAlbum->album_artist_id : $this->artist_id;
		}
		
		foreach ($rsAlbum as $field => $value)
		{
			$this->mysmarty->assign($field, $value);
		}
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($album_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('rsAlbum', $rsAlbum);
		$this->mysmarty->assign('album_id', $album_id);
		$this->add($album_artist_id, $asin, $template, $header);
	}
	
	function delete($album_id, $album_artist_id = '')
	{
		$this->edit($album_id, $album_artist_id, '', 'mt_musicwhore_album_delete.tpl', 'Delete an album');
	}
	
	// Processing methods
	
	function update($album_id)
	{
		$rsAlbum = $this->Mt_mw_album_model->get_album_by_id($album_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsAlbum);
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_album_model->update_album_by_id($album_id, $input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $rsAlbum->album_title . '</em> was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create($album_artist_id)
	{
		$rsAlbum = $this->db->get('mw_albums', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsAlbum);
		
		if (!empty($input))
		{
			$input['album_artist_id'] = $album_artist_id;
			if (false !== $this->Mt_mw_album_model->add_album($input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $input['album_title'] . '</em> was created.');
				$album_id = $this->db->insert_id();
			}
		}
		
		header('Location: /index.php/musicwhore/album/edit/' . $album_id . '/' . $album_artist_id . '/');
		die();
	}
	
	function remove($album_id, $album_artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$album_title = $this->input->get_post('album_title');
		
		if ($confirm == 'Yes')
		{
			$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($album_id, 'release_id');
			if ($rowReleases->num_rows() > 0)
			{
				foreach ($rowReleases->result() as $rsRelease)
				{
					$release_ids[] = $rsRelease->release_id;
				}
			}
			if (!empty($release_ids))
			{
				$this->Mt_mw_ecommerce_model->delete_ecommerce_link_by_field_type($release_ids, 'release_id');
				$this->Mt_mw_lyrics_model->delete_lyric_maps_by_release_id($release_ids);
				$this->Mt_mw_release_model->delete_release_by_id($release_ids);
				$this->Mt_mw_release_model->delete_musicbrainz_map_by_release_id($release_ids);
				$this->Mt_mw_tracks_model->delete_tracks_by_release_id($release_ids);
			}
			
			$this->Mt_mw_content_model->delete_content_maps_by_album_id($album_id);
			$this->Mt_mw_album_model->delete_album_by_id($album_id);
			$this->phpsession->flashsave('msg', '<em>' . $album_title . '</em> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<em>' . $album_title . '</em> was not deleted.');
		}
		
		header('Location: /index.php/musicwhore/artist/info/' . $album_artist_id . '/');
		die();
	}
	
	// Private methods
}

?>