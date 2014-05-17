<?php

class Release extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyAmazon');
		$this->load->library('MyEcommerce');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_album_model');
		$this->load->model('Mt_mw_release_model');
		$this->load->model('Mt_mw_tracks_model');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->load->model('Mt_mw_content_model');
		$this->load->model('Mt_mw_lyrics_model');
		$this->load->model('Mt_user_model');
		$this->mysmarty->assign('session', $this->phpsession);
		$this->mysmarty->assign('side_template', 'mt_musicwhore_artist_side.tpl');
		$this->mtlib->mt_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
		$this->mtlib->mt_config['amazon_locale'] = $this->myamazon->amazon_locale;
		$this->mtlib->mt_config['itunes_locale'] = $this->myecommerce->itunes_locale;
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/gregbueno/');
	}
	
	function browse($album_artist_id, $function = 'edit', $asin = '')
	{
		$header = $function == 'delete' ? 'Delete a release' : 'Edit a release';
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, $header);
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		if (!empty($asin))
		{
			$locale = $rsArtist->artist_default_amazon_locale;
			if (false !== ($items = $this->_lookup_asin($asin, $locale)))
			{
				$this->mysmarty->assign('album_title', $items->ItemAttributes->Title);
			}
		}

		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mysmarty->assign('asin', $asin);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_browse.tpl');
	}
	
	function albums($album_artist_id, $asin = '')
	{
		if (empty($album_artist_id)) {$album_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, 'Add a release');
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);

		$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);

		if (!empty($asin))
		{
			$locale = $rsArtist->artist_default_amazon_locale;
			if (false !== ($items = $this->_lookup_asin($asin, $locale)))
			{
				$this->mysmarty->assign('album_title', $items->ItemAttributes->Title);
			}
		}

		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mysmarty->assign('asin', $asin);
		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_albums.tpl');
	}

	function add($album_artist_id, $release_album_id = '', $asin = '', $template = 'mt_musicwhore_album_release_edit.tpl', $header = 'Add a release')
	{
		if (empty($album_artist_id)) {$album_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_mw_section_head($album_artist_id, $header);
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		
		if (!empty($release_album_id))
		{
			$rsAlbum = $this->Mt_mw_album_model->get_album_by_id($release_album_id);
			$this->mysmarty->assign('release_album_id', $rsAlbum->album_id);
			$this->mysmarty->assign('release_label', $rsAlbum->album_label);
			$this->mysmarty->assign('release_release_date', $rsAlbum->album_release_date);
			$this->mysmarty->assign('release_image', $rsAlbum->album_image);
		}
		
		if (!empty($asin))
		{
			$this->mysmarty->assign('release_asin_num', $asin);

			$locale = $rsArtist->artist_default_amazon_locale;
			if (false !== ($items = $this->_lookup_asin($asin, $locale)))
			{
				$this->mysmarty->assign('release_ean_num', $items->ItemAttributes->EAN);
				$this->mysmarty->assign('release_label', $items->ItemAttributes->Label);
				$this->mysmarty->assign('release_release_date', $items->ItemAttributes->ReleaseDate);
			}
		}

		$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
		
		$rowFormats = $this->Mt_mw_release_model->get_formats();
		$rsFormats = $this->vigilantedblib->_db_return_smarty_array($rowFormats);
		
		$rowCountries = $this->Mt_user_model->get_countries();
		$rsCountries = $this->vigilantedblib->_db_return_smarty_array($rowCountries);
		
		$this->mysmarty->assign('rsCountries', $rsCountries);
		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('rsFormats', $rsFormats);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mysmarty->assign('locale', $rsArtist->artist_default_amazon_locale);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('artist_id', $album_artist_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($release_id, $album_artist_id = '', $asin = '', $template = 'mt_musicwhore_album_release_edit.tpl', $header = 'Edit a release')
	{
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		
		if (empty($album_artist_id))
		{
			$album_artist_id = !empty($rsRelease->album_artist_id) ? $rsRelease->album_artist_id : $this->artist_id;
		}
		
		$rowBrianz = $this->Mt_mw_release_model->get_musicbrainz_by_release_id($release_id);
		$rsBrainz = $this->vigilantedblib->_db_return_smarty_array($rowBrianz);
		
		foreach ($rsRelease as $field => $value)
		{
			$this->mysmarty->assign($field, $value);
		}
		
		$rowEcomm = $this->Mt_mw_ecommerce_model->get_ecommerce_links_by_field_type($release_id, 'release_id');
		
		$rsEcomm = array();
		foreach ($rowEcomm->result() as $rs)
		{
			foreach ($rs as $field => $value)
			{
				$rsEcomm[$rs->ecommerce_merchant_id][$field] = $value;
			}
		}

		$this->mysmarty->assign('rsEcomm', $rsEcomm);
		$this->mysmarty->assign('rsBrainz', $rsBrainz);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('release_id', $release_id);
		$this->add($album_artist_id, '', $asin, $template, $header);
	}
	
	function delete($release_id, $album_artist_id)
	{
		$this->edit($release_id, $album_artist_id, '', 'mt_musicwhore_album_release_delete.tpl', 'Delete a release');
	}
	
	// Processing methods
	
	function update($release_id)
	{
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id, true);
		$input = $this->vigilantedblib->_db_build_update_data($rsRelease);
		$input['release_id'] = $release_id;
		
		$ecommerce_field_type = $this->input->get_post('ecommerce_field_type');
		$ecommerce_field_id = $this->input->get_post('ecommerce_field_id');
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_release_model->update_release_by_id($release_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Release information was updated.');
			}
		}
		
		$ecomm_in = $this->input->get_post('ecomm_in');
		if (!empty($ecomm_in))
		{
			foreach ($ecomm_in as $ecommerce_merchant_id => $ecomm)
			{
				$ecomm['ecommerce_merchant_id'] = $ecommerce_merchant_id;
				$ecomm['ecommerce_field_type'] = $ecommerce_field_type;
				$ecomm['ecommerce_field_id'] = $ecommerce_field_id;
				
				if (!empty($ecomm['ecommerce_ecomm_id']))
				{
					if (!empty($ecomm['ecommerce_id']))
					{
						!empty($ecomm['delete']) ? $this->_delete_ecommerce($ecomm) : $this->_update_ecommerce($ecomm);
					}
					else
					{
						$this->_add_ecommerce($ecomm);
					}
				}
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create($release_artist_id)
	{
		$rsRelease = $this->db->get('mw_albums_releases', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsRelease);
		//$input['release_artist_id'] = $release_artist_id;
		
		$ecommerce_field_type = $this->input->get_post('ecommerce_field_type');

		if (false !== $this->Mt_mw_release_model->add_release($input))
		{
			$this->phpsession->flashsave('msg', 'Release information was created.');
			$release_id = $this->db->insert_id();
			$ecommerce_field_id = $release_id;
		}
		
		$ecomm_in = $this->input->get_post('ecomm_in');
		if (!empty($ecomm_in))
		{
			foreach ($ecomm_in as $ecommerce_merchant_id => $ecomm)
			{
				$ecomm['ecommerce_merchant_id'] = $ecommerce_merchant_id;
				$ecomm['ecommerce_field_type'] = $ecommerce_field_type;
				$ecomm['ecommerce_field_id'] = $ecommerce_field_id;

				if (!empty($ecomm['ecommerce_ecomm_id']))
				{
					if (!empty($ecomm['ecommerce_id']))
					{
						!empty($ecomm['delete']) ? $this->_delete_ecommerce($ecomm) : $this->_update_ecommerce($ecomm);
					}
					else
					{
						$this->_add_ecommerce($ecomm);
					}
				}
			}
		}

		header('Location: /index.php/musicwhore/release/edit/' . $release_id . '/' . $release_artist_id . '/');
		die();
	}
	
	function remove($release_id, $album_artist_id = '')
	{
		$confirm = $this->input->get_post('confirm');
		$album_title = $this->input->get_post('album_title');
		$format_name = $this->input->get_post('format_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_mw_ecommerce_model->delete_ecommerce_link_by_field_type($release_id, 'release_id');
			$this->Mt_mw_lyrics_model->delete_lyric_maps_by_release_id($release_id);
			$this->Mt_mw_release_model->delete_musicbrainz_map_by_release_id($release_id);
			$this->Mt_mw_tracks_model->delete_tracks_by_release_id($release_id);
			
			$this->Mt_mw_release_model->delete_release_by_id($release_id);
			$this->phpsession->flashsave('msg', 'The ' . $format_name . ' of <em>' . $album_title . '</em> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The ' . $format_name . ' of <em>' . $album_title . '</em> was not deleted.');
		}
		
		header('Location: /index.php/musicwhore/artist/info/' . $album_artist_id . '/');
		die();
	}
	
	// Private methods
	function _add_ecommerce($ecomm)
	{
		$rsEcommerce = $this->db->get('mw_ecommerce', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsEcommerce, $ecomm);
		
		$this->Mt_mw_ecommerce_model->add_ecommerce_link($input);
	}
	
	function _update_ecommerce($ecomm)
	{
		$ecommerce_id = $ecomm['ecommerce_id'];
		$rsEcommerce = $this->Mt_mw_ecommerce_model->get_ecommerce_link_by_id($ecommerce_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsEcommerce, $ecomm);
		
		if (!empty($input))
		{
			$this->Mt_mw_ecommerce_model->update_ecommerce_link_by_id($ecommerce_id, $input);
		}
	}
	
	function _delete_ecommerce($ecomm)
	{
		$ecommerce_id = $ecomm['ecommerce_id'];
		$this->Mt_mw_ecommerce_model->delete_ecommerce_link_by_id($ecommerce_id);
	}

	function _lookup_asin($asin, $locale)
	{
		$results = $this->mtlib->_lookup_asin($asin, $locale);
		$items = $results->Items->Item;
		$display = empty($items->Request->Errors) ? true : false;
		if ($display == true)
		{
			return $items;
		}
		return false;
	}
}

?>