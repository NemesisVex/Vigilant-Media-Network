<?php

class Artist extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_mw_artist_model');
		$this->load->model('Mt_mw_personell_model');
		$this->load->model('Mt_mw_related_model');
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
	
	function get()
	{
		$artist_id = $this->input->get_post('artist_id');
		header('Location: /index.php/musicwhore/artist/info/' . $artist_id . '/');
	}
	
	function options()
	{
		$this->mtlib->_format_section_head('Musicwhore.org', 'Main administration', 'Add an artist');
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_options.tpl');
	}
	
	function info($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id);
		$artist_name = $this->vigilantecorelib->format_artist_name_object($rsArtist);
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('artist_name', $artist_name);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_info.tpl');
	}
	
	function link($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id);
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_link.tpl');
	}
	
	function personell($artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id);
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_personell.tpl');
	}
	
	function add()
	{
		$this->mtlib->_format_section_head('Musicwhore.org', 'Main administration', 'Add an artist');
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_artist_edit.tpl');
	}
	
	function edit($artist_id, $template = 'mt_musicwhore_artist_edit.tpl', $header = 'Edit artist profile')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($artist_id, $header);
		
		if (!empty($rsArtist))
		{
			foreach ($rsArtist as $field => $value)
			{
				$this->mysmarty->assign($field, $value);
			}
		}
		
		$this->mysmarty->assign('artist_id', $artist_id);
		$this->mysmarty->assign('rsArtist', $rsArtist);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function delete($artist_id)
	{
		$this->edit($artist_id, 'mt_musicwhore_artist_delete.tpl', 'Delete an artist');
	}
	
	// Processing methods
	
	function update($artist_id)
	{
		$rsArtist = $this->Mt_mw_artist_model->get_artist_by_id($artist_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsArtist);
		
		if (false !== ($artist_settings = $this->input->get_post('artist_settings')))
		{
			$input['artist_settings_mask'] = array_sum($artist_settings);
		}
		if (false !== ($nav_settings = $this->input->get_post('nav_settings')))
		{
			$input['artist_navigation_mask'] = array_sum($nav_settings);
		}
		
		if (!empty($input))
		{
			$input['artist_id'] = $artist_id;
			if (false !== $this->Mt_mw_artist_model->update_artist_by_id($artist_id, $input))
			{
				$this->phpsession->flashsave('msg', 'The artist profile was updated.');
			}
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function create()
	{
		$rsArtist = $this->db->get('mw_artists', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsArtist);
		
		if (false !== ($artist_settings = $this->input->get_post('artist_settings')))
		{
			$input['artist_settings_mask'] = array_sum($artist_settings);
		}
		if (false !== ($nav_settings = $this->input->get_post('nav_settings')))
		{
			$input['artist_navigation_mask'] = array_sum($nav_settings);
		}
		
		if (false !== $this->Mt_mw_artist_model->add_artist($input))
		{
			$this->phpsession->flashsave('msg', 'The artist profile was created.');
			$artist_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/musicwhore/artist/info/' . $artist_id . '/');
		die();
	}
	
	function remove($artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$artist_name = $this->input->get_post('artist_name');
		
		if ($confirm == 'Yes')
		{
			$rowAlbums = $this->Mt_mw_album_model->get_albums_by_artist_id($artist_id);
			if ($rowAlbums->num_rows() >0)
			{
				foreach ($rowAlbums->result() as $rsAlbum)
				{
					$rowReleases = $this->Mt_mw_release_model->get_releases_by_album_id($rsAlbum->album_id, 'release_id');
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
					
					$this->Mt_mw_content_model->delete_content_maps_by_album_id($rsAlbum->album_id);
					$this->Mt_mw_album_model->delete_album_by_id($rsAlbum->album_id);
				}
			}
			
			$this->Mt_mw_album_model->delete_albums_by_artist_id($artist_id);
			$this->Mt_mw_content_model->delete_content_maps_by_artist_id($artist_id);
			$this->Mt_mw_personell_model->delete_member_by_artist_id($artist_id);
			$this->Mt_mw_related_model->delete_related_by_artist_id($artist_id);
			$this->Mt_mw_related_model->delete_related_by_relation_id($artist_id);
			
			$this->Mt_mw_artist_model->delete_artist_by_id($artist_id);
			
			$this->phpsession->flashsave('msg', $artist_name . ' was deleted.');
			header('Location: /index.php/mt/musicwhore/');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $artist_name . ' was not deleted.');
			header('Location: /index.php/musicwhore/artist/info/' . $artist_id . '/');
		}
		
		die();
	}
}

?>