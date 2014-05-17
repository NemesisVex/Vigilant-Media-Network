<?php

class Album extends CI_Controller
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
		$this->mtlib->mt_config['album_format_mask'] = array(2 => 'album', 4 => 'single', 8 => 'ep', 16 => 'compilation', 32 => 'video', 64 => 'book');
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function add($album_artist_id, $template = 'mt_ep4_album_edit.tpl', $header = 'Add an album')
	{
		if (empty($album_artist_id)) {$album_artist_id = $this->artist_id;}
		$rsArtist = $this->mtlib->_format_ep4_section_head($album_artist_id, $header);
		
		$this->mysmarty->assign('album_artist_id', $album_artist_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($album_id, $album_artist_id = '', $template = 'mt_ep4_album_edit.tpl', $header = 'Edit an album')
	{
		$rsAlbum = $this->Mt_ep4_album_model->get_album_by_id($album_id);
		
		if (empty($album_artist_id))
		{
			$album_artist_id = !empty($rsAlbum->album_artist_id) ? $rsAlbum->album_artist_id : $this->artist_id;
		}
		
		$rowReleases = $this->Mt_ep4_release_model->get_releases_by_album_id($album_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('rsAlbum', $rsAlbum);
		$this->mysmarty->assign('album_id', $album_id);
		$this->add($album_artist_id, $template, $header);
	}
	
	function delete($album_id, $album_artist_id = '')
	{
		$this->edit($album_id, $album_artist_id, 'mt_ep4_album_delete.tpl', 'Delete an album');
	}
	
	// Processing methods
	
	function update($album_id)
	{
		$rsAlbum = $this->Mt_ep4_album_model->get_album_by_id($album_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsAlbum);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_ep4_album_model->update_album_by_id($album_id, $input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $rsAlbum->album_title . '</em> was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create($album_artist_id)
	{
		$rsAlbum = $this->db->get('ep4_albums', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsAlbum);
		
		if (!empty($input))
		{
			$input['album_artist_id'] = $album_artist_id;
			if (false !== $this->Mt_ep4_album_model->add_album($input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $input['album_title'] . '</em> was created.');
				$album_id = $this->db->insert_id();
				header('Location: /index.php/ep4/album/edit/' . $album_id . '/' . $album_artist_id . '/');
			}
		}
		
		die();
	}
	
	function remove($album_id, $album_artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$album_title = $this->input->get_post('album_title');
		
		if ($confirm == 'Yes')
		{
			$rowReleases = $this->Mt_ep4_release_model->get_releases_by_album_id($album_id, 'release_id');
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
			
			$this->Mt_ep4_album_model->delete_album_by_id($album_id);
			$this->phpsession->flashsave('msg', '<em>' . $album_title . '</em> was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', '<em>' . $album_title . '</em> was not deleted.');
		}
		
		header('Location: /index.php/ep4/artist/info/' . $album_artist_id . '/');
		die();
	}
	
	// Private methods
}

?>