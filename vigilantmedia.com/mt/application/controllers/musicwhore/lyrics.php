<?php

class Lyrics extends CI_Controller
{
	var $artist_id = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
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
	
	function browse($lyric_artist_id, $function = 'edit')
	{
		$header = $function == 'delete' ? 'Delete lyric file' : 'Edit lyric file';
		$rsArtist = $this->mtlib->_format_mw_section_head($lyric_artist_id, $header);
		
		$rowFiles = $this->Mt_mw_lyrics_model->get_files_by_artist_id($lyric_artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);
		
		$this->mysmarty->assign('rsFiles', $rsFiles);
		$this->mysmarty->assign('lyric_artist_id', $lyric_artist_id);
		$this->mysmarty->assign('function', $function);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_lyrics_browse.tpl');
	}
	
	function add($lyric_artist_id, $template = 'mt_musicwhore_lyrics_edit.tpl', $header = 'Add lyric file')
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($lyric_artist_id, $header);
		
		$rowArtists = $this->Mt_mw_artist_model->get_all_artists();
		$rsArtists = $this->vigilantedblib->_db_return_smarty_array($rowArtists);
		
		$this->mysmarty->assign('rsArtists', $rsArtists);
		$this->mysmarty->assign('lyric_artist_id', $lyric_artist_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function edit($lyric_id, $lyric_artist_id, $template = 'mt_musicwhore_lyrics_edit.tpl', $header = 'Edit lyric file')
	{
		$rsLyric = $this->Mt_mw_lyrics_model->get_lyric_by_id($lyric_id);
		
		if (empty($lyric_artist_id))
		{
			$lyric_artist_id = !empty($rsLyric->lyric_artist_id) ? $rsLyric->lyric_artist_id : $this->artist_id;
		}
		
		$this->mysmarty->assign('rsLyric', $rsLyric);
		$this->mysmarty->assign('lyric_id', $lyric_id);
		$this->add($lyric_artist_id, $template, $header);
	}
	
	function delete($lyric_id, $lyric_artist_id)
	{
		$this->edit($lyric_id, $lyric_artist_id, 'mt_musicwhore_lyrics_delete.tpl', 'Delete an audio file');
	}
	
	function releases($release_artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($release_artist_id, 'Map file to track');
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($release_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('release_artist_id', $release_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_lyrics_map_releases.tpl');
	}
	
	function tracks($release_id)
	{
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_mw_section_head($rsRelease->album_artist_id, 'Map file to track');
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_mapped_to_lyric($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$rowFiles = $this->Mt_mw_lyrics_model->get_files_by_artist_id($rsRelease->album_artist_id);
		$rsFiles = $this->vigilantedblib->_db_return_smarty_array($rowFiles);
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsFiles', $rsFiles);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mysmarty->assign('artist_id', $rsRelease->album_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_lyrics_map_tracks.tpl');
	}
	
	// Processing methods
	
	function update($lyric_id)
	{
		$lyric_file_name = $this->input->get_post('lyric_file_name');
		$lyric_artist_id = $this->input->get_post('lyric_artist_id');
		
		$rsLyric = $this->Mt_mw_lyrics_model->get_lyric_by_id($lyric_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsLyric);
		
		if (!empty($input))
		{
			$input['lyric_id'] = $lyric_id;
			if (false !== $this->Mt_mw_lyrics_model->update_lyric_by_id($lyric_id, $input))
			{
				$this->phpsession->flashsave('msg', 'Lyric file information was updated.');
			}
		}
		
		header('Location: /index.php/musicwhore/lyrics/edit/' . $lyric_id . '/' . $lyric_artist_id . '/');
		die();
	}
	
	function create($lyric_artist_id)
	{
		$rsLyric = $this->db->get('mw_lyrics', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsLyric);
		$input['lyric_artist_id'] = $lyric_artist_id;
		
		if (false !== $this->Mt_mw_lyrics_model->add_lyric($input))
		{
			$this->phpsession->flashsave('msg', 'Lyric file information was created.');
			$lyric_id = $this->db->insert_id();
		}
		
		header('Location: /index.php/musicwhore/lyrics/edit/' . $lyric_id . '/' . $lyric_artist_id . '/');
		die();
	}
	
	function remove($lyric_id, $lyric_artist_id)
	{
		$confirm = $this->input->get_post('confirm');
		$lyric_file_name = $this->input->get_post('lyric_file_name');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_mw_lyrics_model->delete_lyric_maps_by_lyric_id($lyric_id);
			$this->Mt_mw_lyrics_model->delete_lyric_by_id($lyric_id);
			
			$this->phpsession->flashsave('msg', $lyric_file_name . ' was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $lyric_file_name . ' was not deleted.');
		}
		
		header('Location: /index.php/musicwhore/artist/info/' . $lyric_artist_id . '/');
		die();
	}
	
	// Processing methods
	
	function map($release_id)
	{
		$map_in = $this->input->get_post('map_in');
		foreach ($map_in as $map)
		{
			if (!empty($map['lyric_map_id']))
			{
				!empty($map['delete']) ? $this->_delete_map($map) : $this->_update_map($map);
			}
			else
			{
				$this->_add_map($map);
			}
		}
		
		$this->phpsession->flashsave('msg', 'Your lyric mapping is now saved.');
		
		header('Location: /index.php/musicwhore/lyrics/tracks/' . $release_id . '/');
		die();
	}
	
	// Private methods
	function _update_map($map)
	{
		$lyric_map_id = $map['lyric_map_id'];
		$rsMap = $this->Mt_mw_lyrics_model->get_lyric_map_by_id($lyric_map_id);
		
		$input = $this->vigilantedblib->_db_build_update_data($rsMap, $map);
		
		if (!empty($input))
		{
			$this->Mt_mw_lyrics_model->update_lyric_map_by_id($lyric_map_id, $input);
		}
	}
	
	function _add_map($map)
	{
		$rsMap = $this->db->get('mw_lyrics_map', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsMap, $map);
		
		if (!empty($input))
		{
			$this->Mt_mw_lyrics_model->add_lyric_map($input);
		}
	}
	
	function _delete_map($map)
	{
		$lyric_map_id = $map['lyric_map_id'];
		$this->Mt_mw_lyrics_model->delete_lyric_map_by_id($lyric_map_id);
	}
	
}

?>