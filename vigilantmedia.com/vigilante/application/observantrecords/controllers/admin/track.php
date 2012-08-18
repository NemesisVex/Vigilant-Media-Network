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
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Release');
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
			$rsTrack = $this->Obr_Track->retrieve_by_id($track_id);
			$rsRelease = $this->Obr_Release->retrieve_by_id($rsTrack->track_release_id);
			$this->vmview->format_section_head($rsRelease->album_title, $rsTrack->song_title);
			$this->mysmarty->assign('rsTrack', $rsTrack);
			$this->mysmarty->assign('track_id', $track_id);
		}
		
		$this->vmview->display('admin/obr_track_view.tpl');
	}
	
	public function add($release_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$rsRelease = $this->Obr_Release->retrieve_by_id($release_id);
				$this->vmview->format_section_head($rsRelease->album_title, 'Create a track');
			}
			$this->mysmarty->assign('release_id', $release_id);
		}
		
		$this->vmview->display('admin/obr_track_edit.tpl');
	}
	
	public function edit($track_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
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
		if (false !== ($artist_id = $this->Obr_Album->create())) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashset('msg', 'You successfully created an album.');
		} else {
			$this->phpsession->flashset('error', 'You failed to create an album.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function update() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== $this->Obr_Album->update_by_id($artist_id)) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an album.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an album.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function remove() {
		
	}
}

?>
