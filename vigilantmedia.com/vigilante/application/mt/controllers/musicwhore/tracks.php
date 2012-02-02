<?php

class Tracks extends CI_Controller
{
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
		header('Location: /index.php/gregbueno/');
	}
	
	function browse($release_artist_id)
	{
		$rsArtist = $this->mtlib->_format_mw_section_head($release_artist_id, 'Add/edit tracks');
		
		$rowReleases = $this->Mt_mw_release_model->get_releases_by_artist_id($release_artist_id);
		$rsReleases = $this->vigilantedblib->_db_return_smarty_array($rowReleases);
		
		$this->mysmarty->assign('rsReleases', $rsReleases);
		$this->mysmarty->assign('release_artist_id', $release_artist_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_tracks_browse.tpl');
	}
	
	function check($release_id)
	{
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_mw_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_tracks_check.tpl');
	}
	
	function save($release_id)
	{
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_mw_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_tracks_save.tpl');
	}
	
	function edit($release_id)
	{
		$is_add_more = $this->input->get_post('is_add_more');
		$more_tracks = $this->input->get_post('more_tracks');
		
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_mw_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		if ($is_add_more == true)
		{
			$track_num = count($rsTracks) + 1;
			for ($i=0; $i < $more_tracks; $i++)
			{
				array_push($rsTracks, array('new_track_setup' => $track_num));
				$track_num++;
			}
			
		}
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('track_release_id', $release_id);
		$this->mysmarty->assign('track_album_id', $rsRelease->album_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_tracks_edit.tpl');
	}
	
	function add($release_id)
	{
		$number_of_tracks = $this->input->get_post('number_of_tracks');
		
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_mw_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		for ($i=0; $i<$number_of_tracks; $i++)
		{
			$rsTracks[$i]['new_track_setup'] = $i+1;
		}
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('track_release_id', $release_id);
		$this->mysmarty->assign('track_album_id', $rsRelease->album_id);
		$this->mtlib->_smarty_display_mt_page('mt_musicwhore_album_release_tracks_edit.tpl');
	}
	
	// Processing methods
	
	function update($release_id)
	{
		$track_in = $this->input->get_post('track_in');
		$track_release_id = $this->input->get_post('track_release_id');
		$track_album_id = $this->input->get_post('track_album_id');
		
		foreach ($track_in as $track)
		{
			if (!empty($track['track_id']))
			{
				!empty($track['delete']) ? $this->_delete_track($track) : $this->_update_track($track, $track_release_id, $track_album_id);
			}
			else
			{
				$this->_add_track($track, $track_release_id, $track_album_id);
			}
		}
		
		$this->phpsession->flashsave('msg', 'Track information was updated.');
		
		header('Location: /index.php/musicwhore/tracks/edit/' . $track_release_id . '/');
		die();
	}
	
	function export($release_id)
	{
		$file_format = $this->input->get_post('file_format');
		switch ($file_format)
		{
			case 'xspf':
				$mime_type = 'text/xml';
				$file_extension = 'xml';
				break;
			case 'm3u':
				$mime_type = 'text/plain';
				$file_extension = 'm3u';
				break;
			default:
				$mime_type = 'text/plain';
				$file_extension = 'txt';
		}
		$smarty_fetch_template = 'mt_ep4_album_release_track_export_' . $file_format . '.tpl';
		
		$rsRelease = $this->Mt_mw_release_model->get_release_by_id($release_id);
		$export_file_name = strtolower($rsRelease->album_alias) . '.' . $file_extension;
		
		$rowTracks = $this->Mt_mw_tracks_model->get_tracks_mapped_to_audio($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('project', $rsRelease->album_alias);
		$this->mysmarty->assign('config', $this->mtlib->mt_config);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$text = $this->mysmarty->fetch($smarty_fetch_template);
		
		header('Cache-Control: private');
		header('Content-Disposition: attachment; filename="' . $export_file_name . '"');
		header('Content-Type: ' . $mime_type);
		echo $text;
		die();
	}
	
	// Private methods
	
	function _add_track($track, $track_release_id, $track_album_id)
	{
		$rsTrack = $this->db->get('ep4_tracks', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsTrack, $track);
		$input['track_release_id'] = $track_release_id;
		$input['track_album_id'] = $track_album_id;
		
		$this->Mt_mw_tracks_model->add_track($input);
	}
	
	function _update_track($track, $track_release_id, $track_album_id)
	{
		$track_id = $track['track_id'];
		$rsTrack = $this->Mt_mw_tracks_model->get_track_by_id($track_id, true);
		
		$input = $this->vigilantedblib->_db_build_update_data($rsTrack, $track);
		
		if (!empty($input))
		{
			$input['track_release_id'] = $track_release_id;
			$input['track_album_id'] = $track_album_id;
			
			$this->Mt_mw_tracks_model->update_track_by_id($track_id, $input);
		}
	}
	
	function _delete_track($track)
	{
		$track_id = $track['track_id'];
		$this->Mt_mw_ecommerce_model->delete_ecommerce_link_by_field_type($track_id, 'track_id');
		$this->Mt_mw_lyrics_model->delete_lyric_maps_by_track_id($track_id);
		$this->Mt_mw_tracks_model->delete_track_by_id($track_id);
	}
}

?>