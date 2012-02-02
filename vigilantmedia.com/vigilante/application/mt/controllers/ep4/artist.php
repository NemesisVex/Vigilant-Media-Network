<?php

class Artist extends CI_Controller
{
	var $artist_id = 1;
	
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
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function info($artist_id)
	{
		$rsArtist = $this->mtlib->_format_ep4_section_head($artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		
		$rowAlbums = $this->Mt_ep4_album_model->get_albums_by_artist_id($artist_id);
		$rsAlbums = $this->vigilantedblib->_db_return_smarty_array($rowAlbums);
		$this->mysmarty->assign('rsAlbums', $rsAlbums);
		
		$rowFiles = $this->Mt_ep4_audio_model->get_files_by_artist_id($artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);
		$this->mysmarty->assign('rsFiles', $rsFiles);
		
		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_artist_id($artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		$this->mysmarty->assign('rsReleases', $rsReleases);
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_artist_info.tpl');
	}
	
	function add()
	{
		$this->mtlib->_format_section_head('Observant Records', 'Artist administration', 'Add an artist');
		$this->mtlib->_smarty_display_mt_page('mt_ep4_artist_edit.tpl');
	}
	
	function edit($artist_id, $template = 'mt_ep4_artist_edit.tpl', $header = 'Edit artist profile')
	{
		$rsArtist = $this->mtlib->_format_ep4_section_head($artist_id, $header);
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function delete($artist_id)
	{
		$this->edit($artist_id, 'mt_ep4_artist_delete.tpl', 'Delete an artist');
	}
	
	// Processing methods
	
	function update($artist_id)
	{
		$rsArtist = $this->Mt_ep4_artist_model->get_artist_by_id($artist_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsArtist);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_ep4_artist_model->update_artist_by_id($artist_id, $input))
			{
				$this->phpsession->flashsave('msg', 'The artist profile was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create()
	{
		$rsArtist = $this->db->get('ep4_artists', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsArtist);
		
		if (false !== $this->Mt_ep4_artist_model->add_artist($input))
		{
			$this->phpsession->flashsave('msg', 'The artist profile was created.');
			$artist_id = $this->db->insert_id();
			return $artist_id;
		}
		
		header('Location: /index.php/ep4/artist/info/' . $artist_id . '/');
		die();
	}
	
	function remove($artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$artist_name = $this->input->get_post('artist_name');
		
		if ($confirm == 'Yes')
		{
			$rowAlbums = $this->Mt_ep4_album_model->get_albums_by_artist_id($artist_id);
			if ($rowAlbums->num_rows() >0)
			{
				foreach ($rowAlbums->result() as $rsAlbum)
				{
					$rowReleases = $this->Mt_ep4_release_model->get_releases_by_album_id($rsAlbum->album_id, 'release_id');
					if ($rowReleases->num_rows() > 0)
					{
						foreach ($rowReleases->result() as $rsRelease)
						{
							$release_ids[] = $rsRelease->release_id;
						}
					}
					if (!empty($release_ids))
					{
						$this->Mt_ep4_audio_model->delete_audio_maps_by_release_id($release_ids);
						$this->Mt_ep4_content_model->delete_content_maps_by_release_id($release_ids);
						$this->Mt_ep4_tracks_model->delete_tracks_by_release_id($release_ids);
						$this->Mt_ep4_release_model->delete_release_by_id($release_ids);
					}
					
					$this->Mt_ep4_album_model->delete_album_by_id($rsAlbum->album_id);
				}
			}
			
			$this->Mt_ep4_artist_model->delete_artist_by_id($artist_id);
			
			$this->phpsession->flashsave('msg', $artist_name . ' was deleted.');
			header('Location: /index.php/mt/ep4/');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $artist_name . ' was not deleted.');
			header('Location: /index.php/ep4/artist/info/' . $artist_id . '/');
		}
		
		die();
	}
}

?>