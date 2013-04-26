<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of song
 *
 * @author Greg Bueno
 */
class Track extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->library('VmDebug');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Audio');
		$this->load->model('Obr_Release');
		$this->load->model('Obr_Song');
		$this->load->model('Obr_Track');
	}

	public function browse($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->observantview->_set_artist_header($artist_id, 'Songs');
			$rsTracks = $this->Obr_Track->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsSongs', $rsTracks);
			$this->mysmarty->assign('artist_id', $artist_id);
		}

		$this->vmview->display('admin/obr_track_list.tpl');
	}

	public function view($track_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->Obr_Track->set_config('fetch_audio', true);
			$rsTrack = $this->Obr_Track->retrieve_by_id($track_id);
			$rsRelease = $this->Obr_Release->retrieve_by_id($rsTrack->track_release_id);
			$this->vmview->format_section_head($rsRelease->album_title, $rsTrack->song_title);
			$this->mysmarty->assign('rsRelease', $rsRelease);
			$this->mysmarty->assign('rsTrack', $rsTrack);
			$this->mysmarty->assign('track_id', $track_id);
		}

		$this->vmview->display('admin/obr_track_view.tpl');
	}

	public function add($release_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsSongs = $this->Obr_Song->retrieve_all();
			$rsFiles = $this->Obr_Audio->retrieve_all(null, 'audio_mp3_file_path, audio_mp3_file_name');
			$rsRelease = $this->Obr_Release->retrieve_by_id($release_id);
			if (empty($this->vmview->section_head)) {
				$this->vmview->format_section_head($rsRelease->album_title, 'Create a track');
			}

			$this->mysmarty->assign('rsFiles', $rsFiles);
			$this->mysmarty->assign('rsSongs', $rsSongs);
			$this->mysmarty->assign('rsRelease', $rsRelease);
			$this->mysmarty->assign('release_id', $release_id);
		}

		$this->vmview->display('admin/obr_track_edit.tpl');
	}

	public function edit($track_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->Obr_Track->set_config('fetch_audio', true);
			$rsTrack = $this->Obr_Track->retrieve_by_id($track_id);
			$rsRelease = $this->Obr_Release->retrieve_by_id($rsTrack->track_release_id);
			$this->vmview->format_section_head($rsRelease->album_title, $rsTrack->song_title);
			$this->mysmarty->assign('rsTrack', $rsTrack);
			$this->mysmarty->assign('track_id', $track_id);
		}

		$this->add($rsTrack->track_release_id);
	}

	public function delete($track_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsTrack = $this->Obr_Track->retrieve_by_id($track_id);
			$this->observantview->_set_artist_header($rsTrack->song_primary_artist_id, $rsTrack->song_title);
			$this->mysmarty->assign('rsTrack', $rsTrack);
			$this->mysmarty->assign('song_id', $track_id);
		}

	}

	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($track_id = $this->Obr_Track->create())) {
			$redirect = '/index.php/admin/track/view/' . $track_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully created a track.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create a track.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function update($track_id) {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Track->update_by_id($track_id)) {
			$redirect = '/index.php/admin/track/view/' . $track_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated a track.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create a track.');
		}

		header('Location: ' . $redirect);
		die();
	}

	public function remove() {

	}

	public function save_order($release_id) {
		$tracks = $this->input->get_post('tracks');

		$is_success = true;
		if (count($tracks) > 0) {
			foreach ($tracks as $track) {
				if (false === $this->_update_track($track['track_id'], $track)) {
					$is_success = false;
					$error = 'Track order was not saved. Check disc ' . $track['track_disc_num'] . ', track ' . $track['track_track_num'] . '.';
					break;
				}
			}
		}

		echo ($is_success == true) ? 'Track order has been saved.' : $error;
	}

	private function _update_track($track_id, $input) {
		if (false !== $this->Obr_Track->update_by_id($track_id, $input)) {
			return true;
		}
		return false;
	}
}

?>
