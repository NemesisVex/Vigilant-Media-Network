<?php

class Ecommerce extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_ep4_artist_model');
		$this->load->model('Mt_ep4_album_model');
		$this->load->model('Mt_ep4_release_model');
		$this->load->model('Mt_ep4_tracks_model');
		$this->load->model('Mt_ep4_song_model');
		$this->load->model('Mt_ep4_content_model');
		$this->load->model('Mt_ep4_ecommerce_model');
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
		$header = $function == 'delete' ? 'Delete a release' : 'Administer ecommerce links';
		$rsArtist = $this->mtlib->_format_ep4_section_head($album_artist_id, $header);
		
		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_artist_id($album_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_ecommerce_browse.tpl');
	}
	
	function edit($ecommerce_release_id, $album_artist_id, $header = 'Administer ecommerce links', $ecommerce_track_id = null)
	{
		$rsArtist = $this->mtlib->_format_ep4_section_head($album_artist_id, $header);
		
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($ecommerce_release_id);
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_by_release_id($ecommerce_release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$rowLinks = $this->Mt_ep4_ecommerce_model->get_ecommerce_links_by_release_id($ecommerce_release_id, $ecommerce_track_id);
		$rsLinks = $this->vigilantedblib->_db_return_smarty_array($rowLinks);
		
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsLinks', $rsLinks);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('ecommerce_release_id', $ecommerce_release_id);
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_ecommerce_edit.tpl');
	}
	
	function track($ecommerce_track_id, $ecommerce_release_id, $album_artist_id, $header = 'Administer ecommerce links')
	{
		$rsSong = $this->Mt_ep4_tracks_model->get_track_by_id($ecommerce_track_id);
		
		$this->mysmarty->assign('rsSong', $rsSong);
		$this->mysmarty->assign('ecommerce_track_id', $ecommerce_track_id);
		
		$this->edit($ecommerce_release_id, $album_artist_id, $header = 'Administer ecommerce links', $ecommerce_track_id);
	}
	
	//Process methods
	
	function create($ecommerce_release_id, $album_artist_id, $ecommerce_track_id = '')
	{
		$rsLink = $this->db->get('ep4_ecommerce', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsLink);
		$input['ecommerce_release_id'] = $ecommerce_release_id;
		if (false !== $this->Mt_ep4_ecommerce_model->add_ecommerce_link($input))
		{
			$this->phpsession->flashsave('msg', 'Ecommerce link was created.');
			$release_id = $this->db->insert_id();
		}
		
		$release_path = '/index.php/ep4/ecommerce/edit/' . $ecommerce_release_id . '/' . $album_artist_id . '/';
		$track_path = '/index.php/ep4/ecommerce/track/' . $ecommerce_track_id .  '/' . $ecommerce_release_id . '/' . $album_artist_id . '/';
		$redirect = !empty($ecommerce_track_id) ? $track_path : $release_path;
		header('Location: ' . $redirect);
		die();
	}
	
	function update($ecommerce_release_id, $album_artist_id, $ecommerce_track_id = '')
	{
		$ecomm_in = $this->input->get_post('ecomm_in');
		
		foreach ($ecomm_in as $ecomm)
		{
			if (!empty($ecomm['ecommerce_id']))
			{
				!empty($ecomm['delete']) ? $this->_delete_link($ecomm) : $this->_update_link($ecomm, $ecommerce_release_id);
			}
		}
		
		$this->phpsession->flashsave('msg', 'Ecommerce links were updated.');
		
		$release_path = '/index.php/ep4/ecommerce/edit/' . $ecommerce_release_id . '/' . $album_artist_id . '/';
		$track_path = '/index.php/ep4/ecommerce/track/' . $ecommerce_track_id .  '/' . $ecommerce_release_id . '/' . $album_artist_id . '/';
		$redirect = !empty($ecommerce_track_id) ? $track_path : $release_path;
		header('Location: ' . $redirect);
		die();
	}
	
	// Private methods
	function _update_link($ecomm, $ecommerce_release_id)
	{
		$ecomm_id = $ecomm['ecommerce_id'];
		$rsLink = $this->Mt_ep4_ecommerce_model->get_ecommerce_link_by_id($ecomm_id);
		
		$input = $this->vigilantedblib->_db_build_update_data($rsLink, $ecomm);
		
		if (!empty($input))
		{
			$input['ecommerce_release_id'] = $ecommerce_release_id;
			$this->Mt_ep4_ecommerce_model->update_ecommerce_link_by_id($ecomm_id, $input);
		}
	}
	
	function _delete_link($ecomm)
	{
		$ecomm_id = $ecomm['ecommerce_id'];
		$this->Mt_ep4_ecommerce_model->delete_ecommerce_link_by_id($ecomm_id);
	}
}
?>