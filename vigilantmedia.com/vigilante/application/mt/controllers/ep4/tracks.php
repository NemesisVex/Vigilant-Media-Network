<?php

class Tracks extends CI_Controller
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
		$this->load->model('Mt_ep4_audio_model');
		$this->load->model('Mt_ep4_content_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		header('Location: /index.php/mt/ep4/');
	}
	
	function save($release_id)
	{
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_ep4_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('release_id', $release_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_album_release_tracks_save.tpl');
	}
	
	function edit($release_id)
	{
		$is_add_more = $this->input->get_post('is_add_more');
		$more_tracks = $this->input->get_post('more_tracks');
		
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_ep4_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_by_release_id($release_id);
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
		
		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsSongs', $rsSongs);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('track_release_id', $release_id);
		$this->mysmarty->assign('track_album_id', $rsRelease->album_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_album_release_tracks_edit.tpl');
	}
	
	function add($release_id)
	{
		$number_of_tracks = $this->input->get_post('number_of_tracks');
		
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$rsArtist = $this->mtlib->_format_ep4_section_head($rsRelease->album_artist_id, 'Add/edit tracks');
		
		for ($i=0; $i<$number_of_tracks; $i++)
		{
			$rsTracks[$i]['new_track_setup'] = $i+1;
		}
		
		$rowSongs = $this->Mt_ep4_song_model->get_all_songs();
		$rsSongs = $this->vigilantedblib->_db_return_smarty_array($rowSongs);
		
		$this->mysmarty->assign('rsTracks', $rsTracks);
		$this->mysmarty->assign('rsSongs', $rsSongs);
		$this->mysmarty->assign('rsRelease', $rsRelease);
		$this->mysmarty->assign('track_release_id', $release_id);
		$this->mysmarty->assign('track_album_id', $rsRelease->album_id);
		$this->mtlib->_smarty_display_mt_page('mt_ep4_album_release_tracks_edit.tpl');
	}
	
	// AJAX methods
	
	function track_list() {
		$release_id = $this->input->get_post('track_release_id');
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_by_release_id($release_id);
		$rsTracks = $this->vigilantedblib->_db_return_smarty_array($rowTracks);
		
		$jsonTracks = json_encode($rsTracks);
		echo $jsonTracks;
		die();
	}
	
	// Processing methods
	public function update($track_id)
	{
		//echo '<pre>';
		$rsTrack = $this->Mt_ep4_tracks_model->get_track_by_id($track_id, true);
		//print_r($rsTrack);
		$input = $this->vigilantedblib->_db_build_update_data($rsTrack);
		//print_r($input);
		//die();
		
		$map_id = $this->input->get_post('map_id');
		$map_audio_id = $this->input->get_post('map_audio_id');
		$track_release_id = $this->input->get_post('track_release_id');
		
		if (!empty($input))
		{
			$msg = '';
			if (false !== $this->Mt_ep4_tracks_model->update_track_by_id($track_id, $input)) {
				$msg .= 'Your track has been updated.';
			}
		}
		
		if (empty($map_id) && !empty($map_audio_id)) {
			if (false !== ($map_id = $this->_create_audio_map($track_id))) {
				$msg .= ' An audio file has been associated with this track.';
			}
		} elseif (!empty($map_id) && empty($map_audio_id)) {
			// Delete the association
			if (false !== $this->_remove_audio_map($map_id)) {
				$msg .= ' An audio file association with this track has been deleted.';
			}
		} elseif (!empty($map_id) && !empty($map_audio_id)) {
			// Update association
			if (false !== $this->_update_audio_map($map_id)) {
				$msg .= ' An audio file association with this track has been updated.';
			}
		}
		//echo '</pre>';
		//die();
		
		$this->phpsession->flashsave('msg', $msg);
		header('Location: /index.php/ep4/release/edit/' . $track_release_id . '/');
		die();
	}
	
	public function create($track_release_id)
	{
		$rsTrack = $this->db->get('ep4_tracks', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsTrack);
		$input['track_release_id'] = $track_release_id;
		$map_audio_id = $this->input->get_post('map_audio_id');
		
		if (false !== ($track_id = $this->Mt_ep4_tracks_model->add_track($input))) {
			$msg = 'A new track has been added to this release.';
			
			if (!empty($map_audio_id)) {
				if (false !== $this->_create_audio_map($track_id)) {
					$mgs .= 'An audio file has been associated with this track.';
				}
			}
			
			$this->phpsession->flashsave('msg', $msg);
		}
		
		header('Location: /index.php/ep4/release/edit/' . $track_release_id . '/');
		die();
	}
	
	public function save_order($release_id) {
		$tracks = $this->input->get_post('tracks');
		
		$is_success = false;
		if (count($tracks) > 0) {
			foreach ($tracks as $track) {
				if (false !== $this->_update_track($track['track_id'], $track)) {
					$is_success = true;
				}
			}
		}
		
		echo ($is_success == true) ? 'Track order has been saved.' : 'Track order was not saved.';
	}
	
	function export($release_id)
	{
		$file_format = $this->input->get_post('file_format');
		$version = $this->input->get_post('version');
		$url_base = $this->input->get_post('url_base');
		
		$this->mysmarty->assign('url_base', $url_base);
		$this->mysmarty->assign('version', $version);
		$this->mysmarty->assign('file_foramt', $file_format);
		
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
		
		$rsRelease = $this->Mt_ep4_release_model->get_release_by_id($release_id);
		$export_file_name = strtolower($rsRelease->album_alias) . '_' . $version . '.' . $file_extension;
		
		$rowTracks = $this->Mt_ep4_tracks_model->get_tracks_mapped_to_audio($release_id);
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
	
	private function _create_audio_map($track_id) {
		$rsAudioMap = $this->db->get('ep4_audio_map');
		$input = $this->vigilantedblib->_db_build_insert_data($rsAudioMap);
		$input['map_track_id'] = $track_id;

		if (false !== ($map_id = $this->Mt_ep4_audio_model->add_audio_map($input))) {
			return $map_id;
		}
		return false;
	}
	
	private function _update_audio_map($map_id, $track_id) {
		$rsMap = $this->Mt_ep4_audio_model->get_audio_map_by_id($map_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsMap);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_ep4_audio_model->update_audio_map_by_id($map_id, $input)) {
				return true;
			}
		}
		return false;
	}
	
	private function _remove_audio_map($map_id) {
		if (false != $this->Mt_ep4_audio_model->delete_audio_map_by_id($map_id)) {
			return true;
		}
		return false;
	}
	
	private function _update_track($track_id, $input) {
		if (false !== $this->Mt_ep4_tracks_model->update_track_by_id($track_id, $input)) {
			return true;
		}
		return false;
	}
}

?>