<?php

class Release extends CI_Controller
{
	var $blog_id = 12;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_ep4_artist_model');
		$this->load->model('Mt_ep4_album_model');
		$this->load->model('Mt_ep4_release_model');
		$this->load->model('Mt_ep4_tracks_model');
		$this->load->model('Mt_ep4_audio_model');
		$this->load->model('Mt_ep4_content_model');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_product_model');
		$this->load->model('Mt_ep4_product_map_model');
		$this->load->model('Mt_mt_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function browse($album_artist_id, $function = 'edit')
	{
		$header = $function == 'delete' ? 'Delete a release' : 'Edit a release';
		$rsArtist = $this->mtlib->_format_ep4_section_head($album_artist_id, $header);
		
		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_album_release_browse.tpl');
	}
	
	function add($album_artist_id, $release_album_id = '', $template = 'mt_ep4_album_release_edit.tpl', $header = 'Add a release')
	{
		if (empty($album_artist_id)) {$album_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_ep4_section_head($album_artist_id, $header);
		
		$rowAlbums = $this->Mt_ep4_album_model->get_albums_by_artist_id($album_artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
		
		$rowFormats = $this->Mt_ep4_release_model->get_formats();
		$rsFormats = $this->vigilantedblib->_db_return_smarty_array($rowFormats);
		
		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		$this->mysmarty->assign('rsFormats', $rsFormats);
		$this->mysmarty->assign('release_album_id', $release_album_id);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($release_id, $album_artist_id = '', $template = 'mt_ep4_album_release_edit.tpl', $header = 'Edit a release')
	{
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		
		if (empty($album_artist_id))
		{
			$album_artist_id = !empty($rsRelease->album_artist_id) ? $rsRelease->album_artist_id : $this->artist_id;
		}
		
		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);
		$this->mysmarty->assign('rsSongs', $rsSongs);
		
		$rowFiles = $this->Mt_ep4_audio_model->get_files_by_artist_id($album_artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);
		$this->mysmarty->assign('rsFiles', $rsFiles);
		
		$rowEntries = $this->Mt_ep4_content_model->get_maps_by_release_id($release_id);
		$rsEntries = $this->vigilantedblib->_db_return_smarty_array($rowEntries);
		$this->mysmarty->assign('rsEntries', $rsEntries);
		
		$rowCategories = $this->Mt_mt_model->get_all_categories($this->blog_id);
		$rsCategories = $this->vigilantedblib->_db_return_smarty_array($rowCategories);
		$this->mysmarty->assign('rsCategories', $rsCategories);
		
		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		$this->mysmarty->assign('rsReleases', $rsReleases);
		
		$rsProductMaps = $this->Mt_ep4_product_map_model->get_products_by_release_id($release_id);
		$this->mysmarty->assign('rsProductMaps', $rsProductMaps);
		//echo '<pre>';
		//print_r($rsProductMaps);
		//echo '</pre>';
		
		$rsProducts = $this->Mt_ep4_product_model->get_products();
		$this->mysmarty->assign('rsProducts', $rsProducts);
		
		$this->mysmarty->assign('release_id', $release_id);
		$this->add($album_artist_id, $rsRelease->release_album_id, $template, $header);
	}
	
	function delete($release_id, $album_artist_id)
	{
		$this->edit($release_id, $album_artist_id, 'mt_ep4_album_release_delete.tpl', 'Delete a release');
	}
	
	// Processing methods
	
	function update($release_id)
	{
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id, true);
		$input = $this->vigilantedblib->_db_build_update_data($rsRelease);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_ep4_release_model->update_release_by_id($release_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Release information was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create($release_artist_id)
	{
		$rsRelease = $this->db->get('ep4_albums_releases', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsRelease);
		$input['release_artist_id'] = $release_artist_id;
		
		if (false !== $this->Mt_ep4_release_model->add_release($input))
		{
			$this->phpsession->flashsave('msg', 'Release information was created.');
			$release_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/ep4/release/edit/' . $release_id . '/' . $release_artist_id . '/');
		die();
	}
	
	function remove($release_id, $album_artist_id = '')
	{
		$confirm = $this->input->get_post('confirm');
		$album_title = $this->input->get_post('album_title');
		$format_name = $this->input->get_post('format_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_audio_model->delete_audio_maps_by_release_id($release_id);
			$this->Mt_ep4_content_model->delete_content_maps_by_release_id($release_id);
			$this->Mt_ep4_tracks_model->delete_tracks_by_release_id($release_id);
			$this->Mt_ep4_release_model->delete_release_by_id($release_id);
			
			$this->phpsession->flashsave('msg', 'The ' . $format_name . ' of <em>' . $album_title . '</em> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The ' . $format_name . ' of <em>' . $album_title . '</em> was not deleted.');
		}
		
		header('Location: /index.php/ep4/artist/info/' . $album_artist_id . '/');
		die();
	}
	// Private methods
}

?>