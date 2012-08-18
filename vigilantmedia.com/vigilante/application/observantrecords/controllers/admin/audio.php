<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of audio
 *
 * @author Greg Bueno
 */
class Audio extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		$this->load->library('ObservantView');
		$this->load->library('VmSession');
		$this->load->model('Obr_Artist');
		$this->load->model('Obr_Audio');
	}
	
	public function browse($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$this->observantview->_set_artist_header($artist_id, 'Audio');
			$rsFiles = $this->Obr_Audio->retrieve_by_artist_id($artist_id);
			$this->mysmarty->assign('rsFiles', $rsFiles);
			$this->mysmarty->assign('artist_id', $artist_id);
		}
		
		$this->vmview->display('admin/obr_audio_list.tpl', true);
	}
	
	public function view($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->retrieve_by_id($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song_title);
			$this->mysmarty->assign('rsFile', $rsFile);
			$this->mysmarty->assign('audio_id', $audio_id);
		}
		
		$this->vmview->display('admin/obr_audio_view.tpl', true);
	}
	
	public function add($artist_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			if (empty($this->vmview->section_head)) {
				$this->observantview->_set_artist_header($artist_id, 'Create audio file');
			}
		}
		
		$this->vmview->display('admin/obr_audio_edit.tpl', true);
	}
	
	public function edit($audio_id) {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			$rsFile = $this->Obr_Audio->retrieve_by_id($audio_id);
			$this->observantview->_set_artist_header($rsFile->audio_artist_id, $rsFile->song_title);
			$this->mysmarty->assign('rsFile', $rsFile);
			$this->mysmarty->assign('audio_id', $audio_id);
		}
		
		$this->add($rsFile->audio_artist_id);
	}
	
	public function delete() {
		if (!empty($_SESSION[$this->vmsession->session_flag])) {
			
		}
		
	}
	
	public function create() {
		$redirect = $_SERVER['HTTP_REFERER'];
		if (false !== ($artist_id = $this->Obr_Audio->create())) {
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
		if (false !== $this->Obr_Audio->update_by_id($artist_id)) {
			$redirect = '/index.php/admin/artist/view/' . $artist_id . '/';
			$this->phpsession->flashsave('msg', 'You successfully updated an artist.');
		} else {
			$this->phpsession->flashsave('error', 'You failed to create an artist.');
		}

		header('Location: ' . $redirect);
		die();
	}
	
	public function remove() {
		
	}
}

?>
